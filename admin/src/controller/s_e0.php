<?php
session_start();
$_SESSION["AdminUI"] = "true";

// Create new Plates instance
$templates = new League\Plates\Engine(__DIR__ . '/../view/template');

// Preassign data to the layout
$templates->addData(['company' => 'by humble92'], 'main_layout');

// Render a template
$survey = $model->getSurvey($id);

include (__DIR__ . '/../model/Question.php');
$qModel = new QuestionModel($pdo, $id);
$questions = $qModel->getAllQuestions();

$dataArr = array();
$dataArr['title'] = 'Survey List';
$dataArr['survey'] = $survey;
$dataArr['cfg'] = (array) json_decode($survey['cfg']);
$dataArr['questions'] = $questions;
error_log(print_r($questions,true), 3, __DIR__ . '/../../../log/debug.log');

echo $templates->render('s_'.strtolower($sType), $dataArr);