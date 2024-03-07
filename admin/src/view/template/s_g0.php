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

                    <input class="formControl" type="number" id="nLevel" name="nLevel" min="1" max="99" value="<?=$cfg['mc_num']?>" placeholder="Number of levels"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">Lowest level description: </p>

                    <input class="formControl" type="text" id="lDesc" name="lDesc" maxlength="500" value="<?=$cfg['mc_label_lowest']?>" placeholder="Level descriptions - should be the same as # of levels above. (Comma seperated values)"/>

                </div>

                <div class="clearfix">

                    <p class="formLabel">Highest level description: </p>

                    <input class="formControl" type="text" id="hDesc" name="hDesc" maxlength="500" value="<?=$cfg['mc_label_highest']?>" placeholder="Analysis categories. (Comma seperated values)"/>

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

                    $qArr = array();

                    $i = 0; 

                    foreach($questions as $q): 

                        $qArr[] = $q['id'];

                ?>

                    <div class="clearfix">

                        <p class="formLabel">Question <?= ++$i?>. </p>

                        <input type="text" class="formControl" id="q<?=$q['id']?>" name="q<?=$q['id']?>" maxlength="500" value="<?=$q['q']?>" placeholder="Type survey item"/>

                        <input type="checkbox" class="qchkbox" id="qc<?=$q['id']?>_del" name="qc<?=$q['id']?>[]" value="del"><span style="color: red; float: none;">Delete</span>

                    </div>

                <?php endforeach?>

                <?php for($k = 0; $k < 10; $k++) { ?>
                    <div class="clearfix">
                        <p class="formLabel">Question <?= ++$i?>. </p>
                        <input type="text" class="formControl" id="q_new<?=$k?>" name="q_new<?=$k?>" maxlength="500" value="" placeholder="Type survey item"/>
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