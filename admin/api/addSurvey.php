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

//$inputs = json_decode(file_get_contents('php://input'), true);
$input = filter_var_array( json_decode( $_POST["json"], true ), [
    'name'  => [ 'filter' => FILTER_SANITIZE_STRING,
                 'flags'  => FILTER_NULL_ON_FAILURE ],
    'desc'  => [ 'filter' => FILTER_SANITIZE_STRING,
                 'flags'  => FILTER_NULL_ON_FAILURE ],
    'sType' => FILTER_SANITIZE_STRING
] );
//error_log(print_r($inputs,true), 3, __DIR__ . '/../../log/debug.log');

$model = new SurveyModel($pdo);
$data = $model->addSurvey($input);

$return['result'] = true;
$return['survey'] = $data;

echo json_encode($return);
exit;