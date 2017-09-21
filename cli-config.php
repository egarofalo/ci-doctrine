<?php

define('BASEPATH', '');
define('APPPATH', BASEPATH . 'application/');

require './vendor/autoload.php';
require APPPATH . 'libraries/doctrigniter/Doctrigniter.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// create doctriniter object
$doctrigniter = new Doctrigniter();
// get entity manager
$entityManager = $doctrigniter->getEntityManager();
// return commandline tool
return ConsoleRunner::createHelperSet($entityManager);