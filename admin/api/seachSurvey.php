<?php
session_start();
if(!$_SESSION["AdminUI"]) {
    die("Wrong Access");
}

include (__DIR__ . '/../../config/db.php');
include (__DIR__ . '/../../src/include/util.php');
include (__DIR__ . '/../src/model/Survey.php');

//return result
$return = array();
$return['result'] = false;

$word = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_STRING);
$model = new SurveyModel($pdo);
$data = $model->searchSurvey($word);
//error_log(json_encode($data), 3, __DIR__ . '/../../log/debug.log');

$return['result'] = true;
$return['survey'] = $data;

echo json_encode($return);
exit;