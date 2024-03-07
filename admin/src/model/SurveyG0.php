<?php
include_once (__DIR__ . '/Survey.php');

class SurveyG0Model extends SurveyModel
{
    private $lDesc;
    private $hDesc;

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
        $this->lDesc       = $survey_info['lDesc'];
        $this->hDesc       = $survey_info['hDesc'];
    }

    public function saveSurvey() {
        $sql = "update survey set
                name = '{$this->name}',
                type = '{$this->type}',
                explanation = '{$this->explanation}',
                cfg = JSON_OBJECT('mc_num', {$this->nLevel}, 'mc_label_lowest', '{$this->lDesc}', 'mc_label_highest', '{$this->hDesc}') 
            where id = $this->id";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');
        return $this->db->query($sql);
    }
}