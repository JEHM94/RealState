<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita4b2a69c1e565d0fb9286e92c36fe5cc
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita4b2a69c1e565d0fb9286e92c36fe5cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita4b2a69c1e565d0fb9286e92c36fe5cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita4b2a69c1e565d0fb9286e92c36fe5cc::$classMap;

        }, null, ClassLoader::class);
    }
}
