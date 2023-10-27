<?php
declare(strict_types=1);


namespace CSCart\Blog\Model;


use CSCart\Framework\Database\Eloquent\Model;
use CSCart\Framework\Shape\Directive\ReadAbility;
use CSCart\Framework\Shape\Directive\WriteAbility;
use CSCart\Framework\Shape\Schema\Schema;


/**
 * @mixin \Dev\CSCart\Blog\Model\BlogPostTag\Mixin
 */
class BlogPostTag extends Model
{
    /**
     * @var string
     */
    protected $table = 'blog_post_tags';

    /**
     * @inheritDoc
     */
    public static function getSchema(): Schema
    {
        $schema = new Schema();

        $schema->id('id', 'Post tag ID');
        $schema->string('title', 'Post tag title');
        $schema->int('post_id', 'Post ID', WriteAbility::none(), ReadAbility::none());
        $schema->datetime('updated_at', 'Post tag updated at');
        $schema->datetime('created_at', 'Post tag created at');
        $schema->permissionsNamespace('blog_post');

        return $schema;
    }
}
