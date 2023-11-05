<?php

namespace App\Http\Controllers\salesman;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\RouteCustomer;
use App\Models\RouteHistory;
use App\Models\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class SalesmanDashboardController extends Controller
{
    public function index()
    {
        try {
            $my_route = Route::where('visit_day',Carbon::now()->englishDayOfWeek)->first();
           // dd($my_route);
            if($my_route){
                $customer = RouteCustomer::where('route_id',$my_route->id)->first();
            $customers = explode(',',$customer->id);
            }else{
                $customers =[];
            }
            return view('backend.salesman.index',compact('my_route','customers'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function orders()
    {
        try {
            return view('backend.salesman.orders');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function shop()
    {
        try {
            return view('backend.salesman.shop');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function cart()
    {
        try {
            return view('backend.salesman.cart');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function checkout()
    {
        try {
            return view('backend.salesman.checkout');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function routes()
    {
        try {
            return view('backend.salesman.routes');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function profile()
    {
        try {
            return view('backend.salesman.profile');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function payment()
    {
        try {
            return view('backend.salesman.payment');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function resetPassword()
    {
        try {
            return view('backend.salesman.reset-password');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function logout(Request $request)
    {
        Livewire::component('location-tracker-component', \App\Http\Livewire\LocationTrackerComponent::class);
        $salesman = Salesman::find(Auth::guard('salesman')->user()->id);
        $salesman->online = 'offline';
        $salesman->save();
        Auth::guard('salesman')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/salesman/login')->with('message', 'You Logout Successfully!');
    }
    public function storeLocation(Request $request)
    {
        try {
            $salesmanId = $request->input('salesman_id');
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $timestamp = $request->input('timestamp');

            // Store the location in the route_histories table
            RouteHistory::create([
                'salesman_id' => $salesmanId,
                'lat' => $lat,
                'lng' => $lng,
                'timestamp' => $timestamp,
            ]);

            return response()->json(['message' => 'Location data stored successfully']);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
