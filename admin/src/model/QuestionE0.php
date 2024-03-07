<?php

include_once (__DIR__ . '/Question.php');



class QuestionE0Model extends QuestionModel

{

    private $pleasant = 0;

    private $unpleasant = 0;

    private $activated = 0;

    private $deactived = 0;



    public function __construct(PDO $db, $questionInfo)

    {

        $this->db = $db;

        $this->survey_id = $questionInfo['survey_id'];

        $this->q_id = $questionInfo['q_id'];

        $this->q = $questionInfo['q'];

    }


    public function addQuestion() {

        $sql = "INSERT INTO question (survey_id, q, q_type)
        VALUES ({$this->survey_id}, '{$this->q}', JSON_OBJECT('Pleasant', {$this->pleasant}, 'Unpleasant', {$this->unpleasant}, 'Activated', {$this->activated}, 'Deactived', {$this->deactived}) )";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');

        return $this->db->query($sql);

    }


    public function saveQuestion() {

        $sql = "update question 

            set q = '{$this->q}', q_type = JSON_OBJECT('Pleasant', {$this->pleasant}, 'Unpleasant', {$this->unpleasant}, 'Activated', {$this->activated}, 'Deactived', {$this->deactived}) 

            where id = {$this->q_id}";

        //error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');

        return $this->db->query($sql);

    }



    /**

     * @param mixed $pleasant

     */

    public function setPleasant($pleasant)

    {

        $this->pleasant = $pleasant;

    }



    /**

     * @param mixed $unpleasant

     */

    public function setUnpleasant($unpleasant)

    {

        $this->unpleasant = $unpleasant;

    }



    /**

     * @param mixed $activated

     */

    public function setActivated($activated)

    {

        $this->activated = $activated;

    }



    /**

     * @param mixed $deactived

     */

    public function setDeactived($deactived)

    {

        $this->deactived = $deactived;

    }

}