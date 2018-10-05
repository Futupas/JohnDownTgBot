<?php
    //
    session_start();
    if(isset($_POST['testvar1'])) {
        echo $_POST['testvar1'];
        $_POST['testvar1'] = $_POST['testvar1'] + 1;
    } else {
        $_POST['testvar1'] = 0;
    }
?>