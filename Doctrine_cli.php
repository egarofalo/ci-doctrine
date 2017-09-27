<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctrine_cli extends CI_Controller {

    private $library;
    private $prepMsgErrors;
    private $appendMsgErrors;
    private $ormPath;
    private $entityPath;
    private $repositoryPath;
    private $proxyPath;
    private $dbYmlSrc;
    private $dbYmlDest;
    private $cliConfigSrc;
    private $cliConfigDest;
    private $myControllerSrc;
    private $myControllerDest;
    private $nl;

    public function __construct() {
        parent::__construct();
        if (!is_cli()) {
            show_404();
        }
        $this->library = "doctrigniter";
        $this->prepMsgErrors = "La instalacion automatica no pudo ser finalizada debido a que";
        $this->appendMsgErrors = "Solucione los conflictos y finalice la instalacion de forma manual.{$this->nl}";
        $this->ormPath = APPPATH . "ORM";
        $this->entityPath = "{$this->ormPath}/Entity";
        $this->repositoryPath = "{$this->ormPath}/Repository";
        $this->proxyPath = "{$this->ormPath}/Proxy";
        $this->dbYmlSrc = APPPATH . "libraries/{$this->library}/database.yml";
        $this->dbYmlDest = APPPATH . 'config/database.yml';
        $this->cliConfigSrc = APPPATH . "libraries/{$this->library}/cli-config.php";
        $this->cliConfigDest = FCPATH . 'cli-config.php';
        $this->myControllerSrc = APPPATH . "libraries/{$this->library}/MY_Controller.php";
        $this->myControllerDest = APPPATH . 'core/MY_Controller.php';
        $this->nl = PHP_EOL;
    }

    private function createOrmFolder() {
        if (!file_exists($this->ormPath)) {
            if (!@mkdir($this->ormPath)) {
                echo "ERROR!! {$this->prepMsgErrors} la carpeta {$this->ormPath} no pudo ser creada. {$this->appendMsgErrors}";
                return FALSE;
            }
        } else {
            echo "ERROR!! {$this->prepMsgErrors} la carpeta {$this->ormPath} ya existe. {$this->appendMsgErrors}";
            return FALSE;
        }
        return TRUE;
    }

    private function createEntityFolder() {
        if (!@mkdir($this->entityPath)) {
            echo "ERROR!! {$this->prepMsgErrors} la carpeta {$this->entityPath} no pudo ser creada. {$this->appendMsgErrors}";
            return FALSE;
        }
        return TRUE;
    }
    
    private function createRepositoryFolder() {
        if (!@mkdir($this->repositoryPath)) {
            echo "ERROR!! {$this->prepMsgErrors} la carpeta {$this->repositoryPath} no pudo ser creada. {$this->appendMsgErrors}";
            return FALSE;
        }
        return TRUE;
    }

    private function createProxyFolder() {
        if (!@mkdir($this->proxyPath)) {
            echo "ERROR!! {$this->prepMsgErrors} la carpeta {$this->proxyPath} no pudo ser creada. {$this->appendMsgErrors}";
            return FALSE;
        }
        return TRUE;        
    }

    private function createFolderStructure() {
        if (!$this->createOrmFolder()) {
            return FALSE;
        }
        if (!$this->createEntityFolder()) {
            return FALSE;
        }
        if (!$this->createRepositoryFolder()) {
            return FALSE;
        }
        if (!$this->createProxyFolder()) {
            return FALSE;
        }
        return TRUE;
    }

    private function copyDatabaseYml() {
        if (file_exists($this->dbYmlDest)) {
            echo "ERROR!! {$this->prepMsgErrors} el archivo {$this->dbYmlDest} ya existe. {$this->appendMsgErrors}";
            return FALSE;
        }
        if (!@copy($this->dbYmlSrc, $this->dbYmlDest)) {
            echo "ERROR!! {$this->prepMsgErrors} el archivo {$this->dbYmlDest} no pudo ser copiado. {$this->appendMsgErrors}";
            return FALSE;            
        }
        return TRUE;
    }

    private function copyCliConfig() {
        if (file_exists($this->cliConfigDest)) {
            echo "ERROR!! {$this->prepMsgErrors} el archivo {$this->cliConfigDest} ya existe. {$this->appendMsgErrors}";
            return FALSE;
        }
        if (!@copy($this->cliConfigSrc, $this->cliConfigDest)) {
            echo "ERROR!! {$this->prepMsgErrors} el archivo {$this->cliConfigDest} no pudo ser copiado. {$this->appendMsgErrors}";
            return FALSE;            
        }
        echo "ATENCION!! Recuerde eliminar por seguridad el archivo {$this->cliConfigDest} antes de pasar la aplicacion al servidor de produccion.{$this->nl}";
        return TRUE;
    }

    private function copyMyController() {
        if (file_exists($this->myControllerDest)) {
            echo "ADVERTENCIA!! El archivo {$this->myControllerDest} ya existe. Si desea utilizar el controlador base de CI Doctrine realice el merge correspondiente con el archivo {$this->myControllerSrc}.{$this->nl}";
            return;
        }
        @copy($this->myControllerSrc, $this->myControllerDest);
    }
    
    private function updateCliConfig() {
        $content = @file($this->cliConfigDest);
        if (!$content) {
            echo "ADVERTENCIA!! El archivo {$this->cliConfigDest} no pudo ser modificado. Revise las constantes BASEPATH y APPPATH del mismo para que funcione bien la consola de Doctrine.{$this->nl}";
        }
        $basepath = addcslashes(BASEPATH, '\\');
        $apppath = addcslashes(APPPATH, '\\');
        $content[2] = "define('BASEPATH', '{$basepath}');{$this->nl}";
        $content[3] = "define('APPPATH', '{$apppath}');{$this->nl}";
        if (@file_put_contents($this->cliConfigDest, $content) === FALSE) {
            echo "ADVERTENCIA!! El archivo {$this->cliConfigDest} no pudo ser modificado. Revise las constantes BASEPATH y APPPATH del mismo para que funcione bien la consola de Doctrine.{$this->nl}";
        }
    }

    public function setup() {
        echo $this->nl;
        echo "-------------------------------------------{$this->nl}";
        echo "CREANDO LA ESTRUCTURA DE CARPETAS NECESARIA{$this->nl}";
        echo "-------------------------------------------{$this->nl}";
        if (!$this->createFolderStructure()) {
            return;
        }
        echo $this->nl;
        echo "--------------------------------{$this->nl}";
        echo "COPIANDO EL ARCHIVO database.yml{$this->nl}";
        echo "--------------------------------{$this->nl}";
        if (!$this->copyDatabaseYml()) {
            return;
        }
        echo $this->nl;
        echo "----------------------------------{$this->nl}";
        echo "COPIANDO EL ARCHIVO cli-config.php{$this->nl}";
        echo "----------------------------------{$this->nl}";
        if (!$this->copyCliConfig()) {
            return;
        }
        echo $this->nl;
        echo "-------------------------------------{$this->nl}";
        echo "COPIANDO EL ARCHIVO MY_Controller.php{$this->nl}";
        echo "-------------------------------------{$this->nl}";
        $this->copyMyController();
        echo $this->nl;
        echo "-------------------------------------{$this->nl}";
        echo "MODIFICANDO EL ARCHIVO cli-config.php{$this->nl}";
        echo "-------------------------------------{$this->nl}";
        $this->updateCliConfig();
        echo $this->nl;
        echo "---------------------------------------{$this->nl}";
        echo "LA INSTALACION A FINALIZADO CON EXITO!!{$this->nl}";
        echo "---------------------------------------{$this->nl}";
    }

}
