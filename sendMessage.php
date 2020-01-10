<?php

$requeststr = 'https://api.telegram.org/bot'.$_GET['bot_token'].'/sendMessage?chat_id='.$_GET['chat_id'].'&text='.$_GET['text'];
// $requeststr = htmlspecialchars_decode($requeststr);
// echo $requeststr;

echo
file_get_contents($requeststr);


?>