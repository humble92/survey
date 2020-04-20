<?php
//get form input
for($i = 1; $i <= $_POST['q_total']; $i++) {
    $val = filter_input(INPUT_POST, 'q'.$i, FILTER_SANITIZE_NUMBER_INT);
    if($val == NULL) continue;
    $answer['q'.$i] = $val;
}
  
$my_average = number_format(array_sum($answer) / count($answer), 2);

//var_dump($answer);
include (dirname(__FILE__) . '/../model/Answer.php');
$model = new AnswerModel($pdo, $survey['id']);
$model->saveResponses($answer);

