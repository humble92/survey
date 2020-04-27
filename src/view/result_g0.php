    <div class="themeStripe"></div>
    <div class="formOuterContainer">
        <div class="formInnerContainer">

          <div class="surveyHeader">
            <div class="surveyTitle" dir="auto" role="heading">“<?php echo $survey['name']?>”</div>
              <div class="surveyResultMe" dir="auto">My average: <span id="myAvg"></span></div>
            <div class="surveyResultTotal" dir="auto">Total average: <?php echo $t_average?> (SD: <?php echo $sd?>)</div>
            <div class="surveyResultCnt" dir="auto">Total responses: <?php echo count($responses['total'])?></div>
          </div>
          
          <div class="qItemList" role="list">
            <?php $i = 0; foreach ($questionList as $row): ?>
              <div class="qItemContainer">
              <div role="listitem" class="qItemSubContainer">
                <div class="qItemTitle" role="heading">Q<?php echo ++$i.' '.$row['q'];?></div>

                <div class="surveyResultMe" dir="auto">My answer: <span id="myAns<?php echo $i?>"></span></div>
                <div class="surveyResultTotal" dir="auto">
                  Average: <?php echo number_format($responses['each'][$i]/count($responses['total']), 2)?>
                  (SD:<?php echo Stand_Deviation($responses['each_detail'][$i])?>)
                </div>

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

<script>
//Track your response using local storage: executed on load, to avoid global variables
(function() {
    for (let i = 0; i < localStorage.length; i++){
        if(localStorage.key(i) == <?php echo $survey['id']?>) {
            str = localStorage.getItem(localStorage.key(i));
            console.log(str);
            break;
        }
    }
    let o = queryStringToJSON(str);
    let sum = 0;
    for (let i = 1; i <= <?php echo $i?>; i++) {
        document.getElementById('myAns' + i).textContent = o["q" + i];
        sum += parseInt(o["q" + i]);
    }
    document.getElementById('myAvg').textContent = (sum/<?php echo $i?>).toFixed(2);
})();
</script>