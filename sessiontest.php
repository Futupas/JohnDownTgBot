<?php
    //
    session_start();
    if(isset($_SESSION['testvar1_привіт'])) {
        echo $_SESSION['testvar1_привіт'];
        $_SESSION['testvar1_привіт'] = $_SESSION['testvar1_привіт'] + 1;
    } else {
        $_SESSION['testvar1_привіт'] = 0;
    }
?>