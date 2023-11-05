<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminProfileComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $avatar;
    public $password;

    public function mount()
    {
        try{
            $admin = Admin::findorFail(auth('admin')->user()->id);
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->mobile = $admin->mobile;
            $this->avatar = $admin->avatar;
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function updateProfile()
    {
       // dd($this->new_avatar);
        try{
            $admin = Admin::findorFail(auth('admin')->user()->id);
            $admin->name = $this->name;
            $admin->email = $this->email;
            $admin->mobile = $this->mobile;

            // if($this->new_avatar)
            // {
            //     $image = Carbon::now()->timestamp. '.' . $this->new_avatar->extension();
            //     $this->new_avatar->storeAs('assets/images/faces',$image);

            //     $admin->avatar = $image;
            // }
            $admin->save();
            session()->flash('success','Profile Updated');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }

    }
    public function resetPassword()
    {
        try{
            $admin = Admin::findorFail(auth('admin')->user()->id);
            $admin->password = Hash::make($this->password);
            $admin->save();
            session()->flash('success','password reset');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }

    }
    public function render()
    {
        return view('livewire.admin.admins.admin-profile-component');
    }
}
