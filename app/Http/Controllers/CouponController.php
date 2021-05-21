<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin-dashboard.coupon', compact('coupon'));
    }

    public function StoreCoupon(Request $request)
    {
        $request->validate([
            'coupon' => 'required|unique:coupons,coupon|max:255',
        ]);
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);
        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deletecoupon($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);

    }

    public function EditCoupon(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        if ($request->coupon == $coupon->coupon) {
            $coupon->discount = $request->discount;
        } else {
            $request->validate([
                'coupon' => 'required|unique:coupons,coupon|max:255',
                'discount' => 'required|max:255',
            ]);

            $coupon->coupon = $request->coupon;
            $coupon->discount = $request->discount;
        }
        $coupon->save();
        $notification = array(
            'message' => 'Coupon has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
