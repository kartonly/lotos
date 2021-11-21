<?php


namespace App;


use App\Models\Booking;
use App\Models\Service;
use App\Models\ServicesBookings;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingManager
{
    private ?Booking $booking;

    public function __construct(?Booking $booking = null)
    {
        $this->booking = $booking;
    }

    public function create(array $data, $customer, $room, $count, array $reqServices): ?Booking
    {
        $this->booking = app(Booking::class);
        $this->booking->user_id = $customer;
        $this->booking->room_id = $room;

        $allServices = Service::all();
        $serSum = 0;
        foreach ($allServices as $allService){
            foreach ($reqServices as $reqService){
                if ($allService->id = $reqService['id']){
                    $serSum = $serSum + $allService->price;
                }
            }
        }
        $count=$count+$serSum;

        $this->booking->summ = $count;
        $this->booking->start = $data["start"];
        $this->booking->end = $data["end"];
        $this->booking->fill($data);
        $this->booking->save();

        if ($reqServices != null){
            foreach ($reqServices as $reqService){
                $this->service = new ServicesBookings;
                $this->service->booking_id = $this->booking->id;
                $this->service->service_id = $reqService['id'];
                $this->service->save();
            }
        }


        return $this->booking;
    }
}
