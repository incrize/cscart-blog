<?php
declare(strict_types=1);


namespace CSCart\Blog\Seeders;

use CSCart\Core\User\Model\AdminGroup;
use CSCart\Core\User\Model\CustomerGroup;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        CustomerGroup::createPermissions([
            'blog_post:read',
            'blog_category:read',
        ]);

        AdminGroup::createPermissions([
            'blog_post:create',
            'blog_post:update',
            'blog_post:read',
            'blog_post:delete',
            'blog_post:manage',
            'blog_category:create',
            'blog_category:update',
            'blog_category:read',
            'blog_category:delete',
            'blog_category:manage',
        ]);
    }

    public function removePermissions(): void
    {
        CustomerGroup::deletePermissions([
            'blog_post:read',
            'blog_category:read',
        ]);

        AdminGroup::deletePermissions([
            'blog_post:create',
            'blog_post:update',
            'blog_post:read',
            'blog_post:delete',
            'blog_post:manage',
            'blog_category:create',
            'blog_category:update',
            'blog_category:read',
            'blog_category:delete',
            'blog_category:manage',
        ]);
    }
}
