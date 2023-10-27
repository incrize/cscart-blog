<?php

namespace CSCart\Blog\Seeders;

use CSCart\Blog\Factories\BlogCategoryFactory;
use CSCart\Blog\Factories\BlogPostFactory;
use CSCart\Blog\Factories\BlogPostTagFactory;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $categoryFactory = new BlogCategoryFactory();
        $postFactory = new BlogPostFactory();
        $postTagFactory = new BlogPostTagFactory();

        $categories = $categoryFactory->count(5)->create();

        $postFactory
            ->count(1000)
            ->hasAttached($categories, [], 'categories')
            ->has($postTagFactory->count(5), 'tags')
            ->create();
    }
}

