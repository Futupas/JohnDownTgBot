<?php
    // me: 387489833
    
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
        $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$text);
    };
    function ReplyToMessage($chatid, $text, $msgtoreply) {
        $response = file_get_contents(
            'https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$text.'&reply_to_message_id='.$msgtoreply
        );
    };
    // function StringContains($str, )


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestString = file_get_contents('php://input');
        $requestData = json_decode($requestString);
        file_put_contents('logs.txt', date("Y-m-d H:i:s")."   ".$requestString."\n\n", FILE_APPEND);

        $msg_id = $requestData->message->message_id;
        $msg_chatid = $requestData->message->chat->id;
        $msg_senderid = $requestData->message->from->id;
        $msg_sendername = $requestData->message->from->first_name;

        // ON VOICE OR VIDEO
        if (property_exists($requestData->message, 'voice')) {
            if ($requestData->message->voice->duration < 2) {
                $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/deleteMessage?chat_id='.$msg_chatid.'&message_id='.$msg_id);
            }
            else if ($requestData->message->voice->duration < 10) {
                ReplyToMessage($msg_chatid, "Напиши, уебан.", $msg_id);
            }
            exit(0);
        };
        if (property_exists($requestData->message, 'video_note')) {
            if ($requestData->message->video_note->duration < 2) {
                $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/deleteMessage?chat_id='.$msg_chatid.'&message_id='.$msg_id);
            }
            else if ($requestData->message->video_note->duration < 10) {
                ReplyToMessage($msg_chatid, "Спасибо, что показал(а) нам свое еблище.", $msg_id);
            }
            exit(0);
        };
        // if (property_exists($requestData->message, 'pinned_message')) {
        //     if ($requestData->message->from->id == 636469447) { //if bot pinned msg
        //         //$response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/deleteMessage?chat_id='.$msg_chatid.'&message_id='.$msg_id);
        //     }
        //     exit(0);
        // };

        $msg = $requestData->message->text;
        $readymsg = strtolower($msg);
        $readymsg = str_replace("  ", " ", $readymsg);
        $readymsg = str_replace("!", "", $readymsg);
        $readymsg = str_replace("?", "", $readymsg);
        $readymsg = str_replace(",", "", $readymsg);
        $readymsg = str_replace(".", "", $readymsg);
        $readymsg = str_replace("-", "", $readymsg);
        $readymsg = str_replace(")", "", $readymsg);
        $readymsg = str_replace("(", "", $readymsg);
        $readylower = strtolower_my($readymsg);
        $words = explode(" ", $readylower);

        // ON WORD EXISTS

        if (strpos($msg, "sendto11a ") === 0) {
            SendMessage(getenv('11a_id'), substr($msg, 10));
            //chat 11 A
            exit(0);
        }
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
            SendMessage($msg_chatid, "Панчік кращий!");
            exit(0);
        }
        if (in_array("пин", $words) || in_array("pin", $words)) {
            if (property_exists($requestData->message, 'reply_to_message')) {
                $pinid = $requestData->message->reply_to_message->message_id;
                $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/pinChatMessage?chat_id='.$msg_chatid.'&message_id='.$pinid);
                //$response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/deleteMessage?chat_id='.$msg_chatid.'&message_id='.$msg_id);
                // $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$msg_chatid.'&text=pinned '.$pinid);
                
                // SendMessage($msg_chatid, '['.$requestData->message->from->first_name.' '.
                //             $requestData->message->from->last_name.'](tg://user?id='.
                //             $requestData->message->from->id.')'.' pinned "'.$requestData->message->reply_to_message->text.
                //             '"&parse_mode=Markdown'); 
            };
            exit(0);
        }
        if ((in_array("унпин", $words) || in_array("анпин", $words) || in_array("unpin", $words)) && in_array("джонни", $words))  {
            $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/unpinChatMessage?chat_id='.$msg_chatid);
            exit(0);
        }

        if ( strpos($readylower, '/days_to_iee') !== false ) {
            $d_iee = new DateTime('2019-05-21T11:00:00');
            $d_now = new DateTime();
            SendMessage($msg_chatid, "До ЗНО осталось ".$d_iee->diff($d_now)->format("%a")." дней." ); 
            exit(0);
        }

        // if ( (in_array("джон", $words) || in_array("джонни", $words) || in_array("даун", $words) || in_array("джонні", $words)) &&
        //     (in_array("сказка", $words) || in_array("казка", $words) || in_array("сказку", $words) || in_array("казку", $words)) ) {
        //     $response = file_get_contents(
        //         'https://api.telegram.org/bot'.getenv('bot_token').'/sendAudio?chat_id='.$msg_chatid.'&audio=CQADAgADMgIAAqG5mUlzxUSxeBo4YQI'
        //     );
        //     exit(0);
        // }
        // if ( (in_array("джон", $words) || in_array("джонни", $words) || in_array("даун", $words) || in_array("джонні", $words)) &&
        //     (in_array("история", $words) || in_array("историю", $words) || in_array("історія", $words) || in_array("історію", $words)) ) {
        //     $response = file_get_contents(
        //         'https://api.telegram.org/bot'.getenv('bot_token').'/sendVoice?chat_id='.$msg_chatid.'&voice=CQADAgADMwIAAqG5mUmxJU-Lfr2NogI'
        //     );
        //     exit(0);
        // }
        if ($readylower == "даун" || $readylower == "джон" || $readylower == "джонни" || $readylower == "down" || $readylower == "джонні") {
            SendMessage($msg_chatid, "Что тебе, сука, надо?");
            exit(0);
        }
        if (count($words) == 1 && strpos($readylower, 'дз') !== false) {
            SendMessage($msg_chatid, "Настя @Stacy2107, скинь людям домашнее задание, пожалуйста!"); //&parse_mode=Markdowm
            exit(0);
        }
        if (in_array("даун", $words)) {
            if (strpos($msg, "?") !== false) { //constains
                SendMessage($msg_chatid, "Откуда я, нахуй, знаю?!");
            } else { // doesnt contain
                $sendmsg = str_replace("даун", "", $msg);
                $sendmsg = str_replace("Даун", "", $sendmsg);
                $sendmsg = str_replace("ДАУН", "", $sendmsg);
                $sendmsg = str_replace("  ", " ", $sendmsg);
                $sendmsg = "Сам ".$sendmsg;
                $sendmsg = str_replace("  ", " ", $sendmsg);
                SendMessage($msg_chatid, $sendmsg);
            }
            exit(0);
        }
        if (in_array("джон", $words)) {
            if (strpos($msg, "?") !== false) { //constains
                SendMessage($msg_chatid, "Откуда я, нахуй, знаю?!");
            } else { // doesnt contain
                $sendmsg = str_replace("джон", "", $msg);
                $sendmsg = str_replace("Джон", "", $sendmsg);
                $sendmsg = str_replace("ДЖОН", "", $sendmsg);
                $sendmsg = str_replace("  ", " ", $sendmsg);
                $sendmsg = "Сам ".$sendmsg;
                $sendmsg = str_replace("  ", " ", $sendmsg);
                SendMessage($msg_chatid, $sendmsg);
            }
            exit(0);
        }
        if (strpos($readylower, 'слава') !== false && (strpos($readylower, 'украине') !== false || strpos($readylower, 'україні') !== false)) {
            ReplyToMessage($msg_chatid, "Героям слава!", $msg_id);
            exit(0);
        }
        if (strpos($readylower, 'воскрес') !== false && (strpos($readylower, 'иисус') || strpos($readylower, 'исус') !== false)) {
            ReplyToMessage($msg_chatid, "Воистину Воскрес)", $msg_id);
            exit(0);
        }
        if (strpos($readylower, 'воскрес') !== false && strpos($readylower, 'ісус') !== false) {
            ReplyToMessage($msg_chatid, "Воістину воскрес)", $msg_id);
            exit(0);
        }
        if (count($words) <= 2 && strpos($readylower, 'спасибо') !== false) {
            ReplyToMessage($msg_chatid, "Пожалуйста.", $msg_id);
            exit(0);
        }
        if (count($words) <= 2 && strpos($readylower, 'дякую') !== false) {
            ReplyToMessage($msg_chatid, "Будь ласка.", $msg_id);
            exit(0);
        }

        if (in_array("вики", $words)) {
            $query = str_replace("вики", "", $msg);
            $getjson = file_get_contents('https://ru.wikipedia.org/w/api.php?action=opensearch&prop=info&format=json&inprop=url&search='.urlencode($query));
            file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$query);
            $resultwiki = json_decode($getjson);

            $title1 = $resultwiki[1][0];
            $content1 = $resultwiki[2][0];
            $link1 = $resultwiki[3][0];
            $message1 = "*".$title1."* %0A".$content1." %0A"."[Википедия](".$link1.")";
            file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?parse_mode=Markdown&disable_web_page_preview=true&chat_id='.$msg_chatid.'&text='.$message1);
            
            // $title2 = $resultwiki[1][1];
            // $content2 = $resultwiki[2][1];
            // $link2 = $resultwiki[3][1];
            // $message2 = "*".$title2."* %0A".$content2." %0A"."[Википедия](".$link2.")";
            // file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?parse_mode=Markdown&disable_web_page_preview=true&chat_id='.$msg_chatid.'&text='.$message2);
            
            // $title3 = $resultwiki[1][2];
            // $content3 = $resultwiki[2][2];
            // $link3 = $resultwiki[3][2];
            // $message3 = "*".$title3."* %0A".$content3." %0A"."[Википедия](".$link3.")";
            // file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?parse_mode=Markdown&disable_web_page_preview=true&chat_id='.$msg_chatid.'&text='.$message3);

            exit(0);
        }
        if (in_array("вікі", $words)) {
            $query = str_replace("вікі", "", $msg);
            $getjson = file_get_contents('https://uk.wikipedia.org/w/api.php?action=opensearch&prop=info&format=json&inprop=url&search='.urlencode($query));
            file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$query);
            $resultwiki = json_decode($getjson);

            $title1 = $resultwiki[1][0];
            $content1 = $resultwiki[2][0];
            $link1 = $resultwiki[3][0];

            $message = "*".$title1."* %0A".$content1." %0A"."[Вікіпедія](".$link1.")";
            $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?parse_mode=Markdown&disable_web_page_preview=true&chat_id='.$msg_chatid.'&text='.$message);
            exit(0);
        }
        if (in_array("wiki", $words)) {
            $query = str_replace("wiki", "", $msg);
            $getjson = file_get_contents('https://en.wikipedia.org/w/api.php?action=opensearch&prop=info&format=json&inprop=url&search='.urlencode($query));
            file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?chat_id='.$chatid.'&text='.$query);
            $resultwiki = json_decode($getjson);

            $title1 = $resultwiki[1][0];
            $content1 = $resultwiki[2][0];
            $link1 = $resultwiki[3][0];

            $message = "*".$title1."* %0A".$content1." %0A"."[Wikipedia](".$link1.")";
            $response = file_get_contents('https://api.telegram.org/bot'.getenv('bot_token').'/sendMessage?parse_mode=Markdown&disable_web_page_preview=true&chat_id='.$msg_chatid.'&text='.$message);
            exit(0);
        }
        
    } else {
        echo("This is Johny Down bot");
    }
?>