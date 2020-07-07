<?php
    require_once realpath(dirname(__FILE__)) . "/../config.php";
    $sql_remove = "DELETE FROM reservations WHERE changed_verification = 1 AND verified = 0";
    
    if($statement = mysqli_prepare($link, $sql_remove)){
        if(mysqli_stmt_execute($statement)){
        }
    }
?>