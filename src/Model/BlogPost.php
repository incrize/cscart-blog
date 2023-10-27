<?php
declare(strict_types=1);


namespace CSCart\Blog\Model;


use CSCart\Core\User\Model\User;
use CSCart\Framework\Database\Eloquent\Model;
use CSCart\Framework\Database\Eloquent\Relation\BelongsTo;
use CSCart\Framework\Database\Eloquent\Relation\BelongsToMany;
use CSCart\Framework\Database\Eloquent\Relation\HasMany;
use CSCart\Framework\Shape\Directive\WriteAbility;
use CSCart\Framework\Shape\Schema\Schema;

/**
 * @mixin \Dev\CSCart\Blog\Model\BlogPost\Mixin
 */
class BlogPost extends Model
{
    /**
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @inheritDoc
     */
    public static function getSchema(): Schema
    {
        $schema = new Schema();
        $schema->id('id', 'Post ID');
        $schema->int('author_id', 'Post author ID', WriteAbility::none());
        $schema->string('title', 'Post title');
        $schema->string('content', 'Post content');
        $schema->datetime('updated_at', 'Post updated at');
        $schema->datetime('created_at', 'Post created at');
        $schema->nullableDatetime('published_at', 'Post published at');
        $schema->models('categories', 'Post categories', BlogCategory::class);
        $schema->models('tags', 'Post tags', BlogPostTag::class);
        $schema->model('author', 'Post author', User::class, WriteAbility::none());
        $schema->permissionsNamespace('blog_post');

        return $schema;
    }

    /**
     * @return \CSCart\Framework\Database\Eloquent\Relation\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id', 'author');
    }

    /**
     * @return \CSCart\Framework\Database\Eloquent\Relation\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_categories', 'post_id', 'category_id', 'id', 'id', 'categories')->withTimestamps();
    }

    /**
     * @return \CSCart\Framework\Database\Eloquent\Relation\HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(BlogPostTag::class, 'post_id', 'id');
    }
}
