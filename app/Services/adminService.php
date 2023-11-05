<?php

namespace App\Services;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function createAndUpdate($data, $adminId = null)
    {
        if ($adminId) {
            // Update existing admin
            $admin = Admin::findOrFail($adminId);
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->mobile = $data['mobile'];
            $admin->status = $data['status'];

            // Check if avatar is provided
            if (isset($data['avatar'])) {
                // Store new avatar
                $image = Carbon::now()->timestamp . '.' . $data['avatar']->getClientOriginalExtension();
                $data['avatar']->storeAs('assets/images/faces', $image);
                $admin->avatar = $image;
            }

            $admin->save();
        } else {
            // Create new admin
            $admin = new Admin();
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->mobile = $data['mobile'];
            $admin->status = $data['status'];
            $admin->password = Hash::make('password');

            // Check if avatar is provided
            if (isset($data['avatar'])) {
                // Store new avatar
                $image = Carbon::now()->timestamp . '.' . $data['avatar']->getClientOriginalExtension();
                $data['avatar']->storeAs('assets/images/faces', $image);
                $admin->avatar = $image;
            }

            $admin->save();
        }
    }
}
