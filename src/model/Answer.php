<?php
class AnswerModel
{
    protected $db;
    protected $survey_id;

    public function __construct(PDO $db, $survey_id)
    {
        $this->db = $db;
        $this->survey_id = $survey_id;
    }

    public function saveResponses($answers) {
        $json = json_encode($answers);
        return $this->db->query("INSERT INTO answer (survey_id, a) VALUES('.$this->survey_id.', '".$json."')");
    }

    public function getResponses() {
        return $this->db->query('SELECT a FROM answer where survey_id = ' . $this->survey_id);
    }
}