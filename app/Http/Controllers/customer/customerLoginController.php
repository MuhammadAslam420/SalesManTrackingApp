<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Models\Customer;
use App\Services\LoginService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class customerLoginController extends Controller
{
    protected $loginservice;
    public function __construct(loginService $loginService)
    {
        $this->loginservice = $loginService;
    }
    public function showLoginForm()
    {
        return view('auth.customer.login');

    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if ($this->loginservice->customerLogin($credentials)) {
                return redirect()->route('customer.dashboard')->with('message', 'customer login successfully!');
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function showRegistrationForm()
    {
        try
        {
            return view('auth.customer.register');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function register(CustomerCreateRequest $request)
    {
        $request->validated();
        $password = $request->input('password');
        try
        {
            if ($request->hasFile('avatar')) {
                $image = 'avatar.jpg';
                $image = Carbon::now()->timestamp . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->storeAs('assets/images/faces', $image);
            }

            Customer::create([
                'username' => $request->input('username'),
                'shopname' => $request->input('shopname'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
                'avatar' => $image,
                'status' => 'inactive',
                'password' => Hash::make($password),
                'created_by' => 1,
            ]);
            return redirect()->route('customer.login')->with('message', 'Your account was created successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
}
