<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'project_id' => null,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'position' => $this->faker->jobTitle,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
