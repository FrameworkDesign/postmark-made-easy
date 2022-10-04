<?php

namespace Weareframework\PostmarkMadeEasy\Library\Installer;

use Facades\Statamic\Console\Processes\Composer;

class Installer
{
    /**
     * @var string
     */
    protected $packages;

    /**
     * Instantiate package updater.
     *
     * @param  array  $packages
     */
    public function __construct(array $packages)
    {
        $this->packages = $packages;
    }

    /**
     * Instantiate package updater.
     *
     * @param  array  $packages
     * @return static
     */
    public static function packages(array $packages)
    {
        return new static($packages);
    }

    /**
     * Install explicit version.
     *
     * @param  string  $version
     */
    public function install(string $version)
    {
        return Composer::requireMultiple($this->packages, $version);
    }

    /**
     * Install explicit version.
     *
     * @param  string  $version
     */
    public function remove(string $version)
    {
        return Composer::removeMultiple($this->packages, $version);
    }
}
