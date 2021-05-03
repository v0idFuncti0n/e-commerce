<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function_construct()
       {
           $this->middleware('auth:admin');
}
public function Coupon(){
        $coupon = DB::table('coupons')->get();
        return view('admin-dashboard.coupon',compact('coupon'));
}
public function StoreCoupon (Request $request){
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);
        $notification=array(
            'message'=>'Coupon Inserted Successfully',
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
}
}
