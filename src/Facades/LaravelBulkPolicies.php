<?php

namespace PeterSowah\LaravelBulkPolicies\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PeterSowah\LaravelBulkPolicies\LaravelBulkPolicies
 */
class LaravelBulkPolicies extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PeterSowah\LaravelBulkPolicies\LaravelBulkPolicies::class;
    }
}
