<?php
session_start();

//form processing
$survey = $model->getSurvey($id);
if ($mode == "s")
    include (__DIR__ . '/../include/process_survey.php');
else if ($mode == "q")
    include (__DIR__ . '/../include/process_question.php');

// Create new Plates instance
$templates = new League\Plates\Engine(__DIR__ . '/../view/template');

// Preassign data to the layout
$templates->addData(['company' => 'by humble92'], 'main_layout');

// Render a template
$survey = $model->getSurvey($id);

include_once (__DIR__ . '/../model/Question.php');
$qModel = new QuestionModel($pdo, $id);
$questions = $qModel->getAllQuestions();

$dataArr = array();
$dataArr['title'] = 'Survey List';
$dataArr['survey'] = $survey;
$dataArr['cfg'] = (array) json_decode($survey['cfg']);
$dataArr['questions'] = $questions;
//error_log(print_r($questions,true), 3, __DIR__ . '/../../../log/debug.log');

echo $templates->render('s_'.strtolower($survey['type']), $dataArr);
