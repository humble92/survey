    <div class="themeStripe"></div>
    <div class="formOuterContainer">

        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle surveyTitleRslt" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
            <?php foreach ($categories as $c): ?>
              <div>
                <span class="surveyCategory"><?php echo $c?></span>
                <span class="surveyResultMe" dir="auto">My answer: <?php echo number_format($userCategories[$c]/$item_num_per_category, 2)?></span>
                <span class="space"></span>
                <span class="surveyResultTotal" dir="auto">Average: <?php echo number_format($totalCategories[$c]/($item_num_per_category * count($responses['total'])), 2)?></span>
              </div>
            <?php endforeach ?>
            <div class="surveyResultCnt surveyResultCntE0" dir="auto">Total responses: <?php echo count($responses['total'])?></div>
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
                      <span class="surveyResultMe" dir="auto">My answer: <?php echo $answer['q'.$i]?></span>
                      <span class="space"></span>
                      <span class="surveyResultTotal" dir="auto">Average: <?php echo number_format($responses['each'][$i]/count($responses['total']), 2)?></span>
                    </div>
                    <?php $i++; ?>
                  <?php endforeach ?>

                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="btnContainerRight">
            <div role="button" class="button" onclick="javascript:window.history.back();" tabindex="0">
                <span class="">Back</span>
            </div>
          </div>
        </div>

    </div>
