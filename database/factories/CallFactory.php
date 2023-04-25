<?php

namespace Database\Factories;

use App\Models\Call;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Call::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomDigitNotNull,
        'state_id' => $this->faker->randomDigitNotNull,
        'locality_id' => $this->faker->randomDigitNotNull,
        'htype_id' => $this->faker->randomDigitNotNull,
        'sec_status' => $this->faker->word,
        'details' => $this->faker->text,
        'area' => $this->faker->word,
        'address' => $this->faker->word,
        'phone' => $this->faker->word,
        'phone2' => $this->faker->word,
        'img' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull,
        'comment' => $this->faker->randomDigitNotNull,
        'updated_by' => $this->faker->randomDigitNotNull,
        'assigned_by' => $this->faker->randomDigitNotNull,
        'completed_by' => $this->faker->randomDigitNotNull,
        'confirmed_by' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->word,
        'user_id' => $this->faker->word
        ];
    }
}
