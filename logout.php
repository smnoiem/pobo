<?php
    include('dbcon.php');
    session_start();
    if(session_destroy()) {
        header("Location: home.php");
    }
    else echo"Not Destroyed!";
?>
