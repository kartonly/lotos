<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicesController extends Controller
{
    protected string $permission = 'rooms';

    public function index()
    {
        $services = Service::all();

        return $services;
    }

    public function item($service){
        $item = Service::where('id', $service)->get();

        return $item;
    }

    public function disabled($service){
        $item = Service::where('id', $service)->get();
        $item->available = 0;

        return $item;
    }

    public function delete($service)
    {
        $item = Service::where('id', $service)->delete();

        return new Response([]);
    }
}
