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
        $this->can('view');
        $bookings = Booking::all();

        return $bookings;
    }

    public function item($booking){
        $this->can('view');
        $item = Booking::where('id', $booking)->get();

        return $item;
    }

    public function disabled($booking){
        $this->can('update');
        $item = Booking::where('id', $booking)->get();
        if ($item->avialable == 0){
            $item->avialable = 1;
        } else {
            $item->avialable = 0;
        }


        return $item;
    }

    public function delete($booking)
    {
        $this->can('delete');
        $item = Booking::where('id', $booking)->delete();

        return new Response([]);
    }
}
