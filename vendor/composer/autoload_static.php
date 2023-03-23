<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita43d47bbb6cc04b834745f4b18f0de0b
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '2dcc1fe700145c8f64875eb0ae323e56' => __DIR__ . '/../..' . '/helpers.php',
        'cbeb1640bbf1da1ff46aa0673e29cf71' => __DIR__ . '/../..' . '/controllers/RecipeController.php',
        '38f9f511e01fac23e541a4e0233f52c6' => __DIR__ . '/../..' . '/controllers/KitchenController.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita43d47bbb6cc04b834745f4b18f0de0b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita43d47bbb6cc04b834745f4b18f0de0b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita43d47bbb6cc04b834745f4b18f0de0b::$classMap;

        }, null, ClassLoader::class);
    }
}
