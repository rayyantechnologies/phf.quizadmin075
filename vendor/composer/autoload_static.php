<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ca89793ed49ebbfab4bb517bc7d9536
{
    public static $prefixesPsr0 = array (
        'G' => 
        array (
            'Goodby\\CSV' => 
            array (
                0 => __DIR__ . '/..' . '/goodby/csv/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit2ca89793ed49ebbfab4bb517bc7d9536::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2ca89793ed49ebbfab4bb517bc7d9536::$classMap;

        }, null, ClassLoader::class);
    }
}
