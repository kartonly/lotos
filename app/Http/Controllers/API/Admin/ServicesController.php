<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicesController extends Controller
{
    protected string $permission = 'rooms';

    public function index()
    {
        $this->can('view');
        $services = Service::all();

        return $services;
    }

    public function item($service){
        $this->can('view');
        $item = Service::where('id', $service)->get();

        return $item;
    }

    public function disabled($service){
        $this->can('update');
        $item = Service::where('id', $service)->get();
        $item->avialable = 0;

        return $item;
    }

    public function delete($service)
    {
        $this->can('delete');
        $item = Service::where('id', $service)->delete();

        return new Response([]);
    }
}
