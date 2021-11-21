<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    protected string $permission = 'rooms';

    public function index()
    {

        $bookings = Booking::all();

        return $bookings;
    }

    public function item($booking){

        $item = Booking::where('id', $booking)->get();

        return $item;
    }

    public function disabled($booking){

        $item = Booking::where('id', $booking)->get();
        if ($item->avialable == 0){
            $item->avialable = 1;
            $item->save();
        } else {
            $item->avialable = 0;
            $item->save();
        }


        return $item;
    }

    public function delete($booking)
    {
        ;
        $item = Booking::where('id', $booking)->delete();

        return new Response([]);
    }
}
