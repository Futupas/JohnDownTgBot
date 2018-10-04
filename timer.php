<?php
    // https://johndowntgbot.herokuapp.com/timer.php
    function SendMessage($chatid, $text) {
        $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$text);
    };
    echo "Timer was set";
    $today = false;
    while (true) {
        $cursecs = time() + 10800;
        $currhours = intval(date("H", $cursecs));
        // $currday = date("D", $cursecs);
        $currday = intval(date("w", $cursecs));
        if ($currday == 5 && !$today) { // Friday
            SendMessage(-1001359755141, "УРА! Пятница! Завтра выходные!!!");
            $today = true;
        } else if ($currday == 1 && !$today) { // Monday
            SendMessage(-1001359755141, "Бля, ненавижу сраные понедельники. Сегодня как раз он.");
            $today = true;
        } else {
            $today = false;
        }
        
        sleep(1860);
    }
?>