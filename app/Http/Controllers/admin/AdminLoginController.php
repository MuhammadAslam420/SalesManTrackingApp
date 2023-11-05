<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if ($this->loginService->adminLogin($credentials)) {
                return redirect()->route('admin.dashboard')->with('message','Admin login successfully!');
            }
            return back()->with(['error' => 'Invalid credentials']);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function showRegistrationForm()
    {

    }
    public function register()
    {

    }
}
