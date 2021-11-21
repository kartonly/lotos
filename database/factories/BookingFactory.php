<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => 1,
            'user_id' => 1,
            'summ' => 1000,
            'available' => 1,
            'start' => $this->faker->date,
            'end' => $this->faker->date
        ];
    }
}
