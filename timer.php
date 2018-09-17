<?php
    // https://johndowntgbot.herokuapp.com/timer.php

    function SendMessage($chatid, $text) {
        $response = file_get_contents('https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text='.$text);
    };

    echo "Timer was set";
    while (true) {
        $cursecs = time() + 10800;
        $currhours = intval(date("H", $cursecs));
        // $currday = date("D", $cursecs);
        $currday = intval(date("w", $cursecs));

        if ($currday == 5 && $currhours < 1) { // Friday
            SendMessage(-1001359755141, "УРА! Пятница! Завтра выходные!!!");
        }
        if ($currday == 1 && $currhours < 1) { // Monday
            SendMessage(-1001359755141, "Бля, ненавижу сраные понедельники. Сегодня как раз он.");
        }
        
        sleep(1860);
    }

?>