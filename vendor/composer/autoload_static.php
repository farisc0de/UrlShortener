<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdfaad650f21b73192b23f6c3d45a011d
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Framework',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfaad650f21b73192b23f6c3d45a011d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfaad650f21b73192b23f6c3d45a011d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdfaad650f21b73192b23f6c3d45a011d::$classMap;

        }, null, ClassLoader::class);
    }
}
