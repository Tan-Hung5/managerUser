<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit20fad51902f91e7fd3039e016a6556b5
{
    public static $files = array (
        '9e4824c5afbdc1482b6025ce3d4dfde8' => __DIR__ . '/..' . '/league/csv/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'includes\\' => 9,
        ),
        'L' => 
        array (
            'League\\Csv\\' => 11,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'League\\Csv\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/csv/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit20fad51902f91e7fd3039e016a6556b5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit20fad51902f91e7fd3039e016a6556b5::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit20fad51902f91e7fd3039e016a6556b5::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit20fad51902f91e7fd3039e016a6556b5::$classMap;

        }, null, ClassLoader::class);
    }
}
