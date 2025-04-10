<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite13cb617c3d7cec73c1ae774612473b3
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\Controller\\' => 16,
            'Core\\Class\\' => 11,
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\Controller\\' => 15,
            'App\\Class\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/controller',
        ),
        'Core\\Class\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/class',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controller',
        ),
        'App\\Class\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/class',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite13cb617c3d7cec73c1ae774612473b3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite13cb617c3d7cec73c1ae774612473b3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite13cb617c3d7cec73c1ae774612473b3::$classMap;

        }, null, ClassLoader::class);
    }
}
