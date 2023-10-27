<?php

namespace CSCart\Blog\Factories;

use CSCart\Blog\Model\BlogPostTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostTagFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = BlogPostTag::class;

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            'title' => fake()->word()
        ];
    }
}
