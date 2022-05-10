<?php

namespace Database\Factories;

use App\Models\{
    Job,
    User,
    Province,
    City
};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            //
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'time' => $this->faker->randomDigit(3),
            //'province_id'=> $this->faker->randomElement([1,2,3,4,5,6]),
            'city_id'=> $this->faker->numberBetween(1, 1391),
            //'category_id'=> $this->faker->numberBetween(1, 3),
            'profession_id'=> $this->faker->numberBetween(1, 9),
        ];
    }
}
