<?php

namespace App\Services;

use App\Models\Pay;
use App\Models\Route;
use App\Models\RouteCustomer;
use App\Models\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Geocoder\Facades\Geocoder;

class salesmanService
{
    public function slug($name)
    {
        $slug = Str::slug($name, '-');
        return $slug;
    }
    public function createSalesman(Request $request)
    {
        try {
            $address = $request->input('address');
            $geocoderResponse = Geocoder::getCoordinatesForAddress($address);

            $slug = $this->slug($request->input('name'));

            $avatar = null;
            if ($request->file('avatar')) {
                $avatar = Carbon::now()->timestamp . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->storeAs('assets/images/faces', $avatar);
            }

            $salesman = Salesman::create([
                'name' => $request->input('name'),
                'username' => $slug . '-' . $request->input('employee_no'),
                'employee_no' => $request->input('employee_no'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'city' => $request->input('city'),
                'address' => $address,
                'lng' => $geocoderResponse['lng'],
                'lat' => $geocoderResponse['lat'],
                'avatar' => $avatar,
                'status' => $request->input('status'),
                'online' => 'offline',
                'password' => Hash::make($request->input('password')),
                'remember_token' => Str::random(10),
                'created_by' => auth('admin')->user()->id,
            ]);
            $pay = Pay::where('salesman_id', $salesman->id)->first();
            if (!$pay) {
                Pay::create([
                    'salesman_id' => $salesman->id,
                ]);
            }
            return response()->json('message', 200);

        } catch (\Exception $e) {
            return response()->json('error', 201);
        }
    }
    public function updateSalesman(Request $request, $salesmanId)
    {
        try {
            $address = $request->input('address');
            $geocoderResponse = Geocoder::getCoordinatesForAddress($address);

            $salesman = Salesman::findOrFail($salesmanId);
            $salesman->name = $request->input('name');
            $salesman->username = $request->input('username');
            $salesman->employee_no = $request->input('employee_no');
            $salesman->email = $request->input('email');
            $salesman->mobile = $request->input('mobile');
            $salesman->city = $request->input('city');
            $salesman->address = $address;
            $salesman->lng = $geocoderResponse['lng'];
            $salesman->lat = $geocoderResponse['lat'];
            $salesman->status = $request->input('status');

            if ($request->file('avatar')) {
                // Delete previous avatar if needed
                // ...

                $avatar = Carbon::now()->timestamp . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->storeAs('assets/images/faces', $avatar);
                $salesman->avatar = $avatar;
            }

            $salesman->save();
            $pay = Pay::where('salesman_id', $salesmanId)->first();
            if (!$pay) {
                Pay::create([
                    'salesman_id' => $salesmanId,
                ]);
            }

            return response()->json('message', 200);
        } catch (\Exception $e) {
            return response()->json('error', 201);
        }
    }
    public function createRoute($name, $salesmanId, $status,$visit_day, $assignedById)
    {
        // Create a new route record in the database
        try {
            Route::create([
                'name' => $name,
                'salesman_id' => $salesmanId,
                'assigned_by_id' => $assignedById,
                'status' => $status,
                'visit_day' => $visit_day,
            ]);
            return response()->json('message', 200);
        } catch (\Exception ) {
            return response()->json('error', 201);
        }
    }
    public function updateRoute($routeId, $name, $salesmanId, $assignedById, $status,$visit_day)
    {
        try {
            // Find the route by its ID
            $route = Route::findOrFail($routeId);
            if ($route->status === 'deleted') {
                // Update the route record with the new data
                $route->update([
                    'name' => $name,
                    'salesman_id' => $salesmanId,
                    'assigned_by_id' => $assignedById,
                    'status' => $status,
                    'visit_day' =>$visit_day,
                    'deleted_at' => NULL,
                ]);
            } else {
                // Update the route record with the new data
                $route->update([
                    'name' => $name,
                    'salesman_id' => $salesmanId,
                    'assigned_by_id' => $assignedById,
                    'status' => $status,
                    'visit_day' =>$visit_day,
                ]);
            }
            $rt_cust = RouteCustomer::where('route_id', $routeId)->first();
            if ($rt_cust) {
                $rt_cust->deleted_at = null;
                $rt_cust->save();
            }
            return response()->json('success', 200);
        } catch (\Exception ) {
            return response()->json('error', 201);
        }
    }
    public function createRouteCustomer($routeId, $customerIds)
    {
        $routeCustomer = new RouteCustomer();
        $routeCustomer->route_id = $routeId;
        $routeCustomer->customer_id = $customerIds;
        $routeCustomer->save();

        return $routeCustomer;
    }
    public function updateRouteCustomer($routeCustomerId, $customerIds)
    {
        $routeCustomer = RouteCustomer::findOrFail($routeCustomerId);
        $routeCustomer->customer_id = $customerIds;
        $routeCustomer->save();

        return $routeCustomer;
    }
    public function updateCommission($salesman_id, $basic, $medical, $transport, $annual_bonus, $annual_increment, $commission_on_sales)
    {
        try {
            $commission = Pay::where('salesman_id', $salesman_id)->first();
            if ($commission) {
                $commission->Update([
                    'basic' => $basic,
                    'medical' => $medical,
                    'transport' => $transport,
                    'annual_bonus' => $annual_bonus,
                    'annual_increment' => $annual_increment,
                    'commission_on_sales' => $commission_on_sales,
                ]);
                return response()->json('message', 200);
            } else {
                Pay::create([
                    'salesman_id' => $salesman_id,
                    'basic' => $basic,
                    'medical' => $medical,
                    'transport' => $transport,
                    'annual_bonus' => $annual_bonus,
                    'annual_increment' => $annual_increment,
                    'commission_on_sales' => $commission_on_sales,

                ]);
                return response()->json('message', 200);
            }
        } catch (\Exception ) {
            return response()->json('error', 201);
        }

    }

}
