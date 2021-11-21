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
        $now = Carbon::now();
        $dif = $end->diffInDays($start);

        $count = $count*$dif;

        $rooms = Room::whereHas('booking', function($q) use ($start, $end){
            $q->where('start','<=',$end)->where('end','>=',$start);
        })->where('available', 1)->where('id', $room)->get()->count();

        $freeRoom = Room::where('id', $room)->has('booking')->get()->count();

        if ((($rooms==0) or ($freeRoom=0)) and (($start->getTimestamp()>=$now->getTimestamp()) and ($end->getTimestamp()>=$now->getTimestamp()))){
            $bookingManager = app(BookingManager::class);
            $bookingManager->create($request->all(), $customer, $room, $count, $reqServices);

            return (new Response([], 200))->header('Access-Control-Allow-Origin', '*');
        } else {
            return (new Response(['Номер занят в эти даты'], 200))->header('Access-Control-Allow-Origin', '*');
        }
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

        $serSum = 0;
        foreach ($allServices as $allService){
            foreach ($reqServices as $reqService){
                if ($allService->id = $reqService['id']){
                    $serSum = $serSum + $allService->price;
                }
            }
        }
        $count = $count+$serSum;

        $myservices = Service::where('id', $reqServices)->get();

        return (new Response([$count, $dif, $myservices], 200))->header('Access-Control-Allow-Origin', '*');
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
