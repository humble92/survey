<?php
//Answer model
include (dirname(__FILE__) . '/../model/Answer.php');
$model = new AnswerModel($pdo, $survey['id']);
$responseList = $model->getResponses();
foreach ($responseList as $row) {
  $arr = json_decode($row[0], true);
  $result[] = number_format(array_sum($arr) / count($arr), 2);

  //result per each question
  for($i = 1; $i <= count($arr); $i++) {
    $each[$i] += $arr['q'.$i];
    $each_detail[$i][] = $arr['q'.$i];
  }      
}
$responses_detail = json_encode(['total' => $result, 'each' => $each, 'each_detail' => $each_detail]);
$responses = json_decode($responses_detail, true);
$t_average = number_format(array_sum($responses['total']) / count($responses['total']), 2);
$sd = Stand_Deviation($result);

//Question model
include (dirname(__FILE__) . '/../model/Question.php');
$model = new QuestionModel($pdo, $survey['id']);
$questionList = $model->getAllQuestions();

//view
include (dirname(__FILE__) . '/../view/'.basename(__FILE__));
?>
