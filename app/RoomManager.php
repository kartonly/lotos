<?php


namespace App;


use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomManager
{
    private ?Room $room;

    public function __construct(?Room $room = null)
    {
        $this->room = $room;
    }

    public function create(array $params): Room
    {
        try {
            DB::beginTransaction();

            $this->room = app(Room::class);
            $this->room->fill($params);
            $this->room->save();
            DB::commit();

            return $this->room;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function delete(){
        $this->room->booking()->delete();
        $this->room->delete();
    }
}
