<?php
declare(strict_types=1);


namespace CSCart\Blog;

use CSCart\Blog\Seeders\PermissionSeeder;
use CSCart\Blog\Seeders\DatabaseSeeder;
use CSCart\Framework\Package\Installer\PackageUninstallerInterface;
use CSCart\Framework\Package\Installer\PackageInstallerInterface;

class Installer implements PackageInstallerInterface, PackageUninstallerInterface
{
    /**
     * @inerhitDoc
     */
    public function install(): void
    {
        $seeder = app(DatabaseSeeder::class);
        $seeder->run();
    }

    /**
     * @inerhitDoc
     */
    public function uninstall(): void
    {
        $this->removePermissions();
    }

    /**
     * Revokes permissions
     *
     * @return void
     */
    private function removePermissions(): void
    {
        $seeder = new PermissionSeeder();
        $seeder->removePermissions();
    }
}
