<?php

$questionInfo = array();

$questionInfo['survey_id'] = $id;



include_once (__DIR__ . "/../model/Question{$survey['type']}.php");

switch($survey['type']) {

    case "G0": $spQuestion = new QuestionG0Model($pdo, $questionInfo); break;

    case "E0": $spQuestion = new QuestionE0Model($pdo, $questionInfo); break;

}



//get form input

//mandatory

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$qArrStr = filter_input(INPUT_POST, 'qArrStr', FILTER_SANITIZE_STRING);
$qArr = explode(',', $qArrStr);


//update
foreach($qArr as $q_id) {

    $q = filter_input(INPUT_POST, 'q'.$q_id, FILTER_SANITIZE_STRING);
    if(trim($q) == "") continue;

    $spQuestion->setQId($q_id);

    $spQuestion->setQ($q);

    if ($survey['type'] == "E0") {
        $spQuestion->setPleasant(0);
        $spQuestion->setUnpleasant(0);
        $spQuestion->setActivated(0);
        $spQuestion->setDeactived(0);
    }

    //optional
    $deleting = false;
    foreach($_POST['qc'.$q_id] as $selected) {

        if ($selected=="del") $deleting = true;

        if (!$deleting && $survey['type'] == "E0") {
            switch($selected) {
                case 0: $spQuestion->setPleasant(1); break;
                case 1: $spQuestion->setUnpleasant(1); break;
                case 2: $spQuestion->setActivated(1); break;
                case 3: $spQuestion->setDeactived(1); break;
            }
        }
    }

    if($deleting) {
        $spQuestion->deleteQuestion();
    } else {
        $spQuestion->saveQuestion();
    }
}

// insert new questions
for($k = 0; $k < 10; $k++) { 
    
    $q = filter_input(INPUT_POST, 'q_new'.$k, FILTER_SANITIZE_STRING);
    if(trim($q) == "") continue;

    $spQuestion->setQ($q);

    if ($survey['type'] == "E0") {
        $spQuestion->setPleasant(0);
        $spQuestion->setUnpleasant(0);
        $spQuestion->setActivated(0);
        $spQuestion->setDeactived(0);
    }

    foreach($_POST['qc_new'.$k] as $selected) {

        if ($survey['type'] == "E0") {
            switch($selected) {
                case 0: $spQuestion->setPleasant(1); break;
                case 1: $spQuestion->setUnpleasant(1); break;
                case 2: $spQuestion->setActivated(1); break;
                case 3: $spQuestion->setDeactived(1); break;
            }
        }
    }

    $spQuestion->addQuestion();
}
