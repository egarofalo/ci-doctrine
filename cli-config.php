<?php

$application_path = 'application';

define('BASEPATH', rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR));
define('APPPATH', BASEPATH . DIRECTORY_SEPARATOR . $application_path . DIRECTORY_SEPARATOR);

require './vendor/autoload.php';
require APPPATH . 'libraries/doctrine/Doctrine.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// create doctrine object
$doctrine = new Doctrine();
// get entity manager
$entityManager = $doctrine->getEntityManager();
// return commandline tool
return ConsoleRunner::createHelperSet($entityManager);