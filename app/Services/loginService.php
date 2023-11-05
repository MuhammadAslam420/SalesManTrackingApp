<?php

namespace App\Services;

use App\Models\Salesman;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function adminLogin($credentials)
    {
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('message','Admin Login Successfully!') ;
            }
        return back()->with(['error' => 'Invalid credentials']);
    }

    public function salesmanLogin($credentials)
{
    if (Auth::guard('salesman')->attempt($credentials)) {
        $salesman = Salesman::find(Auth::guard('salesman')->user()->id);
        $salesman->online = 'online';
        $salesman->save();
        return redirect()->route('salesman.dashboard')->with('message', 'Salesman logged in successfully!');
    }

    return back()->with(['error' => 'Invalid credentials']);
}

    public function customerLogin($credentials)
    {
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard')->with('message','customer Login Successfully!') ;
            }
        return back()->with(['error' => 'Invalid credentials']);

    }
}
