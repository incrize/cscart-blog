<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Policy;

use CSCart\Blog\Model\BlogPost;
use CSCart\Core\Context\Context;
use CSCart\Core\Context\StorefrontContext;
use CSCart\Core\User\Model\User;
use CSCart\Framework\Database\Eloquent\Query\ModelQuery;

class BlogPostPolicy
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
        /** @var \CSCart\Blog\Model\Query\BlogPostQueryFilter $filter */
        $filter = $query->getFilter();

        if ($context instanceof StorefrontContext) {
            $filter->visible = true;
        } elseif (!$user->can('blog_post:manage')) {
            $filter->available_for_user = $user;
        }
    }

    /**
     * @param \CSCart\Core\User\Model\User $user
     * @param \CSCart\Core\Context\Context $context
     * @param \CSCart\Blog\Model\BlogPost  $post
     *
     * @return bool
     */
    public function update(User $user, Context $context, BlogPost $post): bool
    {
        return $post->author_id === $user->id || $user->can('blog_post:manage');
    }

    /**
     * @param \CSCart\Core\User\Model\User $user
     * @param \CSCart\Core\Context\Context $context
     * @param \CSCart\Blog\Model\BlogPost  $post
     *
     * @return bool
     */
    public function delete(User $user, Context $context, BlogPost $post): bool
    {
        return $post->author_id === $user->id || $user->can('blog_post:manage');
    }
}
