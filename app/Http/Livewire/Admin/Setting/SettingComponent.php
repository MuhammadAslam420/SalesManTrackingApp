<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $google_api;
    public $logo;
    public $copy_write;
    public $new_logo;

    protected $rules = [
        'name' => 'required|string',
        // 'logo' => 'nullable|mimes:jpg,png,jpeg',
        'copy_write' => 'required|string',
        'google_api' => 'required|string',
       // 'new_logo' => 'nullable|mimes:jpg,png,jpeg',
    ];
    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->name = $setting->name;
            $this->google_api = $setting->google_map_api;
            $this->copy_write = $setting->copywrite;
           // $this->logo = $setting->logo;
        }
        // } else {
        //     $setting = new Setting();
        //     $setting->google_map_api = 'google_map_api_key';
        //     $setting->save();
        // }
    }

    public function addSetting()
    {
        $this->validate();
        //dd($this->logo);
        
        $setting = Setting::first();
        if ($setting) {
            $setting->name = $this->name;
            $setting->google_map_api = $this->google_api;
            $setting->copywrite = $this->copy_write;
            // if ($this->new_logo) {
            //     $image = Carbon::now()->timestamp . '.' . $this->new_logo->extension();
            //     $this->new_logo->storeAs('assets/images/logo', $image);
            //     $setting->logo = $image;
            // } 

            $setting->save();
            session()->flash('message', 'New Setting has been updated');

        } else {
            $setting = new Setting();
            $setting->name = $this->name;
            $setting->google_map_api = $this->google_api;
            $setting->copywrite = $this->copy_write;
            // if ($this->new_logo) {
            //     $image = Carbon::now()->timestamp . '.' . $this->new_logo->extension();
            //     $this->new_logo->storeAs('assets/images/logo', $image);
            //     $setting->logo = $image;
            // }
            $setting->save();
            session()->flash('message', 'New Setting has been created');
        }

    }
    public function render()
    {
        return view('livewire.admin.setting.setting-component');
    }
}
