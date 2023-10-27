<?php
declare(strict_types=1);


namespace CSCart\Blog\Providers;

use CSCart\Blog\Model\BlogCategory;
use CSCart\Blog\Model\BlogPost;
use CSCart\Core\Context\Api\AdminSchema;
use CSCart\Core\Context\Api\StorefrontSchema;
use CSCart\Framework\GraphQL\Operation\CreateModelMutation;
use CSCart\Framework\GraphQL\Operation\DeleteModelMutation;
use CSCart\Framework\GraphQL\Operation\FetchModelQuery;
use CSCart\Framework\GraphQL\Operation\FetchModelsQuery;
use CSCart\Framework\GraphQL\Operation\UpdateModelMutation;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->app->afterResolving(StorefrontSchema::class, static function (StorefrontSchema $schema) {
            $schema->addQuery('blogPosts', FetchModelsQuery::create(BlogPost::class));
            $schema->addQuery('blogPost', FetchModelQuery::create(BlogPost::class));
            $schema->addQuery('blogCategories', FetchModelsQuery::create(BlogCategory::class));
        });

        $this->app->afterResolving(AdminSchema::class, static function (AdminSchema $schema) {
            $schema->addQuery('blogPosts', FetchModelsQuery::create(BlogPost::class));
            $schema->addQuery('blogPost', FetchModelQuery::create(BlogPost::class));
            $schema->addQuery('blogCategories', FetchModelsQuery::create(BlogCategory::class));

            $schema->addMutation('blogPostCreate', CreateModelMutation::create(BlogPost::class));
            $schema->addMutation('blogPostUpdate', UpdateModelMutation::create(BlogPost::class));
            $schema->addMutation('blogPostDelete', DeleteModelMutation::create(BlogPost::class));

            $schema->addMutation('blogCategoryCreate', CreateModelMutation::create(BlogCategory::class));
            $schema->addMutation('blogCategoryUpdate', UpdateModelMutation::create(BlogCategory::class));
            $schema->addMutation('blogCategoryDelete', DeleteModelMutation::create(BlogCategory::class));
        });
    }
}
