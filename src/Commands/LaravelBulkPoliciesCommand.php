<?php

namespace PeterSowah\LaravelBulkPolicies\Commands;

use Illuminate\Console\Command;

class LaravelBulkPoliciesCommand extends Command
{
    public $signature = 'make:bulk-policies';

    public $description = 'Generate policies for all Eloquent models in app/Models and app';

    public function handle(): int
    {
        $modelDirectories = [
            app_path('Models'),
            app_path(),
        ];
        $models = collect();

        foreach ($modelDirectories as $dir) {
            if (! is_dir($dir)) {
                continue;
            }
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
            foreach ($files as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $relativePath = str_replace(app_path().'/', '', $file->getPathname());
                    $class = 'App\\'.str_replace(['/', '.php'], ['\\', ''], $relativePath);
                    if (class_exists($class)) {
                        $reflection = new \ReflectionClass($class);
                        if ($reflection->isSubclassOf(\Illuminate\Database\Eloquent\Model::class) && ! $reflection->isAbstract()) {
                            $models->push($class);
                        }
                    }
                }
            }
        }

        $models = $models->unique();

        if ($models->isEmpty()) {
            $this->info('No Eloquent models found in app/Models or app.');

            return self::SUCCESS;
        }

        $this->info('Discovered models:');
        foreach ($models as $model) {
            $this->line("- $model");
        }

        $created = [];
        $skipped = [];
        $policyPath = app_path('Policies');
        if (! is_dir($policyPath)) {
            mkdir($policyPath, 0755, true);
        }

        foreach ($models as $model) {
            $modelBase = class_basename($model);
            $policyClass = $modelBase.'Policy';
            $policyFile = $policyPath.DIRECTORY_SEPARATOR.$policyClass.'.php';
            if (file_exists($policyFile)) {
                $skipped[] = $policyClass;

                continue;
            }

            $this->call('make:policy', [
                'name' => $policyClass,
                '--model' => $model,
            ]);
            $created[] = $policyClass;
        }

        $this->info('---');
        if ($created) {
            $this->info('Created policies:');
            foreach ($created as $policy) {
                $this->line("- $policy");
            }
        }
        if ($skipped) {
            $this->info('Skipped (already exist):');
            foreach ($skipped as $policy) {
                $this->line("- $policy");
            }
        }
        if (empty($created) && empty($skipped)) {
            $this->info('No models found to generate policies for.');
        }

        return self::SUCCESS;
    }
}
