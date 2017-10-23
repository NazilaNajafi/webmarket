<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Comment;
use App\Discount;
use App\Group;
use App\Http\Controllers\Traits\ShoppingCart;
use App\Http\Requests\CommentRequest;
use App\Order;
use App\Product;
use App\Ratelog;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    use ShoppingCart;

    public function __construct()
    {

    }

    public function index(Request $request, $id = NULL)
    {
        if ($request->num != '') {
            $this->addToCart($request, $id);
            return redirect()->to('detail/' . $request->id);
        }
        $this->passToView();
        $specialSalesUp = Product::whereHas('discount', function ($query) {
            $query->whereBetween('discountPercent', [40, 80])->orderBy('id', 'DESC');
        })->take(3)->get();

        $specialSalesDown = Product::whereHas('discount', function ($query) {
            $query->whereBetween('discountPercent', [20, 40])->orderBy('id', 'DESC');
        })->take(3)->get();


        $newProducts = Product::whereMonth('created_at', '=', date('m'))->orderBy('id', 'DESC')->take(4)->get();

        $favProducts = Product::select(DB::raw('products.*, SUM(orders.qty) as qty'))
            ->join('orders', 'orders.product_id', '=', 'products.id')
            ->groupBy('orders.product_id')
            ->orderBy('qty' , 'DESC')
            ->take(4)->get();

        return view('store.index', ['specialSalesUp' => $specialSalesUp, 'specialSalesDown' => $specialSalesDown, 'newProducts' => $newProducts, 'favProducts' => $favProducts]);
    }


    public function search(Request $request, $id = NULL)
    {
        $this->addToCart($request, $id);
        $this->passToView();
        $key = $request->input('search');
        if ($request->ajax() && isset($request->brand)) {
            $key = $request->search;
            $brand = $request->brand;
            $products = Product::whereIN('group_id', explode(',', $brand))
                ->where('title', 'like', '%' . $key . '%')->paginate(20);
            response()->json($products);
            return view('partial.products', compact('products'));
        }else
        {

            $categories = Group::wherenotNull('parent_id')->get();
            $products = Product::where('title', 'like', '%' . $key . '%')
                ->Paginate(8);
            return view('store.shop-search', ['key' => $key, 'products' => $products, 'categories' => $categories]);

        }
    }

    public function delAllCart()
    {
        if (Cart::count() == 0) {
            flash('error', 'سبد خرید', 'سبد خرید شما خالی است');
            return back();
        }
        Cart::destroy();
        Session::forget('cartStatus');
        return redirect()->route('home');
    }

    public function deleteCart($id, $rowId)
    {
        $this->deleteCartItem($id, $rowId);
        return redirect()->route('home');
    }

    public function detail(Product $product, $id = NULL, Request $request)
    {
        if ($id != NULL) {
            $this->addToCart($request, $id);
        }
        if ($product) {
            $id = $product->group_id;
            $this->passToView();
            $ralatedProducts = Product::where('group_id', '=', $id)->where('id', '!=', $product->id)->take(4)->get();
            return view('store.product', (['product' => $product, 'ralatedProducts' => $ralatedProducts]));
        } else {
            return 'not exist';

        }
    }

    public function addComment(Product $product, CommentRequest $request)
    {
        $product->comments()->create($request->all());
        flash('success', 'ثبت نظر', 'دیدگاه شما ثبت شد و منتظر تائید مدیر است . با تشکر ...');

        return back();

    }

    public function subGroupList(Group $group, $id = NULL, Request $request)
    {
        if ($id != NULL) {
            $this->addToCart($request, $id);
        }
        $this->passToView();
        if ($request->ajax() && isset($request->start) && isset($request->end)) {
            $start=$request->start;
            $end=$request->end;
            $groupId=$request->groupId;
            $products=Product::where('price','>=',$start)
                ->where('price','<=',$end)
                ->where('group_id','=',$groupId)
                ->orderby('price','Desc')
                ->paginate('8');
            response()->json($products);
            return view('partial.products',['products' => $products]);

        } else {
            $products = $group->products()->paginate('10');
            return view('store.shop', ['products' => $products, 'group' => $group->groupName]);

        }

    }


    public function like()
    {
        $cRateStr = Input::get('cRateStr');
        sleep(1);
        $arr = explode('-', $cRateStr);
        $rate = $arr[1];
        $id = $arr[0];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $count = Ratelog::where('comment_id', '=', $id)->where('userIp', $userIP)->count();
        if ($count == 0 and $rate == 'up') {
            $comment = Comment::findOrFail($arr[0]);
            $comment->increment('rate');
            $comment->rateLogs()->create(['userIp' => $userIP]);
        }
        if ($count == 1 and $rate == 'down') {
            $comment = Comment::findOrFail($arr[0]);
            $comment->decrement('rate');
            Ratelog::where('userIp', $userIP)->delete();
        }

        return $comment->rate;

    }

    public function checkoutStep1()
    {
        if (Cart::count() == 0) {
            flash('error', 'سبد خرید', 'سبد خرید شما خالی است');
            return back();
        }
        $this->passToView();
        return view('store.checkout-step-1');
    }

    public function checkoutStep2(Request $request)
    {

        $edit = 'false';
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $buyer = Buyer::where('user_id', $id)->first();

        if ($buyer == null && $request->isMethod('post')) {
            $user->buyer()->create($request->all());
            return redirect()->to('checkoutStep3/' . $id);


        } elseif ($buyer != null && $request->isMethod('post')) {
            Buyer::where('user_id', $id)->update(['city' => $request->city, 'cellphone' => $request->cellphone, 'phone' => $request->phone, 'address' => $request->address]);
            $buyer = Buyer::where('user_id', $id)->first();
            return redirect()->to('checkoutStep3/' . $id);

        }
        return view('store.checkout-step-2', ['buyer' => $buyer, 'edit' => $edit]);
    }


    public function checkoutStep3($id)
    {
        $this->passToView();
        $user = Auth::user()->with('buyer')->first();
        return view('store.checkout-step-3', ['user' => $user]);
    }

    public function checkoutStep4()
    {
        $this->passToView();
        session::put('cartStatus', 'lock');
        return view('store.checkout-step-4');

    }


    public function payment()
    {
        $id = Auth::id();
        $orders = Cart::content();
        foreach ($orders as $key => $value) {
            $t = Product::where('id', $value->id)->first();
            $d = Discount::where('id', $t->discount_id)->first();
            if ($d->discountPercent != 0) {
                $final = $t->price - ($t->price * ($d->discountPercent * $value->qty) / 100);
                Order::create(['totalPrice' => $final * $value->qty, 'qty' => $value->qty,
                    'trackingCode' => rand(100, 200), 'user_id' => $id, 'product_id' => $value->id]);
                $product = Product::where('id', $value->id)->get()->first();
                $product->update(['quantity' => ($product->quantity - $value->qty)]);
            } else {
                Order::create(['totalPrice' => $value->price * $value->qty, 'qty' => $value->qty,
                    'trackingCode' => rand(100, 200), 'user_id' => $id, 'product_id' => $value->id]);
                $product = Product::where('id', $value->id)->get()->first();
                $product->update(['quantity' => ($product->quantity - $value->qty)]);
            }
        }
        Cart::destroy();
        Session::forget('cartStatus');
        flash('success', 'پرداخت ', 'پرداخت با موفقیت انجام شد');
        return redirect()->route('home');
    }


    public
    function aboutUs()
    {
        $this->passToView();
        return view('store.aboutUs');
    }

    public function contactUs(Request $request)
    {
        $this->passToView();
        if ($request->isMethod('get')) {
            return view('store.contactUs');

        }
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'message' => 'required|min:10'

            ]);
            Mail::send('emails.contact',
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_message' => $request->message
                ], function ($message) {
                    $message->from('nazila.najafii@gmail.com', 'ContactUs');

                    $message->to('nazila_najafii@yahoo.com')->subject('WebMarcket');

                });
            flash('success', 'ثبت پیغام', 'پیغام شما ثبت شد.با تشکر');
            return back();

            if (count(Mail::failures()) > 0) {

                flash('error', 'ثبت پیغام', 'مشکلی در ارسال پیغام وجود دارد');
                return back();

            }
        }

    }

    public
    function userPanel(User $user)
    {
        $this->passToView();
        $orders = Order::where('user_id', '=', $user->id)->paginate('10');
        return view('store.userOrder', ['orders' => $orders]);

    }

}
