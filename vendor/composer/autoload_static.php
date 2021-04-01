<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfae2870ab99e885fb462cf415a8ce3fd
{
    public static $files = array (
        '085c9df925235cb9a4fe61935d1da426' => __DIR__ . '/../..' . '/core/install/CheckDependencies.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WooVarSwatchesAdjacentProducts\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WooVarSwatchesAdjacentProducts\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfae2870ab99e885fb462cf415a8ce3fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfae2870ab99e885fb462cf415a8ce3fd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfae2870ab99e885fb462cf415a8ce3fd::$classMap;

        }, null, ClassLoader::class);
    }
}
