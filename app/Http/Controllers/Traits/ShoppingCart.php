<?php
/**
 * Created by PhpStorm.
 * User: N  o o  R
 * Date: 9/24/2017
 * Time: 10:06 AM
 */

namespace App\Http\Controllers\Traits;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use View;

trait ShoppingCart
{

    protected function passToView()
    {
        $discount=0;
        $order = Cart::content();
        $new  = '';
        $newPrice=0;
        $sum=0;
        foreach($order as $key => $value)
        {
            $products=Product::where('id',$value->id)->get();
            foreach ($products as $product) {
                if ($product->discount->discountPercent != 0) {
                    $newPrice = ($product->price) - ($product->price * $product->discount->discountPercent / 100);
                    $new[]= array($product->id => array('newPrice'=>$newPrice));
                }
                else{
                    $newPrice = $product->price;
                    $new[]= array($product->id => array('newPrice'=>$newPrice));
                }
                $sum += $newPrice * $value->qty;
            }
        }

        $count = Cart::count();

        View::share(['order' => $order, 'count' => $count, 'sum' => $sum,'new'=>$new]);
    }

    protected function addToCart(Request $request, $id)
    {

        if ($id != NULL) {
            if (!Session::has('cartStatus')) {
                $product = \DB::table('products')->where('id', $id)->first();
                Cart::add(['id' => $id, 'name' => $product->title, 'qty' => 1, 'price' => $product->price]);
                Session('cartStatus', 'open');
                return;

            } elseif (Session::get('cartStatus') == 'lock') {
                flash('error', 'سبد خرید', 'سبد خرید قفل است و شما باید عملیات پرداخت را تکمیل نمایید');
            }

        }

        if ($request->id != null)
        {
            if (!Session::has('cartStatus'))
            {
                $num = $request->num;
                $id = $request->id;
                $product = \DB::table('products')->where('id', $id)->first();
                Cart::add(['id' => $id, 'name' => $product->title, 'qty' => $num, 'price' => $product->price ,'options' =>['discount' =>  $product->discount_id]]);
                Session('cartStatus', 'open');
            }
            elseif (Session::get('cartStatus') == 'lock')
            {
                flash('error','سبد خرید','سبد خرید قفل است و شما باید عملیات پرداخت را تکمیل نمایید');
            }
        }


    }


    protected function deleteCartItem($id, $rowId)
    {
        $product = Cart::get($rowId);
        if ($product->qty == 1) {
            Cart::remove($rowId);
        } else {
            $qty = $product->qty - 1;
            Cart::update($rowId, ['qty' => $qty]);
        }
    }
}