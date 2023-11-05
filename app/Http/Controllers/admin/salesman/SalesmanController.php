<?php

namespace App\Http\Controllers\admin\salesman;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SalesmanCreateRequest;
use App\Models\Pay;
use App\Models\Route;
use App\Models\Salesman;
use App\Services\salesmanService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    protected $salesmanservice;
    public function __construct()
    {
        $this->salesmanservice = new salesmanService();
    }
    public function index()
    {
        try {
            return view('backend.admin.salesman.index');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function salesmanForm()
    {
        try {
            return view('backend.admin.salesman.create');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function storeSalesman(SalesmanCreateRequest $request)
    {
        try {
            $this->salesmanservice->createSalesman($request);
            return redirect()->back()->with('message', 'New salesman has been created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function salesmanProfile($slug)
    {
        try {
            $salesman = Salesman::where('username', $slug)->first();
            return view('backend.admin.salesman.profile', compact('salesman'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function editFrom($salesmanId)
    {
        try {
            $salesman = Salesman::findorFail($salesmanId);
            return view('backend.admin.salesman.edit', compact('salesman'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function updateSalesman(Request $request, $salesmanId)
    {
        try {
            $this->salesmanservice->updateSalesman($request, $salesmanId);
            return redirect()->route('admin.salesman.edit', $salesmanId)->with('message', 'Salesman updated successfully!');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function routesForm($salesmanId)
    {
        try {
            $salesman = Salesman::findorFail($salesmanId);
            return view('backend.admin.salesman.routes.create', compact('salesman'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function createRoutes(Request $request)
    {
        // Retrieve the necessary data from the request
        $name = $request->input('name');
        $salesmanId = $request->input('salesman_id');
        $assignedById = auth('admin')->user()->id;
        $status = $request->input('status');
        $visit_day = $request->input('visit_day');

        // Call the createRoute method on the routes service
        try {
            $this->salesmanservice->createRoute($name, $salesmanId, $status, $visit_day, $assignedById);
            return back()->with('message', 'Route has been created');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

        // Redirect or return a response as needed
    }
    public function editRouteForm($routeId)
    {
        try {
            $route = Route::findorFail($routeId);
            $salesmen = Salesman::where('status', 'active')->get();
            return view('backend.admin.salesman.edit_route', compact('route', 'salesmen'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function updateRoutes(Request $request, $routeId)
    {
        $name = $request->input('name');
        $salesmanId = $request->input('salesman_id');
        $assignedById = auth('admin')->user()->id;
        $status = $request->input('status');
        $visit_day = $request->input('visit_day');
        try {
            $this->salesmanservice->updateRoute($routeId, $name, $salesmanId, $assignedById, $status, $visit_day);
            return back()->with('message', 'Route has been updated!');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function editPayForm($salesmanId)
    {
        try {
            $pay = Pay::where('salesman_id', $salesmanId)->first();
            return view('backend.admin.salesman.pay.edit', compact('pay', 'salesmanId'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function updatePay($salesmanId, Request $request)
    {
        $salesman_id = $salesmanId;
        $basic = $request->input('basic');
        $medical = $request->input('medical');
        $transport = $request->input('transport');
        $annual_bonus = $request->input('annual_bonus');
        $annual_increment = $request->input('annual_increment');
        $commission_on_sales = $request->input('commission_on_sales');
        try {
            $this->salesmanservice->updateCommission($salesman_id, $basic, $medical, $transport, $annual_bonus, $annual_increment, $commission_on_sales);
            return back()->with('message', 'Pay has been updated / Added');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function deleteSalesman($salesmanId)
    {
        try {
            $salesman = Salesman::findorFail($salesmanId);
            $salesman->deleted_at = Carbon::today();
            $salesman->status = 'block';
            $salesman->save();
            return back()->with('message', 'Salesman has been Deleted');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
