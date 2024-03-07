<?php
include_once (__DIR__ . '/Survey.php');

class SurveyE0Model extends SurveyModel
{
    private $levelDesc;
    private $categories;

    public function __construct(PDO $db, $survey_info)
    {
        //parent's
        $this->db          = $db;
        $this->id          = $survey_info['id'];
        $this->name        = $survey_info['name'];
        $this->type        = $survey_info['type'];
        $this->explanation = $survey_info['explanation'];
        $this->nLevel      = $survey_info['nLevel'];

        //child's
        $tmpArr = explode(',', $survey_info['levelDesc']);
        $tmpArr = array_map(function($value) { return "'".trim($value)."'"; }, $tmpArr);
        $this->levelDesc   = implode(',', $tmpArr);

        $tmpArr = explode(',', $survey_info['categories']);
        $tmpArr = array_map(function($value) { return "'".trim($value)."'"; }, $tmpArr);
        $this->categories  = implode(',', $tmpArr);
    }

    public function saveSurvey() {
        $sql = "update survey set
                name = '{$this->name}',
                type = '{$this->type}',
                explanation = '{$this->explanation}',
                cfg = JSON_OBJECT('item_level', {$this->nLevel}, 'category', JSON_ARRAY({$this->categories}), 'levels', JSON_ARRAY({$this->levelDesc}))
            where id = $this->id";

        return $this->db->query($sql);
    }
}