<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit161063ac4ca51fc49e6bcb5a58487262
{
    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'Unirest\\' => 
            array (
                0 => __DIR__ . '/..' . '/mashape/unirest-php/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit161063ac4ca51fc49e6bcb5a58487262::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit161063ac4ca51fc49e6bcb5a58487262::$classMap;

        }, null, ClassLoader::class);
    }
}
