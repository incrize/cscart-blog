<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Input;

use CSCart\Framework\Context\Context;
use CSCart\Framework\Database\Eloquent\Input\ModelInput;
use CSCart\Framework\Database\Eloquent\Model;

/**
 * @mixin \Dev\CSCart\Blog\Model\Input\BlogPostInput\Mixin
 */
class BlogPostInput extends ModelInput
{
    /**
     * @inheritDoc
     */
    public function rules(Context $context): array
    {
        return [
            'title'        => ['required_if_create', 'filled', 'string'],
            'content'      => ['required_if_create', 'filled', 'string'],
            'published_at' => ['nullable', 'date'],
            'categories'   => ['relation_required']
        ];
    }

    /**
     * @param \CSCart\Blog\Model\BlogPost $model
     *
     * @inheritDoc
     */
    public function afterFillNewModel(Model $model, Context $context): void
    {
        $model->author_id = $context->getUser()->getAuthIdentifier();
    }
}
