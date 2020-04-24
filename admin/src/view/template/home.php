<?php $this->layout('main_layout', ['title' => $title]) ?>

<div id="container">
    <div id="survey_input_area">
        <div id="title"><?=$title?></div>
        <div>
            <form method="GET" id="searchForm">
                <input type="text" name="searchName" id="searchName"/>
                <button id="btnSearch" type="button">Search</button>
                <button id="btnToggleForm" type="button">Add</button>
            </form>
        </div>
    </div>
    <div id="addFormContainer">
        <form method="post" action="">
            <input type="text" id="name" name="name" maxlength="40" placeholder="Survey Name"/>
            <input type="text" id="desc" name="desc" maxlength="40" placeholder="About survey"/>
            <input type="text" id="sType" name="sType" placeholder="Survey type [e.g. <?= $types?>]"/>

            <button id="btnAdd" type="button">Save</button>
        </form>
    </div>
    <div id="list">
        <?php foreach($surveys as $survey): ?>
            <div class="card clearfix" id="<?=$survey['id']?>">
                <span>
                    <p class="survey_name"><?=$survey['id']?>. [<?=$survey['type']?>] <?=$survey['name']?></p>
                    <p class="survey_desc"><?=$survey['explanation']?></p>
                </span>
                <div>
                    <button class="btn red" onclick="deleteSurvey(this)">Delete</button>
                    <button class="btn orange" onclick="resetSurvey(this)">Reset</button>
                    <button class="btn blue" onclick="dupSurvey(this)">Duplicate</button>
                    <button class="btn darkGreen" onclick="manageSurvey(this)">Manage</button>
                    <button class="btn green" onclick="viewSurvey(this)">View</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php //$this->insert('sidebar') ?>

<?php $this->push('scripts') ?>
    <script>
        var surveyTypes = '<?= $types?>';
        // Some JavaScript
    </script>
<?php $this->end() ?>
