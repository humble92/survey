<?php
session_start();
if(!$_SESSION["AdminUI"]) {
    die("Wrong Access");
}

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include (__DIR__ . '/../../config/db.php');
include (__DIR__ . '/../../src/include/util.php');

//return result
$return = array();
$return['result'] = false;

$mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
//error_log($mode, 3, __DIR__ . '/../../log/debug.log');

switch($mode) {
    case "reset":
        include (__DIR__ . '/../src/model/Answer.php');
        $model = new AnswerModel($pdo);
        $data = $model->resetSurvey($id);
        $msg = "Reset survey: completed successfully";
        break;
    case "dup":
        include (__DIR__ . '/../src/model/Survey.php');
        $model = new SurveyModel($pdo);
        $data = $model->dupSurvey($id);
        $msg = "Duplicate survey: completed successfully";
        break;
    case "delete":
        include (__DIR__ . '/../src/model/Survey.php');
        $model = new SurveyModel($pdo);
        $data = $model->deleteSurvey($id);
        $msg = "Delete survey: completed successfully";
        break;
}


$return['result'] = true;
$return['msg'] = $msg;

echo json_encode($return);
exit;