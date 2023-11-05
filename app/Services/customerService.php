<?php

namespace App\Services;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Geocoder\Facades\Geocoder;

class CustomerService
{
    public function createCutomer(Request $request)
    {
        try {
            $customer = new Customer();
            $address = $request->input('address');

            // Geocode the address to get latitude and longitude
            $geocoderResponse = Geocoder::getCoordinatesForAddress($address);
            //dd($geocoderResponse,$data['mobile']);

            $avatar = null;
            if ($request->hasFile('avatar')) {
                $avatar = Carbon::now()->timestamp . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->storeAs('assets/images/faces', $avatar);
            }

            $customer->username = $request->input('username');
            $customer->shopname = $request->input('shopname');
            $customer->email = $request->input('email');
            $customer->mobile = $request->input('mobile');
            $customer->city = $request->input('city');
            $customer->address = $address;
            $customer->lng = $geocoderResponse['lng'];
            $customer->lat = $geocoderResponse['lat'];
            $customer->avatar = $avatar;
            $customer->status = $request->input('status');
            $customer->password = Hash::make('password');
            $customer->created_by = auth('admin')->user()->id;
            $customer->save();

            return response()->json('success', 200);
        } catch (\Exception ) {
            return response()->json('error', 201);
        }

    }
    public function customerUpdate(Request $request)
{
    try {
        $customer = Customer::findOrFail($request->input('id'));
        $address = $request->input('address');

        // Geocode the address to get latitude and longitude
        $geocoderResponse = Geocoder::getCoordinatesForAddress($address);

        // Handle the avatar file upload
        $avatar = $customer->avatar;
        if ($request->hasFile('avatar')) {
            $avatar = Carbon::now()->timestamp . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->storeAs('assets/images/faces', $avatar);
        }

        $customer->username = $request->input('username');
        $customer->shopname = $request->input('shopname');
        $customer->email = $request->input('email');
        $customer->mobile = $request->input('mobile');
        $customer->city = $request->input('city');
        $customer->address = $address;
        $customer->lng = $geocoderResponse['lng'];
        $customer->lat = $geocoderResponse['lat'];
        $customer->avatar = $avatar;
        $customer->status = $request->input('status');
        $customer->save();

        return response()->json('success', 200);
    } catch (\Exception $e) {
        return response()->json('error', 201);
    }
}

}
