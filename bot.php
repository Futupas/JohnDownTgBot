<?php
    // 636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts
    // api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts
    
    function strtolower_my($str) {
        $str2 = strtolower($str);
        $search = array(
        'Й','Ц','У','К','Е','Н','Г','Ш','Щ','З','Х','Ъ','Ф','Ы','В','А','П','Р','О','Л','Д','Ж','Э','Я','Ч','С','М','И','Т','Ь','Б','Ю','Ё','І','Ї'
        );
        $replace = array(
        'й','ц','у','к','е','н','г','ш','щ','з','х','ъ','ф','ы','в','а','п','р','о','л','д','ж','э','я','ч','с','м','и','т','ь','б','ю','ё','і','ї'
        );
        $str2 = str_replace($search, $replace, $str2);
        return $str2;
    };
        
    function SendMessage($chatid, $text) {
        $response = file_get_contents('https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text='.$text);
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
        $readymsg = strtolower($msg);
        file_put_contents("logs.txt", "readymsg ".$readymsg."\n", FILE_APPEND);
        $readymsg = str_replace("  ", " ", $readymsg);
        $readymsg = str_replace("!", "", $readymsg);
        $readymsg = str_replace("?", "", $readymsg);
        $readymsg = str_replace(",", "", $readymsg);
        $readymsg = str_replace(".", "", $readymsg);
        $readymsg = str_replace("-", "", $readymsg);
        $readymsg = str_replace(")", "", $readymsg);
        $readymsg = str_replace("(", "", $readymsg);
        file_put_contents("logs.txt", "readymsg ".$readymsg."\n", FILE_APPEND);
        file_put_contents("logs.txt", "readymsg to lower ".strtolower_my($readymsg)."\n", FILE_APPEND);
        file_put_contents("logs.txt", "readymsg ".$readymsg."\n", FILE_APPEND);
        $words = explode(" ", strtolower_my($readymsg));

        function onWordExists($readymsg) {
            file_put_contents("logs.txt", "On word Exists"."\n", FILE_APPEND);
            file_put_contents("logs.txt", "readymsg ".$readymsg."\n", FILE_APPEND);
            if (in_array("саня", $words)) {
                SendMessage($msg_chatid, "Саня лучший!");
                exit(0);
            }
            if (in_array("саша", array_values($words))) {
                SendMessage($msg_chatid, "Саша лучший!");
                exit(0);
            }
            if (in_array("панов", array_values($words))) {
                SendMessage($msg_chatid, "Панов лучший!");
                exit(0);
            }
            if (in_array("панчик", array_values($words))) {
                SendMessage($msg_chatid, "Панчик лучший");
                exit(0);
            }
            if (in_array("панчік", array_values($words))) {
                SendMessage($msg_chatid, "Панчик лучший");
                exit(0);
            }
            file_put_contents("logs.txt", strtolower_my($readymsg)."\n", FILE_APPEND);
            if (strtolower_my($readymsg) == "даун") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "джон") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "джонни") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "down") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "john") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "johny") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "джонні") {
                SendMessage($msg_chatid, "Что тебе, сука, надо?");
                exit(0);
            }
            if (strtolower_my($readymsg) == "дз") {
                SendMessage($msg_chatid, "Настя @Stacy2107, скинь людям домашнее задание, пожалуйста!&parse_mode=Markdowm");
                exit(0);
            }
            if (in_array("sendto11a", $words) && count($words) == 1) {
                SendMessage($msg_chatid, substr($msg, 10));
                //chat 11 A
                exit(0);
                if (in_array("даун", $words)) {
                    SendMessage($msg_chatid, substr($msg, 10));
                    //chat 11 A
                    exit(0);
                    if (strpos($msg, "?") !== false) { //constains
    
                    } else { // doesnt contain
    
                    }
                }
            }
            
        };
        onWordExists($readymsg);
        
        
    } else {
        echo("This is Johny Down bot");
    }
?>