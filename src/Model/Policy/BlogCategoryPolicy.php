<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Policy;

use CSCart\Blog\Model\Enum\BlogCategoryStatus;
use CSCart\Core\Context\Context;
use CSCart\Core\Context\StorefrontContext;
use CSCart\Core\User\Model\User;
use CSCart\Framework\Database\Eloquent\Query\Filter\EnumFilter;
use CSCart\Framework\Database\Eloquent\Query\ModelQuery;

class BlogCategoryPolicy
{
    /**
     * @param \CSCart\Core\User\Model\User                         $user
     * @param \CSCart\Core\Context\Context                         $context
     * @param \CSCart\Framework\Database\Eloquent\Query\ModelQuery $query
     *
     * @return void
     */
    public function query(User $user, Context $context, ModelQuery $query): void
    {
        /** @var \CSCart\Blog\Model\Query\BlogCategoryQueryFilter $filter */
        $filter = $query->getFilter();

        if ($context instanceof StorefrontContext) {
            $filter->status = EnumFilter::eq(BlogCategoryStatus::ACTIVE);
        }
    }
}
