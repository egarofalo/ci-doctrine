<?php

namespace CoDevelopers\Doctrigniter;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class ComposerSetup {

    private static $outputPrePackageInstall = 'Instalando Doctrigniter...';
    private static $outputWarningFolderExists = 'ADVERTENCIA: Al intentar crear la carpeta application/ORM se detectó que ya existe. Tenga en cuenta que Doctrigniter utiliza esta carpeta para almacenar las Entidades, los Repositorios de las Entidades y las clases Proxy.';
    private static $outputCopiedDatabaseYaml = 'El archivo database.yml fue copiado en la carpeta application/config';
    private static $outputCopiedCliConfig = 'El archivo cli-config.php fue copiado en la raíz de su proyecto para poder utilizar los comandos de Doctrine desde la consola.';
    private static $outputPostPackageInstall = 'Instalación finalizada.';
    
    public static function prePackageInstall(PackageEvent $event) {
        echo self::$outputPrePackageInstall;
        /*
        if (!file_exists(dirname(__FILE__) . '/../../ORM')) {
            mkdir(dirname(__FILE__) . '/../../ORM');
        } else {
            echo self::$outputWarningFolderExists;
        }
        if (!file_exists(dirname(__FILE__) . '/../../ORM/Entity')) {
            mkdir(dirname(__FILE__) . '/../../ORM/Entity');
        }
        if (!file_exists(dirname(__FILE__) . '/../../ORM/Repository')) {
            mkdir(dirname(__FILE__) . '/../../ORM/Repository');
        }
        if (!file_exists(dirname(__FILE__) . '/../../ORM/Proxy')) {
            mkdir(dirname(__FILE__) . '/../../ORM/Proxy');
        }
         * 
         */
    }
    
    public static function postPackageInstall(PackageEvent $event) {
        //copy(dirname(__FILE__) . '/database.yml', dirname(__FILE__) . '/../../config/database.yml');
        echo self::$outputCopiedDatabaseYaml;
        //copy(dirname(__FILE__) . '/cli-config.php', dirname(__FILE__) . '/../../../cli-config.php');
        echo self::$outputCopiedCliConfig;
        echo self::$outputPostPackageInstall;
    }

}