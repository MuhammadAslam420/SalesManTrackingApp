<?php

namespace App\Http\Livewire\Salesman;

use App\Models\Salesman;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed'
    ];

    public function updatePassword()
{
    $this->validate();

    // Perform the password update logic here
    // Retrieve the authenticated user
    $user = Salesman::findorFail(auth('salesman')->user()->id);

    // Check if the current password matches the user's stored password
    if (!Hash::check($this->current_password, $user->password)) {
        $this->addError('current_password', 'The current password is incorrect.');
        return;
    }

    // Update the password
    $user->password = Hash::make($this->password);
    $user->save();

    // Reset the input fields after successful update
    $this->reset(['current_password', 'password', 'password_confirmation']);

    // Show a success message
    session()->flash('success', 'Password updated successfully!');
}


    public function render()
    {
        return view('livewire.salesman.reset-password-component');
    }
}

