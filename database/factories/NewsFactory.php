<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => 1,
            'title' => $this->faker->name(),
            'short_description' => $this->faker->name(),
            'thumbnail' => $this->faker->filePath(),
            'content' => $this->faker->text(),
            'key_word' => $this->faker->shuffleArray(),
            'view' => 0,
            'slug' => $this->faker->slug(),
            'approve' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
