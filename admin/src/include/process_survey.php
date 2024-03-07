<?php

//get form input

//mandatory

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

$desc = filter_input(INPUT_POST, 'desc');

$sType = filter_input(INPUT_POST, 'sType', FILTER_SANITIZE_STRING);

$nLevel = filter_input(INPUT_POST, 'nLevel', FILTER_SANITIZE_NUMBER_INT);



$surveyInfo = array();

$surveyInfo['id'] = $id;

$surveyInfo['name'] = $name;

$surveyInfo['explanation'] = $desc;

$surveyInfo['type'] = $sType;

$surveyInfo['nLevel'] = $nLevel;



//optional

$levelDesc = filter_input(INPUT_POST, 'levelDesc', FILTER_SANITIZE_STRING);

$categories = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING);

$lDesc = filter_input(INPUT_POST, 'lDesc', FILTER_SANITIZE_STRING);

$hDesc = filter_input(INPUT_POST, 'hDesc', FILTER_SANITIZE_STRING);



$surveyInfo['levelDesc'] = $levelDesc;

$surveyInfo['categories'] = $categories;

$surveyInfo['lDesc'] = $lDesc;

$surveyInfo['hDesc'] = $hDesc;



include_once (__DIR__ . "/../model/Survey{$survey['type']}.php");

switch($survey['type']) {

    case "G0": $spSurvey = new SurveyG0Model($pdo, $surveyInfo); break;

    case "E0": $spSurvey = new SurveyE0Model($pdo, $surveyInfo); break;

}



//error_log(print_r($nLevel,true), 3, __DIR__ . '/../../../log/debug.log');

$spSurvey->saveSurvey();

