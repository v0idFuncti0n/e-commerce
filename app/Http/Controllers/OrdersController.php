<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function showOrders() {
        $orders = Auth::user()->orders;
        return view('e-commerce.orders',['orders' => $orders]);
    }

    public function showOrdersItems($id){
        $order = Order::findOrFail($id);
        if(Auth::id() == $order->user_id){
            $orderItems = $order->orderItems;
            return view('e-commerce.order-items', ['order' => $order, 'orderItems' => $orderItems]);
        }
        return redirect()->back();
    }

    public function adminShowAllOrders() {
        $order = Order::all();
        return view('admin-dashboard.orders.orders', ['orders' => $order]);
    }

    public function adminShowOrdersItems($id){
        $order = Order::findOrFail($id);
        $orderItems = $order->orderItems;
        return view('admin-dashboard.orders.order-items', ['order' => $order, 'orderItems' => $orderItems]);
    }

    public function shipOrder($order_id) {
        $order = Order::findOrFail($order_id);
        $order->shipped = true;
        $order->save();
        return redirect()->back();
    }

    public function downloadInvoicePDF(Request $request){
        $order = Order::find($request->order);
        $pdf = PDF::loadView('e-commerce.pdf-invoice',['order' => $order]);
        return $pdf->download('invoice.pdf');
        //return view('e-commerce.pdf-invoice', ['order' => $order]);
    }

}
