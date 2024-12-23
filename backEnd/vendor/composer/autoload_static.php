<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8c55d0dd15e91f98aed636fbba2c44e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pc\\BackEnd\\' => 11,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pc\\BackEnd\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8c55d0dd15e91f98aed636fbba2c44e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8c55d0dd15e91f98aed636fbba2c44e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8c55d0dd15e91f98aed636fbba2c44e::$classMap;

        }, null, ClassLoader::class);
    }
}
