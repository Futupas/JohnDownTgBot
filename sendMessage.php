<?php

echo
file_get_contents('https://api.telegram.org/bot'.$_GET['bot_token'].'/sendMessage?chat_id='.$_GET['chat_id'].'&parse_mode=Markdown&text='.$_GET['text']);



    // $result = file_get_contents("https://api.telegram.org/bot860940041:AAE8lRsQUHMkpF1rlgUyX27PEiFXSd55Sh0/sendMessage?chat_id=649365656&text=hello world");

    // echo $result;

?>