    <div class="themeStripe"></div>
    <div class="formOuterContainer">
      <form action="index.php" target="_self" method="POST" id="f">
        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
            <div class="surveyDesc" dir="auto"><?php echo $survey['explanation']?></div>
          </div>

          <div class="qItemList" role="list">
            <div class="qItemContainer">
              <div role="listitem" class="qItemSubContainer">
                <div class="tableRow rangeHeader">
                  <div class="tableCell headerCell"></div>
                  <?php foreach ($levels as $row): ?>
                    <div class="tableCell"><?php echo $row?></div>
                  <?php endforeach ?>
                </div>
                <div class="radioGroupListContainer">
                  <div class="radioGroupItem">

                  <?php $i = 1; foreach ($questionList as $row): ?>
                    <div class="tableRow">
                      <div class="tableCell headerCell"><?php echo $row['q']?></div>
                      <?php for($j = 0; $j < $item_level; $j++) { ?>
                        <div class="tableCell responseCell">
                          <div class="radioBtnContainer">
                              <input type="radio" class="radiobtn" id="q<?php echo $i?>_<?php echo $j?>" name="q<?php echo $i?>" value="<?php echo $j?>" tabindex="0">
                              <span class="checkmark"></span>
                          </div>
                        </div>
                      <?php }
                        $i++;
                      ?>
                    </div>
                  <?php endforeach ?>

                  </div>
                </div>
              </div>
            </div>

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
