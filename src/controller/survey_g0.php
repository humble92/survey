<?php
  include (dirname(__FILE__) . '/../model/Question.php');
  $model = new QuestionModel($pdo, $survey['id']);
  $questionList = $model->getAllQuestions();

  $cfg = $survey['cfg'];
  $cfg_obj = json_decode($cfg);

  $mc_num = $cfg_obj->{'mc_num'};
  $mc_label_lowest = $cfg_obj->{'mc_label_lowest'};
  $mc_label_highest = $cfg_obj->{'mc_label_highest'};

  include (dirname(__FILE__) . '/../view/'.basename(__FILE__));
?>
