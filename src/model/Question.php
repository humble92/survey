<?php
class QuestionModel
{
    protected $db;
    protected $survey_id;

    public function __construct(PDO $db, $survey_id)
    {
        $this->db = $db;
        $this->survey_id = $survey_id;
    }

    public function getAllQuestions() {
        return $this->db->query('SELECT * FROM question where survey_id = ' . $this->survey_id . ' order by id');
    }
}