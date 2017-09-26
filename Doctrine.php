<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

class Doctrine {

    private $metadataPaths;
    private $entityManager;
    private $proxyDir;

    public function __construct() {
        // metadata folder paths
        $this->metadataPaths = [APPPATH . 'ORM/Entity'];
        // proxies folder path
        $this->proxyDir = APPPATH . 'ORM/Proxy';
        // set the entity manager
        $this->setEntityManager();
    }
    
    private function setEntityManager() {
        // include connection configuration
        $db = Yaml::parse(file_get_contents(APPPATH . 'config/database.yml'));
        // get active group
        $conn = $db['active_group']; 
        // environment
        $isDevMode = $db[$conn]['debug']; 
        // create metadata configuration
        $config = Setup::createAnnotationMetadataConfiguration($this->metadataPaths, $isDevMode, $this->proxyDir);
        // create entity manager
        $this->entityManager = EntityManager::create($db[$conn], $config);        
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

}
