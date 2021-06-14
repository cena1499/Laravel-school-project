<?php

namespace Database\Factories;

use App\Models\Body_Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class Body_PartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Body_Part::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "záda"
        ];
    }
}
