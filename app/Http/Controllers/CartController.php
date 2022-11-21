<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {
        $check = Cart::where('product_id', $product_id)->where('user_ip',request()->ip())->first();
        if($check){
            Cart::where('product_id', $product_id)->where('user_ip',request()->ip())->increment('qty');
            Cart::where('product_id', $product_id)->where('user_ip',request()->ip())->update([
                'price' => $check->price + $request->price
            ]);
        }else{
            Cart::insert([
                'product_id' => $product_id,
                'qty' => 1,
                'price' => $request->price,
                'user_ip' => request()->ip(),
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('cart','Product added On Cart');
    }

    public function cartPage()
    {
        $carts = Cart::where('user_ip',request()->ip())->latest()->get();

        $subtotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
            return $t->product->price * $t->qty;
        });
        return view('pages.cart',compact('carts','subtotal'));
    }

    public function destroy($cart_id)
    {
        Cart::where('id',$cart_id)->where('user_ip', request()->ip())->delete();
        return Redirect()->back()->with('cart_delete','Cart Product Removed');
    }

    public function quantityUpdate(Request $request, $cart_id)
    {
        $check = Cart::where('id',$cart_id)->where('user_ip', request()->ip())->first();
        Cart::where('id',$cart_id)->where('user_ip', request()->ip())->update([
            'qty' => $request->qty,
            'price' => $check->product->price * $request->qty
        ]);
        return Redirect()->back()->with('cart_update','Quantity updated');
    }

    public function applyCoupon(Request $request)
    {
        $check = Coupon::where('coupon_name',$request->coupon_name)->first();
        if($check){
            $subtotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
                return $t->price * $t->qty;
            });
            Session::put('coupon',[
                'coupon_name' => $check->coupon_name,
                'coupon_discount' => $check->discount,
                'discount_amount' => $subtotal * ($check->discount/100),
            ]);
            return Redirect()->back()->with('cart_update','Coupon applied');
        } else {
            return Redirect()->back()->with('cart_delete','Invalid Coupon');
        }
    }

    public function couponDestroy(){
        if (Session::has('coupon')) {
           session()->forget('coupon');
           return Redirect()->back()->with('cart_delete','Coupon Removed Success');
        }

    }

}
