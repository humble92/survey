<?php
class SurveyModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllSurveys() {
        return $this->db->query('SELECT * FROM survey order by id desc');
    }

    public function getSurveyTypes() {
        return $this->db->query('SELECT distinct type FROM survey');
    }

    public function addSurvey($data) {
        switch($data['sType']) {
            case 'G0':
                $cfg = "JSON_OBJECT('mc_num', 7, 'mc_label_lowest', 'Strongly disagree', 'mc_label_highest', 'Strongly agree')";
                break;
            case 'E0':
                $cfg = "JSON_OBJECT('item_level', 6, 'category', JSON_ARRAY('Pleasant feelings', 'Unpleasant feelings', 'Activated feelings', 'Deactived feelings', 'Pleasantness', 'Activation'), 'levels', JSON_ARRAY('0.<br>Not at all', '1.<br>A little', '2.<br>Somewhat', '3.<br>Moderately', '4.<br>Quite a bit', '5.<br>Extremely so'))";
                break;
        }

        $sql = "INSERT INTO survey
            (`type`, name, explanation, creator_id, is_public, start_date, end_date, cfg)
            VALUES('{$data['sType']}', '{$data['name']}', '{$data['desc']}', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', {$cfg});
        ";
        error_log(print_r($sql,true), 3, __DIR__ . '/../../../log/debug.log');
        return $this->db->query($sql);
    }

    // Gets surveys list including specific characters from the database
    function searchSurvey($word) {
        error_log($word, 3, dirname(__FILE__) . "/../../log/debug.log");
        $sql = "SELECT * from survey where name like :word or explanation like :word order by id desc";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':word', '%'.$word.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete specific survey and relevant data from the database
    function dupSurvey($id) {
        $this->db->query("INSERT INTO survey (`type`, name, explanation, creator_id, is_public, start_date, end_date, cfg)
            SELECT `type`, name, explanation, creator_id, is_public, start_date, end_date, cfg
            FROM survey WHERE id = " . $id);
    
        return $this->db->query("INSERT INTO question (survey_id, q, q_type, mc_choices, answer_key)
            SELECT ".$this->db->lastInsertId().", q, q_type, mc_choices, answer_key
            FROM question WHERE survey_id =" . $id);
    }
    
    // Delete specific survey and relevant table from the database
    function deleteSurvey($id) {
        $this->db->query("DELETE from answer where survey_id = " . $id);
        $this->db->query("DELETE from question where survey_id = " . $id);
        return $this->db->query("DELETE from survey where id = " . $id);
    }

}