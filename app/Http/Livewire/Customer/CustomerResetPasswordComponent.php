<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CustomerResetPasswordComponent extends Component
{
    public $password;
    public $current_password;
    public $password_confirmation;
    protected $rules  = [
        'password' =>'required|min:6|confirmed',
        'current_password'=>'required'
    ];
    public function updatePassword()
    {
        $this->validate();

        // Perform the password update logic here
        // Retrieve the authenticated user
        $user = Customer::findorFail(auth('customer')->user()->id);

        // Check if the current password matches the user's stored password
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        // Update the password
        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success','Password reset successfully');

        // Reset the input fields after successful update
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }
    public function render()
    {
        return view('livewire.customer.customer-reset-password-component');
    }
}
