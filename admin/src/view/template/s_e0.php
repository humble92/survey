<?php $this->layout('main_layout', ['title' => $title]) ?>



<div id="container">

    <div id="formContainer">

        <div id="title"><?=$survey['name']?></div>



        <form method="post" id="fs" action="index.php">

            <div class="card clearfix" id="s<?=$survey['id']?>">

                <div class="clearfix">

                    <p class="formLabel">Survey Name: </p>

                    <input class="formControl" type="text" id="name" name="name" maxlength="500" value="<?=$survey['name']?>" placeholder="Survey Name"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">Supplementary explanation: </p>

                    <input class="formControl" type="text" id="desc" name="desc" maxlength="1000" value="<?=$survey['explanation']?>" placeholder="Survey explanation"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">Survey type code: </p>

                    <input class="formControl" type="text" id="sType" name="sType" maxlength="2" value="<?=$survey['type']?>" placeholder="Survey type code predefined"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel"># of levels: </p>

                    <input class="formControl" type="number" id="nLevel" name="nLevel" min="1" max="99" value="<?=$cfg['item_level']?>" placeholder="Number of levels"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">level descriptions (CSV): </p>

                    <input class="formControl" type="text" id="levelDesc" name="levelDesc" maxlength="500" value="<?=implode(", ",$cfg['levels'])?>" placeholder="Level descriptions - should be the same as # of levels above. (Comma seperated values)"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">Categories (CSV): </p>

                    <input class="formControl" type="text" id="categories" name="categories" maxlength="500" value="<?=implode(", ",$cfg['category'])?>" placeholder="Analysis categories. (Comma seperated values)"/>

                </div>

            </div>

            <div class="btnContainerRight">

                <div role="button" class="button" onclick="javascript:alert('will be implemented later');" tabindex="0">

                    <span class="">More questions (+5)</span>

                </div>

            </div>

            <div class="btnContainer">

                <div role="button" class="button" onclick="javascript:window.close();" tabindex="0">

                    <span class="">Close</span>

                </div>

                <div role="button" class="button" onclick="javascript:document.getElementById('fs').submit();" tabindex="0">

                    <span class="">Save</span>

                </div>

            </div>

            <input type="hidden" name="id" id="id" value="<?php echo $survey['id']?>">

            <input type="hidden" name="mode" id="mode" value="s">

        </form>



        <form method="post" id="fq" action="index.php">

            <div class="card clearfix qContainer" id="q<?=$survey['id']?>">
                <?php

                    $cnt = isset($cfg['category']) ? (sizeof($cfg['category']) - 2): 0;

                ?>

                <?php $qArr = array(); $i = 0; foreach($questions as $q): ?>

                    <div class="clearfix">

                        <input type="text" class="sItem" id="q<?=$q['id']?>" name="q<?=$q['id']?>" maxlength="500" value="<?=$q['q']?>" placeholder="Type survey item"/>

                        <?php 

                            $qArr[] = $q['id'];

                            $q_type = json_decode($q['q_type'], true);

                            for($j = 0; $j < $cnt; $j++) {

                                $tmpArr = explode(' ', $cfg['category'][$j]);

                                $checked = $q_type[$tmpArr[0]];

                        ?>

                            <input type="checkbox" class="qchkbox" id="qc<?=$q['id']?>_<?php echo $j?>" name="qc<?=$q['id']?>[]" value="<?php echo $j?>" <?php if($checked) echo "checked"; ?>><?= $cfg['category'][$j]?>

                        <?php $i++; } ?>

                        <input type="checkbox" class="qchkbox" id="qc<?=$q['id']?>_del" name="qc<?=$q['id']?>[]" value="del"><span style="color: red; float: none;">Delete</span>

                    </div>

                <?php endforeach?>

                <?php for($k = 0; $k < 10; $k++) { ?>

                    <div class="clearfix">

                        <input type="text" class="sItem" id="q_new<?=$k?>" name="q_new<?=$k?>" maxlength="500" value="" placeholder="Type survey item"/>

                        <?php for($j = 0; $j < $cnt; $j++) {?>
                            <input type="checkbox" class="qchkbox" id="qc_new<?=$k?>_<?php echo $j?>" name="qc_new<?=$k?>[]" value="<?php echo $j?>"><?= $cfg['category'][$j]?>
                        <?php } ?>

                    </div>

                <?php } ?>

            </div>



            <div class="btnContainerRight">

                <div role="button" class="button" onclick="javascript:alert('will be implemented later');" tabindex="0">

                    <span class="">More questions (+5)</span>

                </div>

            </div>

            <div class="btnContainer">

                <div role="button" class="button" onclick="javascript:window.close();" tabindex="0">

                    <span class="">Close</span>

                </div>

                <div role="button" class="button" onclick="javascript:document.getElementById('fq').submit();" tabindex="0">

                    <span class="">Save</span>

                </div>

            </div>

            <input type="hidden" name="id" id="id" value="<?php echo $survey['id']?>">

            <input type="hidden" name="mode" id="mode" value="q">

            <input type="hidden" name="qArrStr" id="qArrStr" value="<?= implode(',', $qArr)?>">

        </form>

    </div>

</div>



<?php //$this->insert('sidebar') ?>



<?php $this->push('scripts') ?>

    <script>

        // Some JavaScript

    </script>

<?php $this->end() ?>