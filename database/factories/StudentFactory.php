<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $schools = School::all();
        foreach ($schools as $school) {
            return [
                'name' => $this->faker->name,
                'school_id' => $school->id,
                'order' => rand(1, 10),
            ];

        }
    }
}
