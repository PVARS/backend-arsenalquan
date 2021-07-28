<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login_id' => $this->faker->name(),
            'role_id' => 1,
            'email' => $this->faker->unique()->safeEmail(),
            'full_name' => $this->faker->name(),
            'disabled' => false,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'reset_link_token' => Str::random(10),
            'token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
