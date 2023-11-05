<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDAshboardController extends Controller
{
    public function index()
    {
        try{
            return view('backend.customer.index');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function edit()
    {
        try{
            return view('backend.customer.edit');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function profile()
    {
        try{
            return view('backend.customer.profile');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function orders()
    {
        try{
            return view('backend.customer.orders');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function resetPassword()
    {
        try{
            return view('backend.customer.reset');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/customer/login')->with('message','You Logout Successfully!');
    }
}
