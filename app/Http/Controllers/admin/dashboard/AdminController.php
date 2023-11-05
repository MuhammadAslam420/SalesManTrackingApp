<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateOrUpdateAdminRequest;
use App\Models\Admin;
use App\Services\adminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct(adminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index()
    {
        try{
            return view('backend.admin.admins.index');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function profile()
    {
        try{
            return view('backend.admin.admins.profile');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function create()
    {
        try{
            return view('backend.admin.admins.create');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function edit($adminId)
    {
        try{
            $admin = Admin::findorFail($adminId);
            return view('backend.admin.admins.create',compact('admin'));
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function storeOrUpdate(CreateOrUpdateAdminRequest $request, $adminId = null)
    {
        try {
            $data = $request->validated();
             //dd($data['email']);
            // If adminId is provided, update the admin
            if ($adminId) {
                $admin = Admin::findOrFail($adminId);
                $this->adminService->createAndUpdate($data, $adminId);
            } else {
                // Otherwise, create a new admin
                $this->adminService->createAndUpdate($data);
            }

            return back()->with('message', 'Action success');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
