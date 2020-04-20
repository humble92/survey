<?php

include (dirname(__FILE__) . '/../../config/db.php');
include (dirname(__FILE__) . '/util.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$id = $id ? $id : filter_input(INPUT_POST, 'survey_id', FILTER_SANITIZE_NUMBER_INT);

check_var($id, "[1] No valid survey exists.");

try {
    $stmt = $pdo->prepare("SELECT * FROM survey WHERE id = :id and (end_date = '0000-00-00 00:00:00' || now() <= end_date) and is_public = 1 ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch (PDOException $e) {
    echo '[2] No valid survey exists.';
}

$survey = $stmt->fetch(PDO::FETCH_ASSOC);
//error_log($survey['id'], 3, dirname(__FILE__) . "/../../log/debug.log");
check_var($survey['id'], "[3] No valid survey exists.");
