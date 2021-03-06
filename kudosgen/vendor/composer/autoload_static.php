<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit184aa38a37eac95d248445e399fc55ee
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kudosgen\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kudosgen\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit184aa38a37eac95d248445e399fc55ee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit184aa38a37eac95d248445e399fc55ee::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit184aa38a37eac95d248445e399fc55ee::$classMap;

        }, null, ClassLoader::class);
    }
}
