<?php
session_start();
include (__DIR__ . '/../config/db.php');
include (__DIR__ . '/../src/include/util.php');

include_once 'vendor/autoload.php';

if($mode == 'api')
    include (__DIR__ . '/api/result_'.strtolower($survey["type"]).'.php');
else
    include (__DIR__ . '/src/controller/home.php');


