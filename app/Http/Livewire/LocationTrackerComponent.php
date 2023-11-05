<?php

namespace App\Http\Livewire;

use App\Models\RouteHistory;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Spatie\Geocoder\Facades\Geocoder;

class LocationTrackerComponent extends Component
{
    protected $listeners = ['echo-private:location-channel,LocationUpdateEvent' => 'updateLocation'];

    public function mount()
    {
        $user = auth('salesman')->user();

        if ($user) {
            $this->startTracking($user->id);
        }
    }

    public function startTracking($salesmanId)
    {
        // Get the IP address of the salesman
        try {
            $ipAddress = Request::ip();
            // Initialize the Geocoder
            $geocoder = app(Geocoder::class);

            // Set the Google Maps API key
            $apiKey = 'AIzaSyDH3sy54TYQgdd2y-xCIjT41rmw2DOP2hg';
            Geocoder::setApiKey($apiKey);

            // Geocode the IP address to get the GPS location
            $response = Geocoder::getCoordinatesForAddress($ipAddress);

            // Retrieve the latitude and longitude from the response
            $latitude = $response['lat'];
            $longitude = $response['lng'];
            // Store the initial location in the route_histories table
            RouteHistory::create([
                'salesman_id' => $salesmanId,
                'lat' => $latitude,
                'lng' => $longitude,
                'timestamp' => now(),
            ]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function updateLocation($payload)
    {
        try {
            $salesmanId = $payload['salesman_id'];
            $latitude = $payload['latitude'];
            $longitude = $payload['longitude'];

            // Update the location in the location_histories table
            RouteHistory::create([
                'salesman_id' => $salesmanId,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'timestamp' => now(),
            ]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function render()
    {
        return view('livewire.location-tracker-component');
    }
}
