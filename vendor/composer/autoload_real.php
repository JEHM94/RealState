<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita4b2a69c1e565d0fb9286e92c36fe5cc
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInita4b2a69c1e565d0fb9286e92c36fe5cc', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita4b2a69c1e565d0fb9286e92c36fe5cc', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita4b2a69c1e565d0fb9286e92c36fe5cc::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}