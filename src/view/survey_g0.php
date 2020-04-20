    <div class="themeStripe"></div>
    <div class="formOuterContainer">
      <form action="index.php" target="_self" method="POST" id="f">
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
                      <div class="scaleLabel"><?php echo $mc_label_lowest?></div>
                      <?php for($j = 1; $j <= $mc_num; $j++) { ?>
                        <div class="radioBtnContainer">
                            <label for="<?php echo $j?>"><?php echo $j?></label>
                            <input type="radio" class="radiobtn" id="q<?php echo $i?>_<?php echo $j?>" name="q<?php echo $i?>" value="<?php echo $j?>" tabindex="0">
                            <span class="checkmark"></span>
                        </div>
                      <?php } ?>
                      <div class="scaleLabel"><?php echo $mc_label_highest?></div>
                    </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>


          </div>
          <div class="btnContainer">
            <input type="hidden" name="survey_id" value="<?php echo $survey['id']?>">
            <input type="hidden" name="q_total" value="<?php echo ($i + 1)?>">
            <input type="hidden" name="mode" value="v">
            <div role="button" class="button" onclick="javascript:document.getElementById('f').submit();" tabindex="0">
                <span class="">Submit</span>
            </div>
          </div>
        </div>
      </form>
    </div>

