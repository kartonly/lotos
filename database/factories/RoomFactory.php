<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_name' => $this->faker-> userName,
            'room_number' => 2,
            'about_room' => $this->faker->text,
            'price_per_night' => 3000,
            'photo' => '1.jpg',
        ];
    }
}
