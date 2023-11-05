<?php
namespace App\Services;

use App\Models\RouteCustomer;

class RouteCustomerService
{
    public function createRouteCustomer($route_Id, $customerIds)
    {
        try {
            //dd($customerIds);
            $routeCustomer = new RouteCustomer();
            $routeCustomer->route_id = $route_Id;
            $routeCustomer->customer_id = implode(',', $customerIds);
            $routeCustomer->save();
            //dd($routeCustomer);
            return response()->json('message', 200);
        } catch (\Exception ) {
            return response()->json('error', 201);
        }
    }

    public function updateRouteCustomer($routeCustomerId, $customerIds)
{
    try {
        $routeCustomer = RouteCustomer::where('route_id', $routeCustomerId)->first();
        $routeCustomer->customer_id = $customerIds;
        $routeCustomer->save();
        return response()->json('success', 200);
    } catch (\Exception ) {
        return response()->json('error', 201);
    }
}

}
