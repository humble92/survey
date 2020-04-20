<?php
  include (dirname(__FILE__) . '/../model/Question.php');
  $model = new QuestionModel($pdo, $survey['id']);
  $questionList = $model->getAllQuestions();

  $cfg = $survey['cfg'];
  $cfg_obj = json_decode($cfg);

  $item_level = $cfg_obj->{'item_level'};
  $levels = $cfg_obj->{'levels'};

  include (dirname(__FILE__) . '/../view/'.basename(__FILE__));
?>
