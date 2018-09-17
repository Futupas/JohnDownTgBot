<?php
    $MainTimer = new EvTimer(10, 1, function () {
    // $MainTimer = new EvTimer(1860, 1, function () {
        echo "2 seconds elapsed\n";
        
        $cursecs = time() + 10800;
        $curdatetime = date("D h:i", $cursecs);

        file_put_contents('logs.txt', $curdatetime."\n", FILE_APPEND);
        file_put_contents('logs.txt', $curdatetime."\n\n", FILE_APPEND);
    });
?>