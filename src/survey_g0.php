<?php
  include (dirname(__FILE__) . '/model/Question.php');
  $model = new QuestionModel($pdo, $survey['id']);
  $questionList = $model->getAllQuestions();
?>
    <div class="themeStripe"></div>
    <div class="formOuterContainer">
      <form action="result_g0.php" target="_self" method="POST" id="">
        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
            <div class="surveyDesc" dir="auto"><?php echo $survey['explanation']?></div>
          </div>
          
          <div class="qItemList" role="list">
            <?php $i = 0; foreach ($questionList as $row): ?>
              <div class="qItemContainer">
              <div role="listitem" class="qItemSubContainer">
                <div class="qItemTitle" role="heading">Q<?php echo ++$i.' '.$row['q'];?></div>

                <div class="radioGroupContainer">
                    <div class="radioGroup">
                        <div class="scaleLabel">Strongly disagree</div>
                        <div class="radioBtnContainer">
                            <label for="1">1</label>
                            <input type="radio" class="radiobtn" id="q1_1" name="q1" value="1" tabindex="0">
                            <span class="checkmark"></span>
                        </div>
                        <div class="radioBtnContainer">
                            <label for="1">2</label>
                            <input type="radio" class="radiobtn" id="q1_1" name="q1" value="1" tabindex="0">
                            <span class="checkmark"></span>
                        </div>
                        <div class="scaleLabel">Strongly agree</div>
                    </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>


          </div>
          <div class="btnContainer">
            <div role="button" class="button" tabindex="0">
                <span class="">Submit</span>
            </div>
          </div>
        </div>
      </form>
    </div>

