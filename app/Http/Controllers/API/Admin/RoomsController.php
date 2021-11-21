<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\RoomManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomsController extends Controller
{
    protected string $permission = 'rooms';

    public function index(Request $request)
    {
        $this->can('view');

        $rooms = Room::all();

        return RoomResource::collection($rooms)->toArray($request);
    }

    public function item($room){
        $this->can('view');

        $item = Room::where('id', $room)->get();

        return new RoomResource($item);
    }

    public function disabled($room){
        $this->can('update');

        $item = Room::where('id', $room)->get();
        if ($item->avialable == 0){
            $item->avialable = 1;
        } else {
            $item->avialable = 0;
        }

        return new RoomResource($item);
    }

    public function delete(Room $room)
    {
        $this->can('delete');

        app(RoomManager::class, ['room' => $room])->delete();

        return new Response([]);
    }

    public function create(Request $request){
        $clientManager = app(RoomManager::class);
        $room = $clientManager->create($request->all());

        return new RoomResource($room);
    }
}
