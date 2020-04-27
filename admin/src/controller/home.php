<?php
session_start();
$_SESSION["AdminUI"] = "true";

// Create new Plates instance
$templates = new League\Plates\Engine(__DIR__ . '/../view/template');

// Preassign data to the layout
$templates->addData(['company' => 'by humble92'], 'main_layout');

// Render a template
$dataArr = array();
$dataArr['title'] = 'Survey List';
$dataArr['types'] = implode("|", $typeArray);
$dataArr['surveys'] = $surveys;

echo $templates->render('home', $dataArr);