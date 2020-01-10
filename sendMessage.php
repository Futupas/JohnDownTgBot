<?php
echo
file_get_contents('https://api.telegram.org/bot'.$_GET['bot_token'].'/sendMessage?chat_id='.$_GET['chat_id'].'&parse_mode=Markdown&text='.$_GET['text']);
return true;
exit;
?>