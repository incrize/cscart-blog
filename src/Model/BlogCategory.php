<?php
declare(strict_types=1);


namespace CSCart\Blog\Model;

use CSCart\Blog\Model\Enum\BlogCategoryStatus;
use CSCart\Framework\Database\Eloquent\Model;
use CSCart\Framework\Shape\Schema\Schema;


/**
 * @mixin \Dev\CSCart\Blog\Model\BlogCategory\Mixin
 */
class BlogCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'blog_categories';

    /**
     * @inheritDoc
     */
    public static function getSchema(): Schema
    {
        $schema = new Schema();
        $schema->id('id', 'Category ID');
        $schema->string('title', 'Category title');
        $schema->string('slug', 'Category slug');
        $schema->enum('status', 'Category status', BlogCategoryStatus::class);
        $schema->datetime('updated_at', 'Updated at');
        $schema->datetime('created_at', 'Created at');

        $schema->permissionsNamespace('blog_category');

        return $schema;
    }
}
