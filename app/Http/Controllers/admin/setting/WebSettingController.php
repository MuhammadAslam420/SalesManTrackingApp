<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    public function index()
    {
        try{
            return view('backend.admin.settings.index');
        }
            catch (\Exception $e) {
                $errorMessage = $e->getMessage();
                return view('backend.admin.error', compact('errorMessage'));
            }  
        
    }
}
