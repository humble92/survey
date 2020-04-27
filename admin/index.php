<?php
session_start();
include (__DIR__ . '/../config/db.php');
include (__DIR__ . '/../src/include/util.php');

include_once 'vendor/autoload.php';

include_once (__DIR__ . '/src/model/Survey.php');
$model = new SurveyModel($pdo);

$surveyTypes = $model->getSurveyTypes();
$surveys = $model->getAllSurveys();

foreach($surveyTypes as $row):
    $typeArray[] = $row['type'];
endforeach;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'id');
$sType = filter_input(INPUT_GET, 'sType', FILTER_SANITIZE_STRING);
$mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRING);

if (isset($mode))
    include (__DIR__ . '/src/controller/manage_action.php');
else if (in_array($sType, $typeArray))
    include (__DIR__ . '/src/controller/manage.php');
else
    include (__DIR__ . '/src/controller/home.php');


