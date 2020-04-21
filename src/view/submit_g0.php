    <div class="themeStripe"></div>
    <div class="formOuterContainer">
        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
            <div class="surveyResultMe" dir="auto">My average: <?php echo $my_average?></div>
            <div class="surveyResultTotal" dir="auto">Total average: <?php echo $t_average?></div>
            <div class="surveyResultCnt" dir="auto">Total responses: <?php echo count($responses['total'])?></div>
          </div>
          
          <div class="qItemList" role="list">
            <?php $i = 0; foreach ($questionList as $row): ?>
              <div class="qItemContainer">
              <div role="listitem" class="qItemSubContainer">
                <div class="qItemTitle" role="heading">Q<?php echo ++$i.' '.$row['q'];?></div>

                <div class="surveyResultMe" dir="auto">My answer: <?php echo $answer['q'.$i]?></div>
                <div class="surveyResultTotal" dir="auto">Average: <?php echo number_format($responses['each'][$i]/count($responses['total']), 2)?></div>

              </div>
            </div>
            <?php endforeach ?>


          </div>
          <div class="btnContainerRight">
            <div role="button" class="button" onclick="javascript:window.history.back();" tabindex="0">
                <span class="">Back</span>
            </div>
          </div>
        </div>

    </div>

