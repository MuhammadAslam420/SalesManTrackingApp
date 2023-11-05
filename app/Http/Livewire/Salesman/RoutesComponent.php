<?php

namespace App\Http\Livewire\Salesman;

use App\Models\Route;
use Carbon\Carbon;
use Livewire\Component;

class RoutesComponent extends Component
{

    public function render()
    {
        $route = Route::where('salesman_id',auth('salesman')->user()->id)->where('status','active')->where('visit_day', Carbon::now()->englishDayOfWeek)->first();
        //dd($route);
        return view('livewire.salesman.routes-component',['route'=>$route]);
    }
}
