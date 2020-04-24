<?php
class AnswerModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Delete specific survey data (answer) from the database
    function resetSurvey($id) {
        return $this->db->query("DELETE from answer where survey_id = " . $id);
    }
    

}