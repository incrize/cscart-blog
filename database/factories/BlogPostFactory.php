<?php

namespace CSCart\Blog\Factories;

use CSCart\Blog\Model\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = BlogPost::class;

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            'title'        => fake()->text(100),
            'content'      => fake()->paragraph(),
            'published_at' => fake()->date(),
            'author_id'    => 1,
        ];
    }
}
