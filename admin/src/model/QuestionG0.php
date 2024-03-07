<?php

include_once (__DIR__ . '/Question.php');



class QuestionG0Model extends QuestionModel

{

    public function __construct(PDO $db, $questionInfo)

    {

        $this->db = $db;

        $this->survey_id = $questionInfo['survey_id'];

        $this->q_id = $questionInfo['q_id'];

        $this->q = $questionInfo['q'];

    }


    public function addQuestion() {

        $sql = "INSERT INTO question (survey_id, q)
        VALUES ({$this->survey_id}, '{$this->q}' )";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');

        return $this->db->query($sql);

    }


    public function saveQuestion() {

        $sql = "update question set q = '{$this->q}' where id = {$this->q_id}";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');

        return $this->db->query($sql);

    }

}