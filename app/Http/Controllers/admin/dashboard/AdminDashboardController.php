<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\RouteHistory;
use App\Models\Salesman;
use App\Models\SubCategory;
use App\Models\TodayVisit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $categories = Category::count();
        $sub_categories = SubCategory::count();
        $salesman = Salesman::count();
        $customers = Customer::count();
        $admins = Admin::count();
        $orders = Order::count();
        $sales = Order::sum('total');
        $salesman_sales = Order::whereDate('created_at',Carbon::today())->take(10)->get();
        $recent_orders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $salesman_duty = Salesman::where('online', 'online')->get();
        $salesman_track = RouteHistory::whereDate('created_at', Carbon::today())
        ->orderBy('created_at')
        ->groupBy('salesman_id', 'lat','lng')
        ->get(['lat', 'lng', 'salesman_id']);

        $polylines = [];
        foreach ($salesman_track as $coordinate) {
            $salesmanId = $coordinate->salesman_id;
            $salesmanName = $coordinate->salesman->name;
            $coordinateData = [
                'lat' => $coordinate->lat,
                'lng' => $coordinate->lng,
            ];

            if (!isset($polylines[$salesmanId])) {
                $polylines[$salesmanId] = [
                    'name' => $salesmanName,
                    'coordinates' => [],
                ];
            }

            $polylines[$salesmanId]['coordinates'][] = $coordinateData;
        }
        $today_visits = TodayVisit::whereDate('created_at',Carbon::today())->orderBy('created_at','desc')->take(10)->get();

        try {
            return view('backend.admin.index', compact('products', 'categories', 'sub_categories', 'salesman',
                'customers', 'admins', 'orders', 'sales', 'salesman_sales', 'recent_orders',
                 'salesman_duty','polylines','today_visits'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function orders()
    {
        try{
             return view('backend.admin.orders.index');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function orderDetail($orderId)
    {
        try{
             $order = Order::findorFail($orderId);
             return view('backend.admin.orders.order-detail',compact('order'));
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/admin/login')->with('message', 'You Logout Successfully!');
    }
}
