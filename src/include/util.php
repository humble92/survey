<?php
function check_var($id, $message) {
    if(!isset($id)) {
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>window.history.back()</script>";
        exit();
    }
}