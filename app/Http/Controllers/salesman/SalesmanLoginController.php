<?php

namespace App\Http\Controllers\salesman;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder;
use App\Events\LocationUpdateEvent;

class SalesmanLoginController extends Controller
{
    protected $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function showLoginForm()
    {
        return view('auth.salesman.login');

    }

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    try {
        if ($this->loginService->salesmanLogin($credentials)) {
            $ipAddress = $request->ip();

            // Initialize the Geocoder
            $geocoder = app(Geocoder::class);

            // Set the Google Maps API key
            $apiKey = 'AIzaSyDKE74qyuQZ0ctAAZoEsLGjGQGf6XcE3PU';
            Geocoder::setApiKey($apiKey);

            // Geocode the IP address to get the GPS location
            $response = Geocoder::getCoordinatesForAddress($ipAddress);

            // Retrieve the latitude and longitude from the response
            $latitude = $response['lat'];
            $longitude = $response['lng'];

            // Dispatch the LocationUpdateEvent
            event(new LocationUpdateEvent(auth('salesman')->user()->id, $latitude, $longitude));

            return redirect()->route('salesman.dashboard')->with('message', 'Salesman login successfully!');
        }

        return back()->with(['error' => 'Invalid credentials']);
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        return view('backend.admin.error', compact('errorMessage'));
    }
}


}
