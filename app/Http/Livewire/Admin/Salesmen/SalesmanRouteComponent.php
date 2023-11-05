<?php

namespace App\Http\Livewire\Admin\Salesmen;

use App\Models\Route;
use Livewire\Component;
use Livewire\WithPagination;
class SalesmanRouteComponent extends Component
{
    use WithPagination;
    public $search;

    public function updateStatus($routeId,$status)
    {
        $route = Route::findorFail($routeId);
        $route->status = $status;
        $route->deleted_at =NULL;
        $route->save();
        session()->flash('message','status has been changed');
    }
    public function render()
    {
        $routes = Route::search($this->search)->sortable()->paginate(10);
        return view('livewire.admin.salesmen.salesman-route-component',['routes'=>$routes]);
    }
}
