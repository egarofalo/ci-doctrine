<?php

define('BASEPATH', '');
define('APPPATH', 'application/');

require './vendor/autoload.php';
require APPPATH . 'libraries/doctrine/Doctrine.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// create doctrine object
$doctrine = new Doctrine();
// get entity manager
$entityManager = $doctrine->getEntityManager();
// return commandline tool
return ConsoleRunner::createHelperSet($entityManager);
