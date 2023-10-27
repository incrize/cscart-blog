<?php

namespace CSCart\Blog\Factories;

use CSCart\Blog\Model\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCategoryFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = BlogCategory::class;

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            'title'  => fake()->text(50),
            'status' => 'A',
            'slug'   => fake()->slug(),
        ];
    }
}
