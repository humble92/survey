<?php

class QuestionModel

{

    protected $db;

    protected $survey_id;

    protected $q_id;

    protected $q;

    protected $q_type;

    protected $mc_chices;

    protected $answer_key;



    public function __construct(PDO $db, $survey_id)

    {

        $this->db = $db;

        $this->survey_id = $survey_id;

    }



    public function getAllQuestions() {

        $stmt = $this->db->query('SELECT * FROM question where survey_id = ' . $this->survey_id . ' order by id');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    /**

     * @param mixed $q_id

     */

    public function setQId($q_id)

    {

        $this->q_id = $q_id;

    }



    /**

     * @param mixed $q

     */

    public function setQ($q)

    {

        $this->q = $q;

    }



    /**

     * @param mixed $q_type

     */

    public function setQType($q_type)

    {

        $this->q_type = $q_type;

    }

    public function deleteQuestion() {

        $sql = "delete from question 

            where id = {$this->q_id}";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');

        return $this->db->query($sql);

    }

}