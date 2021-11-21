<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use App\RoomManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    protected string $permission = 'rooms';

    public function index(Request $request)
    {
        $rooms = Room::all();

        return RoomResource::collection($rooms)->toArray($request);
    }

    public function item($room){

        $item = Room::where('id', $room)->get();

        return new RoomResource($item);
    }

    public function disabled($room){

        $item = Room::where('id', $room)->first();
        if ($item->available == 0){
            $item->available = 1;
            $item->save();
        } else {
            $item->available = 0;
            $item->save();
        }

        return new RoomResource($item);
    }

    public function delete(Room $room)
    {

        app(RoomManager::class, ['room' => $room])->delete();

        return new Response([]);
    }

    public function create(Request $request){
        $clientManager = app(RoomManager::class);
        $room = $clientManager->create($request->all());

        return new RoomResource($room);
    }
}
