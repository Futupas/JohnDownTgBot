<?php
    // https://johndowntgbot.herokuapp.com/timer.php

    echo "Timer was set";
    while (true) {
        $cursecs = time() + 10800;
        $curdatetime = date("D h:i", $cursecs);

        file_put_contents('logs.txt', $curdatetime."\n", FILE_APPEND);
        file_put_contents('logs.txt', $curdatetime."\n\n", FILE_APPEND);
        sleep(10);
    }

?>