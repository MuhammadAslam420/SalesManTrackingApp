<?php

namespace App\Http\Controllers\admin\routes;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Route;
use App\Models\RouteCustomer;
use App\Models\Salesman;
use App\Services\RouteCustomerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminRouteController extends Controller
{
    protected $routeCustomerService;

    public function __construct(RouteCustomerService $routeCustomerService)
    {
        $this->routeCustomerService = $routeCustomerService;
    }
    public function index()
    {
        return view('backend.admin.salesman.routes.index');
    }
    public function editRouteForm()
    {
        return view('backend.admin.salesman.routes.edit');
    }
    public function addCustomersRouteFrom($routeId)
    {
        try {
            $route = Route::findorFail($routeId);
            $customers = Customer::get();
            return view('backend.admin.salesman.routes.customers', compact('customers', 'route'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }


    public function storeCustomersToRoute(Request $request, $routeId)
    {
        try {
            $route_Id = $routeId;
            $customerIds = $request->input('customer_Ids');
            //dd($routeId,$customerIds);
            $this->routeCustomerService->createRouteCustomer($route_Id, $customerIds);
            return back()->with('message', 'Customers has been assign to route');
        } catch (\Exception ) {return view('backend.admin.error');}
    }

    public function updaterouteForm($routeId)
    {
        try {
            $route = RouteCustomer::where('route_id', $routeId)->first();
            $attachedCustomers = explode(',', $route->customer_id);
            $customers = Customer::get();
            return view('backend.admin.salesman.routes.update', compact('route', 'customers', 'attachedCustomers'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function updateRouteCustomers(Request $request, $routeId)
    {
        try {
            $customerIds = implode(',', $request->input('customer_Ids'));
            $this->routeCustomerService->updateRouteCustomer($routeId, $customerIds);
            return back()->with('message', 'Customers has been updated');

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function deleteRoute($routeId)
    {
      try{
        $route = Route::findorFail($routeId);
        $route->status='deleted';
        $route->deleted_at = Carbon::today();
        $route->save();
        $rt_cust=RouteCustomer::where('route_id',$routeId)->first();
        $rt_cust->deleted_at= Carbon::today();
        $rt_cust->save();
        return back()->with('message','Route and all shops attached with deleted successfully');
      }catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        return view('backend.admin.error', compact('errorMessage'));
    }
    }
    public function genericForm(){
        try{
            
            return view('backend.admin.salesman.routes.generic_form');
           }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function routeMap($routeId)
    {
       try{
        $route=Route::findorFail($routeId);
        return view('backend.admin.salesman.routes.map',compact('route'));
       }catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        return view('backend.admin.error', compact('errorMessage'));
    }
    }
}
