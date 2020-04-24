<?php
function check_var($id, $message) {
    if(!isset($id)) {
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>window.history.back()</script>";
        exit();
    }
}

function Stand_Deviation($arr) 
{ 
    $num_of_elements = count($arr); 
      
    $variance = 0.0; 
      
            // calculating mean using array_sum() method 
    $average = array_sum($arr)/$num_of_elements; 
      
    foreach($arr as $i) 
    { 
        // sum of squares of differences between  
                    // all numbers and means. 
        $variance += pow(($i - $average), 2); 
    } 
      
    return number_format((float)sqrt($variance/$num_of_elements), 2);
} 