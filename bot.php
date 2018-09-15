<?php
    // 636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts
    // api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts

    function SendMessage($chatid, $text) {
        $response = file_get_contents('https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text=you'.$text);
    };
    function ReplyToMessage($chatid, $text, $msgtoreply) {
        $response = file_get_contents('https://api.telegram.org/bot636469447:AAEnwoa5s_Ati_miiHQukaIhSalotJSk0Ts/sendMessage?chat_id='.$chatid.'&text='.$text.'&reply_to_message_id=');
    };

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestString = file_get_contents('php://input');
        $requestData = json_decode($requestString);
        file_put_contents('logs.txt', date("Y-m-d H:i:s")."   ".$requestString."\n\n", FILE_APPEND);

        $msg_id = $requestData->message->message_id;
        $msg_chatid = $requestData->message->chat->id;
        $msg_sendername = $requestData->message->from->first_name;

        if (property_exists($requestData->message, 'voice')) {
            ReplyToMessage($msg_chatid, "Тебя научить пользоваться клавиатурой телефона? Засунь себе в жопу свой войс, уёбок.", $msg_id);
            exit(0);
        };
        if (property_exists($requestData->message, 'video_note')) {
            ReplyToMessage($msg_chatid, "Всем противно смотреть на твоё ебло. нарисуй его на бумаге и обосри. И сюда больше не пиши.", $msg_id);
            exit(0);
        };

        $msg = $requestData->message->text;
        
    } else {
        echo("This is Johny Down bot");
    }
?>