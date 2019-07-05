<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfd5c7e2f371c09e91ec436d95d26326
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VueAdminInstallCoreUi\\Test\\' => 27,
        ),
        'D' => 
        array (
            'Decorate\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VueAdminInstallCoreUi\\Test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Decorate\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfd5c7e2f371c09e91ec436d95d26326::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfd5c7e2f371c09e91ec436d95d26326::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
