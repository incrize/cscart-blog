<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Input;

use CSCart\Blog\Model\BlogCategory;
use CSCart\Framework\Context\Context;
use CSCart\Framework\Database\Eloquent\Input\ModelInput;
use Illuminate\Validation\Rule;

/**
 * @mixin \Dev\CSCart\Blog\Model\Input\BlogCategoryInput\Mixin
 */
class BlogCategoryInput extends ModelInput
{
    /**
     * @inheritDoc
     */
    public function rules(Context $context): array
    {
        return [
            'title'  => ['required_if_create', 'filled', 'string'],
            'status' => ['required_if_create'],
            'slug'   => ['required_if_create', 'filled', 'string', Rule::unique(BlogCategory::class, 'slug')->ignoreModel($this->getModel())]
        ];
    }
}
