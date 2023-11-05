<?php

namespace App\Http\Livewire\Admin\Salesmen;

use App\Models\Route;
use App\Models\Salesman;
use Livewire\Component;

class CreateRouteComponent extends Component
{
    public $route;
    public $salesman_id;
    public $status;
    public $visit_day;

    protected $rules =[
        'route'=>'required',
        'salesman_id'=>'required',
        'status'=>'required',
        'visit_day'=>'required'
    ];

    public function addRoute()
    {
        $this->validate();
        $route = new Route();
        $route->name = $this->route;
        $route->salesman_id = $this->salesman_id;
        $route->assigned_by_id = auth('admin')->user()->id;
        $route->status = $this->status;
        $route->visit_day = $this->visit_day;
        $route->save();
        session()->flash('message','Route has been created');
        $this->reset();
        
    }
    public function render()
    {
        $salesmans = Salesman::where('status','active')->get();
        return view('livewire.admin.salesmen.create-route-component',compact('salesmans'));
    }
}
