<?php
    // 636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts
    // api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts

    function SendMessage($chatid, $text) {
        $response = file_get_contents('https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text=you'.$text);
    };
    function ReplyToMessage($chatid, $text, $msgtoreply) {
        $response = file_get_contents(
            'https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text='.$text.'&reply_to_message_id='.$msgtoreply
        );
    };

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestString = file_get_contents('php://input');
        $requestData = json_decode($requestString);
        file_put_contents('logs.txt', date("Y-m-d H:i:s")."   ".$requestString."\n\n", FILE_APPEND);

        $msg_id = $requestData->message->message_id;
        $msg_chatid = $requestData->message->chat->id;
        $msg_sendername = $requestData->message->from->first_name;

        // ON VOICE OR VIDEO
        if (property_exists($requestData->message, 'voice')) {
            ReplyToMessage($msg_chatid, "Тебя научить пользоваться клавиатурой телефона? Засунь себе в жопу свой войс, уёбок.", $msg_id);
            exit(0);
        };
        if (property_exists($requestData->message, 'video_note')) {
            ReplyToMessage($msg_chatid, "Всем противно смотреть на твоё ебло. нарисуй его на бумаге и обосри. И сюда больше не пиши.", $msg_id);
            exit(0);
        };

        $msg = $requestData->message->text;
        $readymsg = mb_strtolower($msg, 'UTF-8');
        $readymsg = str_replace("  ", " ", $readymsg);
        $readymsg = str_replace("!", "", $readymsg);
        $readymsg = str_replace("?", "", $readymsg);
        $readymsg = str_replace(",", "", $readymsg);
        $readymsg = str_replace(".", "", $readymsg);
        $readymsg = str_replace("-", "", $readymsg);
        $readymsg = str_replace(")", "", $readymsg);
        $readymsg = str_replace("(", "", $readymsg);
        $words = explode(" ", strtolower($readymsg));

        file_put_contents('logs.txt', $msg."\n", FILE_APPEND);
        file_put_contents('logs.txt', $readymsg."\n", FILE_APPEND);
        file_put_contents('logs.txt', json_encode($words)."\n", FILE_APPEND);

        // ON PANCHIK / DOWN
        if (in_array("саня", $words)) {
            SendMessage($msg_chatid, "Саня лучший!");
            exit(0);
        }
        if (in_array("саша", $words)) {
            SendMessage($msg_chatid, "Саша лучший!");
            exit(0);
        }
        if (in_array("панов", $words)) {
            SendMessage($msg_chatid, "Панов лучший!");
            exit(0);
        }
        if (in_array("панчик", $words)) {
            SendMessage($msg_chatid, "Панчик лучший");
            exit(0);
        }
        if (in_array("панчік", $words)) {
            SendMessage($msg_chatid, "Панчик лучший");
            exit(0);
        }
        if (in_array("даун", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("джон", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("джонни", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("down", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("john", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("johny", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (in_array("джонні", $words) && count($words) == 1) {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        
    } else {
        echo("This is Johny Down bot");
    }
?>