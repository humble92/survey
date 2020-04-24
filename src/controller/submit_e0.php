<?php
//Survey info
$cfg = $survey['cfg'];
$cfg_obj = json_decode($cfg);
$item_num_per_category = 6;

$item_level = $cfg_obj->{'item_level'};
$levels = $cfg_obj->{'levels'};
$categories = $cfg_obj->{'category'};
foreach ($categories as $c) {
  $userCategories[$c] = 0;
  $totalCategories[$c] = 0;
}

//Question model
include (dirname(__FILE__) . '/../model/Question.php');
$qModel = new QuestionModel($pdo, $survey['id']);
$questionList1 = $qModel->getAllQuestions();
$i = 0;
foreach ($questionList1 as $qRow) {
  $questionList[] = $qRow;
  $q_type[++$i] = json_decode($qRow['q_type']);
}


//Answer model
include (dirname(__FILE__) . '/../include/analysis_numeric_survey.php');

$responseList = $model->getResponses();
foreach ($responseList as $row) {
    $arr = json_decode($row[0], true);
    //var_dump($arr);

    //total categorized result
    for($l = 1; $l <= count($arr); $l++) {
        if($q_type[$l]->Pleasant) {
          $totalCategories['Pleasant feelings'] += $arr['q'.$l];
        }
        if($q_type[$l]->Unpleasant) {
          $totalCategories['Unpleasant feelings'] += $arr['q'.$l];
        }
        if($q_type[$l]->Activated) {
          $totalCategories['Activated feelings'] += $arr['q'.$l];
        }
        if($q_type[$l]->Deactived) {
          $totalCategories['Deactived feelings'] += $arr['q'.$l];
        }      
    }
    //var_dump($totalCategories);

    $result[] = number_format(array_sum($arr) / count($arr), 2);

    //each question statistics
    for($i = 1; $i <= count($arr); $i++) {
      $each[$i] += $arr['q'.$i];
      $each_detail[$i][] = $arr['q'.$i];
    }
}
$totalCategories['Pleasantness'] = $totalCategories['Pleasant feelings'] - $totalCategories['Unpleasant feelings'];
$totalCategories['Activation'] = $totalCategories['Activated feelings'] - $totalCategories['Deactived feelings'];


//my categorized result
for($l = 1; $l <= count($answer); $l++) {
  if($q_type[$l]->Pleasant) {
    $userCategories['Pleasant feelings'] += $answer['q'.$l];
  }
  if($q_type[$l]->Unpleasant) {
    $userCategories['Unpleasant feelings'] += $answer['q'.$l];
  }
  if($q_type[$l]->Activated) {
    $userCategories['Activated feelings'] += $answer['q'.$l];
  }
  if($q_type[$l]->Deactived) {
    $userCategories['Deactived feelings'] += $answer['q'.$l];
  }
}
$userCategories['Pleasantness'] = $userCategories['Pleasant feelings'] - $userCategories['Unpleasant feelings'];
$userCategories['Activation'] = $userCategories['Activated feelings'] - $userCategories['Deactived feelings'];


$responses_detail = json_encode(['total' => $result, 'each' => $each, 'each_detail' => $each_detail]);
$responses = json_decode($responses_detail, true);
$t_average = number_format(array_sum($responses['total']) / count($responses['total']), 2);
$sd = Stand_Deviation($result);


//view
include (dirname(__FILE__) . '/../view/'.basename(__FILE__));
?>
