<?php
include ('line-bot-api/php/line-bot.php');
$channelSecret = '8d97517a85a1d704b45855577ff77759';
$access_token  = 'QbHwcXULd8TW6bLJFmGvdjBEeRQHWVH4Z3BJdzg8bXeyzgk99sW6rmMxhq8nu9hr42KE9KJqB7mD1FAajepmrXg8crtSjCctWY1/OjCpSD+uL7nF54uS3HOgP6FUfjEwvbV/tJLySjZgDZ/Uv1PVYQdB04t89/1O/w1cDnyilFU=';
$bot = new BOT_API($channelSecret, $access_token);

if (!empty($bot->isEvents)) {

    $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));
    if ($bot->isSuccess()) {
        echo 'Succeeded!';
        exit();
    }
    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody();
    exit();
}
