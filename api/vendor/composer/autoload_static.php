<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite91eae6b03aaae9136dc415539870da8
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'App\\Models\\' => 11,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/framework',
        ),
        'App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite91eae6b03aaae9136dc415539870da8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite91eae6b03aaae9136dc415539870da8::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite91eae6b03aaae9136dc415539870da8::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite91eae6b03aaae9136dc415539870da8::$classMap;

        }, null, ClassLoader::class);
    }
}
