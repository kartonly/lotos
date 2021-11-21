<?php


namespace App\Http\Controllers\API\User;


use App\BookingManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::all();

        return RoomResource::collection($rooms)->toArray($request);
    }

    public function dates(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

//        $dateStart = Carbon::parse($start);
//        $dateEnd = Carbon::parse($end);

//        $booking = Booking::where('start','>=',$start)->get();
//        return $booking;

       $rooms = Room::whereHas('booking', function($q) use ($start, $end){
            $q->where('start','>=',$end)->orWhere('end','<=',$start);
        })->where('available', 1)->get();

        return (new Response(RoomResource::collection($rooms)->toArray($rooms), 200))->header('Access-Control-Allow-Origin', '*');
    }

    public function item($room)
    {
        $item = Room::where('id', $room)->first();

        return (new Response(new RoomResource($item), 200))->header('Access-Control-Allow-Origin', '*');
    }

    public function booking(RoomRequest $request, $room){
        $customer = User::all()
            ->find(Auth::user())->id;
        $item = Room::where('id', $room)->first();
        $count = $item->price_per_night;
        $reqServices = $request->services;

        $start = Carbon::parse($request['start']);
        $end = Carbon::parse($request['end']);
        $dif = $end->diffInDays($start);

        $count = $count*$dif;

        $bookingManager = app(BookingManager::class);
        $bookingManager->create($request->all(), $customer, $room, $count, $reqServices);

        return (new Response([], 200))->header('Access-Control-Allow-Origin', '*');
    }

    public function checkSum(Request $request, $room){

        $item = Room::where('id', $room)->first();
        $count = $item->price_per_night;
        $reqServices = $request->services;

        $start = Carbon::parse($request['start']);
        $end = Carbon::parse($request['end']);
        $dif = $end->diffInDays($start);

        $count = $count*$dif;

        $allServices = Service::all();
        foreach ($allServices as $allService){
            foreach ($reqServices as $reqService){
                if ($allService->id = $reqService['id']){
                    $count = $count + $allService->price;
                }
            }
        }

        return (new Response([$count, $dif], 200))->header('Access-Control-Allow-Origin', '*');
    }

    public function bookingGet(RoomRequest $request, $room){
        $bookings = Booking::where('room_id', $room);

        return $bookings;
    }

    public function getServices(){
        $services = Service::where('available', 1)->get();

        return $services;
    }


//    public function test(Request $request){
//        $reqServices = $request->services;
//        $count=0;
//        DB::table('services')->orderBy('id')->chunk(100, function ($services, $reqServices, $count) {
//            foreach ($services as $service) {
//                foreach ($reqServices as $req){
//                    if ($service->id == $req->id){
//                        $count = $count+$service->price;
//                    }
//                }
//            }
//        });
//        return $count;
//    }
}
