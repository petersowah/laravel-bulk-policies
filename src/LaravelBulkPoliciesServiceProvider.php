<?php

namespace PeterSowah\LaravelBulkPolicies;

use PeterSowah\LaravelBulkPolicies\Commands\LaravelBulkPoliciesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBulkPoliciesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-bulk-policies')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_bulk_policies_table')
            ->hasCommand(LaravelBulkPoliciesCommand::class);
    }
}
