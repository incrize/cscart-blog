<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Input;

use CSCart\Framework\Context\Context;
use CSCart\Framework\Database\Eloquent\Input\ModelInput;

/**
 * @mixin \Dev\CSCart\Blog\Model\Input\BlogPostTagInput\Mixin
 */
class BlogPostTagInput extends ModelInput
{
    /**
     * @inheritDoc
     */
    public function rules(Context $context): array
    {
        return [
            'title' => ['required_if_create', 'filled', 'string']
        ];
    }
}
