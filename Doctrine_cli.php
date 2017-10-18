<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctrine_cli extends CI_Controller {

    private $ormPath;
    private $nl;

    public function __construct() {
        parent::__construct();
        if (!is_cli()) {
            show_404();
        }
        $this->ormPath = APPPATH . "ORM";
        $this->nl = PHP_EOL;
    }
    
    public function generate_entities() {
        $output = [];
        $cmd = "orm:generate-entities {$this->ormPath}";
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = realpath("php vendor/bin/doctrine.php {$cmd}");
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }
    }
    
    public function generate_proxies() {
        $output = [];
        $cmd = "orm:generate-proxies";
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = "php vendor/bin/doctrine.php {$cmd}";
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }        
    }    
    
    public function generate_repositories() {
        $output = [];
        $cmd = "orm:generate-repositories {$this->ormPath}";
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = "php vendor/bin/doctrine.php {$cmd}";
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }        
    }
    
    public function create_schema($flag = '') {
        $output = [];
        $cmd = "orm:schema-tool:create";
        if (!empty($flag)) {
            $cmd .= " {$flag}";
        }        
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = "php vendor/bin/doctrine.php {$cmd}";
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }        
    }
    
    public function update_schema($flag = '') {
        $output = [];
        $cmd = "orm:schema-tool:update";
        if (!empty($flag)) {
            $cmd .= " {$flag}";
        }
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = "php vendor/bin/doctrine.php {$cmd}";
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }        
    }
    
    public function convert_mapping_from_db() {
        $output = [];
        $cmd = "orm:convert-mapping --from-database annotation {$this->ormPath}/Entity";
        if (preg_match('/^windows/i', php_uname()) === 1) {
            $cmd = "vendor\\bin\\doctrine {$cmd}";
        } else {
            $cmd = "php vendor/bin/doctrine.php {$cmd}";
        }
        exec($cmd, $output);
        echo $this->nl;
        foreach ($output as $out) {
            echo $out . $this->nl;
        }        
    }

}