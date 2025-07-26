<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

it('generates policies for discovered models and skips existing ones', function () {
    $fs = new Filesystem;
    $modelDir = app_path('Models');
    $policyDir = app_path('Policies');
    $fs->ensureDirectoryExists($modelDir);
    $fs->ensureDirectoryExists($policyDir);

    $modelName = 'TestModel';
    $modelPath = $modelDir."/$modelName.php";
    $fs->put($modelPath, <<<PHP
        <?php
        namespace App\Models;
        use Illuminate\Database\Eloquent\Model;
        class $modelName extends Model {}
        PHP);

    $policyPath = $policyDir."/{$modelName}Policy.php";
    if ($fs->exists($policyPath)) {
        $fs->delete($policyPath);
    }

    Artisan::call('make:bulk-policies');

    expect($fs->exists($policyPath))->toBeTrue();

    $originalContent = $fs->get($policyPath);
    Artisan::call('make:bulk-policies');
    expect($fs->get($policyPath))->toBe($originalContent);

    $fs->delete($modelPath);
    $fs->delete($policyPath);
});
