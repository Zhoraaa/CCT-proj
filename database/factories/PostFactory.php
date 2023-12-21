<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'theme' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'post_type_id' => $this->faker->randomElement([1, 2]),
            'author_id' => User::factory(),
            'reply_to' => function (array $attributes) {
                return $attributes['post_type_id'] == 2 ? Post::factory() : null;
            },
        ];
    }
}
