<?php
declare(strict_types=1);


namespace CSCart\Blog\Model\Enum;

enum BlogCategoryStatus: String
{
    case ACTIVE = 'A';
    case DISABLED = 'D';
}
