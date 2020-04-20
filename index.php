<?php 
include("./src/include/header.php"); 

$mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRING);

if($mode == 'v')
    include (dirname(__FILE__) . '/src/controller/result_'.strtolower($survey["type"]).'.php');
else if(isset($survey['type']))
    include (dirname(__FILE__) . '/src/controller/survey_'.strtolower($survey["type"]).'.php');


include("./src/include/footer.php"); 
?>