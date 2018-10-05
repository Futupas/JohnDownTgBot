<?php
    //
    session_start();
    if(isset($_SESSION['testvar1'])) {
        echo $_SESSION['testvar1'];
        $_SESSION['testvar1'] = $_SESSION['testvar1'] + 1;
    } else {
        $_SESSION['testvar1'] = 0;
    }
?>