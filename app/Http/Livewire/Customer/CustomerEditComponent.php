<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Spatie\Geocoder\Facades\Geocoder;
use Illuminate\Validation\Rule;


class CustomerEditComponent extends Component
{

    public $username;
    public $shopname;
    public $email;
    public $mobile;
    public $address;

    protected $rules;

    public function mount()
    {

        $customer = Customer::findOrFail(auth('customer')->user()->id);
        $this->username = $customer->username;
        $this->shopname = $customer->shopname;
        $this->email = $customer->email;
        $this->mobile = $customer->mobile;
        $this->address = $customer->address;
    }

    public function editCustomer()
    {
        $this->validate([
            'username' => 'required|string|min:6',
            'shopname' => 'required|string|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore(auth('customer')->user()->id),
            ],
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('customers')->ignore(auth('customer')->user()->id),
            ],
            'address' => 'required'
        ]);

        try {
            $geocoderResponse = Geocoder::getCoordinatesForAddress($this->address);
            $customer = Customer::findOrFail(auth('customer')->user()->id);
            $customer->username = $this->username;
            $customer->shopname = $this->shopname;
            $customer->email = $this->email;
            $customer->mobile = $this->mobile;
            $customer->address = $this->address;
            $customer->lat = $geocoderResponse['lat'];
            $customer->lng = $geocoderResponse['lng'];
            $customer->save();
            session()->flash('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-edit-component');
    }
}
