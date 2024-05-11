<?php
define('BASE_URL', 'http://localhost/Learning/Laravel/core-API/RESTAPI/');
define('PROJECT_PATH', dirname(__DIR__));

$autoload = ['config/connect', 'helper/functions', 'helper/query-builder', 'helper/lexical'];

foreach ($autoload as $index => $file) {
    require_once PROJECT_PATH . "/{$file}.php";
}