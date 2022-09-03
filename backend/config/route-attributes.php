<?php

use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

$dirs = (new Finder())
    ->directories()
    ->depth(0)
    ->in(base_path('Src/ModUnits'));

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        ...collect($dirs)->mapWithKeys(function (SplFileInfo $file) {
            $rootPath = Str::replaceFirst(base_path() . '/', '', $file->getPathname());
            $namespace = Str::replace('/', '\\', Str::ucfirst($rootPath)) . '\\';

            return [
                $file->getPathname() => [
                    'namespace' => $namespace,
                    'prefix' => 'api',
                    'middleware' => ['api'],
                ]
            ];
        }),
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
