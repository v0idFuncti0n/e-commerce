<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showDashboard(){
        $total = (int)Order::all()->sum('total');
        $orders = Order::where('shipped',0)->count();
        $sales = OrderItem::all()->sum('quantity');
        $clients = DB::table('model_has_roles')->where('role_id', 2)->count();
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        //$weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $sales_week[0] = Order::whereBetween('created_at', [$weekStartDate, Carbon::createFromDate($weekStartDate)->addDays(1)])->sum('total');
        $sales_week[1] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(1), Carbon::createFromDate($weekStartDate)->addDays(2)])->sum('total');
        $sales_week[2] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(2), Carbon::createFromDate($weekStartDate)->addDays(3)])->sum('total');
        $sales_week[3] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(3), Carbon::createFromDate($weekStartDate)->addDays(4)])->sum('total');
        $sales_week[4] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(4), Carbon::createFromDate($weekStartDate)->addDays(5)])->sum('total');
        $sales_week[5] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(5), Carbon::createFromDate($weekStartDate)->addDays(6)])->sum('total');
        $sales_week[6] = Order::whereBetween('created_at', [Carbon::createFromDate($weekStartDate)->addDays(6), Carbon::createFromDate($weekStartDate)->addDays(7)])->sum('total');
        //dd($sales_week[0], $sales_week[1], $sales_week[2], $sales_week[3], $sales_week[4], $sales_week[5], $sales_week[6]);
        return view('admin-dashboard.dashboard', [
            'total' => $total,
            'orders' => $orders,
            'sales' => $sales,
            'clients' => $clients,
            'monday' => $sales_week[0],
            'tuesday' => $sales_week[1],
            'wednesday' => $sales_week[2],
            'thursday' => $sales_week[3],
            'friday' => $sales_week[4],
            'saturday' => $sales_week[5],
            'sunday' => $sales_week[6],
        ]);
    }
}
