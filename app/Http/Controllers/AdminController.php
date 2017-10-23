<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Discount;
use App\Group;
use App\Http\Requests\ChangeProduct;
use App\Http\Requests\ProductRequest;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $report = array();
        $report['productsCount'] = Product::all()->count();
        $report['categoriesCount'] = Group::whereNull('parent_id')->count();
        $report['subCategoriesCount'] = Group::where('parent_id', '!=', 'null')->count();
        $report['countOrders'] = Order::sum('qty');
        $report['monthIncom'] = Order::whereMonth('created_at', '=', date('m'))->sum('totalPrice');
        $report['todayIncom'] = Order::whereDay('created_at', '=', date('d'))->sum('totalPrice');
        return view('admin.dashboard', ['report' => $report]);
    }

    public function newProduct()
    {

        $subGroups = Group::wherenotNull('parent_id')->get();
        $discounts = Discount::all();
        $modify = 0;
        return view('admin.product', ['subGroups' => $subGroups, 'discounts' => $discounts, 'modify' => $modify]);

    }

    public function saveProduct(ProductRequest $request)
    {
        $file = $request->file('image');
        $name = time() . '-' . $file->getClientOriginalName();
        $file->move('products/photos', $name);
        $path = "/products/photos/" . $name;
        Product::create(['group_id' => $request->cat, 'discount_id' => $request->discount, 'title' => $request->title, 'price' => $request->price,
            'photo' => $path, 'quantity' => $request->quantity, 'detail' => $request->detail]);

        flash('success', 'ثبت محصول', 'محصول با موفقیت ثبت شد');
        return back();

    }

    public function newCategory(Request $request)
    {
        $groups = Group::whereNull('parent_id')->with('subgroups')->get();
        if ($request->isMethod('get')) {
            return view('admin.category', ['groups' => $groups]);

        }

        if ($request->isMethod('post')) {


            if (isset($_POST['submitCat'])) {
                $this->validate($request,
                    [
                        'cat' => 'required|min:3'

                    ]);
                Group::create(['groupName' => $request->cat]);
                flash('success', 'ثبت دسته', 'ثبت با موفقیت انجام شد');

            }

            if (isset($_POST['submitSubcat'])) {
                $this->validate($request,
                    [
                        'subCat' => 'required|min:3'

                    ]);
                Group::create(['groupName' => $request->subCat, 'parent_id' => $request->cat]);
                flash('success', 'ثبت زیر دسته', 'ثبت با موفقیت انجام شد');

            }

            return back();
        }


    }

    public function deleteCat(Group $category)
    {
        $category->delete();
        return back();
    }


    public function saveCat(Request $request)
    {
        if (isset($_POST['submitCat'])) {
            Group::create(['groupName' => $request->nameCat]);
        }

        if (isset($_POST['submitSubcat'])) {
            Group::create(['groupName' => $request->nameSubcat, 'parent_id' => $request->cat]);
        }

        return back();
    }

    public function comments()
    {
        $comments = Comment::Paginate(10);
        return view('admin.comments', ['comments' => $comments]);
    }

    public function checkComment($id)
    {
        $comment = Comment::where('id', $id)->get()->first();
        if ($comment->status == '0') {
            Comment::where('id', $id)->update(['status' => 1]);
        } else {
            Comment::where('id', $id)->update(['status' => 0]);
        }
        return back();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back();
    }

    public function orders()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.orders', ['orders' => $orders]);
    }

    public function productList()
    {
        $products = Product::paginate(10);
        return view('admin.product-list', ['products' => $products]);
    }

    public function deleteProduct(Product $product)
    {
        if ($product->images) {
            foreach ($product->images as $image) {
                unlink(public_path() . $image->imageUrl);
            }
            $product->images()->delete();
        }


        if ($product->comments) {
            $product->comments()->delete();
        }

        unlink(public_path() . '/' . $product->photo);
        $product->delete();
        return back();
    }


    public function updatePage(Product $product)
    {
        $subGroups = Group::wherenotNull('parent_id')->get();
        $discounts = Discount::all();
        $modify = 1;
        return view('admin.product', ['product' => $product, 'subGroups' => $subGroups, 'discounts' => $discounts, 'modify' => $modify]);
    }

    public function updateProduct(ChangeProduct $request, Product $product)
    {
        if ($request->hasFile('image')) {
            if (is_file($product->photo)) {

                unlink(public_path() . '/' . $product->photo);
            }
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $file->move('products/photos', $name);
            $path = "/products/photos/" . $name;
            $product->update(['group_id' => $request->cat, 'discount_id' => $request->discount, 'title' => $request->title,
                'price' => $request->price, 'quantity' => $request->quantity, 'datail' => $request->datail, 'photo' => $path]);
            flash('success', ' ویرایش محصول', 'ویرایش با موفقیت انجام شد');
            return back();

        } else {
            $product->update(['group_id' => $request->cat, 'discount_id' => $request->discount, 'title' => $request->title,
                'price' => $request->price, 'quantity' => $request->quantity, 'datail' => $request->datail]);
            flash('success', ' ویرایش محصول', 'ویرایش با موفقیت انجام شد');
            return back();

        }
    }


    public function addPhotos(Request $request, Product $product)
    {
        if ($request->isMethod('get')) {
            return view('admin.upload', ['product' => $product]);

        }
        if ($request->isMethod('post') and $product->images->count() < 3) {

            {
                $this->validate($request, [
                    'file' => 'mimes:jpg,jpeg,png,bmp'
                ]);

                $file = $request->file('file');
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move('products/photos', $name);
                $path = "/products/photos/" . $name;
                $product->images()->create(['product_id' => $product->id, 'imageUrl' => $path]);

            }


        }

    }

    public function editPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.editPassword');

        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'oldPass' => 'required',
                'newPass' => 'required',
                'confPass' => 'required|same:newPass',
            ]);
            $user = User::find(Auth::id());
            $hashedPassword = $user->password;

            if (Hash::check($request->oldPass, $hashedPassword)) {
                $user->update(['password' => Hash::make($request->newPass)]);
                flash('success', ' ویرایش کاربری', 'ویرایش با موفقیت انجام شد');
                return back();
            } else {
                flash('error', ' ویرایش کاربری', 'رمز عبور قبلی اشتباه است');
                return back();

            }
        }
    }

    public function offProduct(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.off');

        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'off' => 'required|numeric',
            ]);

            Discount::create(['discountPercent' => $request->off]);
            flash('success', 'افزودن', 'افزودن تخفیف با موفقیت انجام شد');
            return back();


        }

    }

}

