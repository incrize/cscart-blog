<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Query;

use CSCart\Blog\Model\Enum\BlogCategoryStatus;
use CSCart\Core\User\Model\User;
use CSCart\Framework\Database\Eloquent\Query\ModelQueryFilter;
use CSCart\Framework\Database\Eloquent\Builder;
use CSCart\Framework\Shape\Directive\WriteAbility;
use CSCart\Framework\Shape\Schema\Schema;

/**
 * @mixin \Dev\CSCart\Blog\Model\Query\BlogPostQueryFilter\Mixin
 */
class BlogPostQueryFilter extends ModelQueryFilter
{
    /**
     * @inheritDoc
     */
    public static function getSchema(): Schema
    {
        $schema = parent::getSchema();
        $schema->nullableInts('category_ids', 'Filter by category IDs');
        $schema->nullableBool('visible', 'Filter posts by visibility', WriteAbility::private());
        $schema->nullableModel('available_for_user', 'Filter posts by availability for user', User::class, WriteAbility::private());

        return $schema;
    }

    /**
     * @param \CSCart\Framework\Database\Eloquent\Builder $query
     * @param array<int>                                  $categoryIds
     *
     * @return void
     */
    public function applyCategoryIdsFilter(Builder $query, array $categoryIds): void
    {
        $query->whereHas('categories', static function (Builder $query) use ($categoryIds) {
            $query->whereIn('blog_categories.id', $categoryIds);
        });
    }

    /**
     * @param \CSCart\Framework\Database\Eloquent\Builder $query
     * @param \CSCart\Core\User\Model\User                $user
     *
     * @return void
     */
    public function applyAvailableForUserFilter(Builder $query, User $user): void
    {
        $query->where(static function (Builder $q) use ($user) {
            return $q->whereNotNull('published_at')->orWhere('author_id', $user->getKey());
        });
    }

    /**
     * @param \CSCart\Framework\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function applyVisibleFilter(Builder $query): void
    {
        $query->whereHas('categories', static function (Builder $q) {
            $q->where('blog_categories.status', '=', BlogCategoryStatus::ACTIVE);
        });

        $query->whereNotNull('published_at');
    }
}
