    <div class="themeStripe"></div>
    <div class="formOuterContainer">

        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle surveyTitleRslt" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
            <?php $i = 1; foreach ($categories as $c):
              if(strpos($c, "feelings")) continue;
            ?>
              <div>
                <span class="surveyCategory"><?php echo $c?></span>
                <span class="surveyResultMe" dir="auto">My answer: <span id="myCat<?php echo $i++?>"></span></span>
                <span class="space"></span>
                <span class="surveyResultTotal" dir="auto">
                  Average: <?php echo number_format($totalCategories[$c]/($item_num_per_category * count($responses['total'])), 2)?>
                  (SD: <?php echo $sd?>)
                </span>
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
                      <span class="surveyResultMe" dir="auto">My answer: <span id="myAns<?php echo $i?>"></span></span>
                      <span class="space"></span>
                      <span class="surveyResultTotal" dir="auto">
                        Average: <?php echo number_format($responses['each'][$i]/count($responses['total']), 2)?>
                        (SD:<?php echo Stand_Deviation($responses['each_detail'][$i])?>)
                      </span>
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

<script>
    //Track your response using local storage: executed on load, to avoid global variables
    (function() {
        for (let i = 0; i < localStorage.length; i++){
            if(localStorage.key(i) == <?php echo $survey['id']?>) {
                str = localStorage.getItem(localStorage.key(i));
                let o = queryStringToJSON(str);
                let sum = 0;
                for (let i = 1; i < <?php echo $i?>; i++) {
                    document.getElementById('myAns' + i).textContent = o["q" + i];
                    sum += parseInt(o["q" + i]);
                }
            } else if(localStorage.key(i) == '<?php echo $survey['id']?>s1') {
                str = localStorage.getItem(localStorage.key(i));
                document.getElementById('myCat1').textContent = str;
            } else if(localStorage.key(i) == '<?php echo $survey['id']?>s2') {
                str = localStorage.getItem(localStorage.key(i));
                document.getElementById('myCat2').textContent = str;
            }
        }
    })();
</script>