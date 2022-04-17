<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//
        ];
    }

    public function configure()
    {
        return
            $this->afterCreating(function (Author $author) {
                $author->profile()->save(App\Profile::class)->make();
            })
                ->afterMaking(function (Author $author) {
                    $author->profile()->save(App\Profile::class)->make();
                });
    }
}
