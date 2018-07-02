<?php
$ACCESS_TOKEN = 'RIo/GGcvYBSob4wVvq0qHGtCClkWJOhZMnoi7eaXrQ8ZqwfkZADtYibrhwiyA9zO42KE9KJqB7mD1FAajepmrXg8crtSjCctWY1/OjCpSD8mO6DosCZLOPvs1OxKB/gTP4EjUkCYMxxCQTTOr3r8swdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
// API URL for reply message to user.
$API_REPLY_URL = 'https://api.line.me/v2/bot/message/reply';
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
if (sizeof($request_array['events']) > 0) {
    foreach ($request_array['events'] as $event) {
        // API URL for get user profile.
        $API_PROFILE_URL = 'https://api.line.me/v2/bot/profile/' . $event['source']['userId'];
        // Get user profile data from LINE.
        $request_profile_data = request_profile($API_PROFILE_URL, $POST_HEADER);
        // Reply message conditions
        $reply_message = '';
        $reply_token = $event['replyToken'];
        if ($event['type'] == 'message') {
            if ($event['message']['type'] == 'text') {
                $text = $event['message']['text'];
//                $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้ว';
                if ($text == 'รถมีทั้งหมดกี่รุ่น') {
                    $reply_message = 'คุณต้องการถามถึงรถรุ่น Yaris หรือ Yaris ATIV?';
                } else if ($text == 'Yaris') {
                    $reply_message = 'มีทั้งหมด 4 รุ่น ดังนี้ 1';
                } else if ($text == 'Yaris ATIV') {
                    $reply_message = 'มีทั้งหมด 5 รุ่น ดังนี้ xxxxxx';
                } else if($text == 'image'){
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'image',
                            'originalContentUrl' => 'https://simg.kapook.com/o/photow/924/kapook_world-921102.jpg',
                            'previewImageUrl' => 'https://simg.kapook.com/o/photow/924/kapook_world-921102.jpg',
                            'animated' => false
                        ]]
                    ];
                }
                $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                $send_result = send_reply_message($API_REPLY_URL, $POST_HEADER, $post_body);
                echo "Result: " . $send_result . "\r\n";
            }

        } else if ($event['type'] == 'join') {
            $reply_message = 'สวัสดีครับ! ผมคือผู้ช่วยของเพื่อนสมาชิก ฝากเนื้อฝากตัวด้วยนะครับ ^^ ';
        } else if ($event['type'] == 'leave') {
            $reply_message = 'ขอบคุณที่ให้ผมได้พบกับทุกท่าน ลาก่อนครับ';
        } else {
//            $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
            $reply_message = json_encode($event);
        }
//        $reply_message = $request_profile_data;
        if (strlen($reply_message) > 0) {
            //$reply_message = iconv("tis-620","utf-8",$reply_message);
            $data = [
                'replyToken' => $reply_token,
                // Text
                'messages' => [['type' => 'text', 'text' => $reply_message]]
                // Multi-Text
//                'messages' => [
//                    ['type' => 'text', 'text' => $reply_message],
//                    ['type' => 'text', 'text' => 'ทดสอบ'],
//                ],
                // Image
//                'messages' => [[
//                    'type' => 'image',
//                    'originalContentUrl' => 'https://i2.wp.com/beebom.com/wp-content/uploads/2016/01/Reverse-Image-Search-Engines-Apps-And-Its-Uses-2016.jpg?resize=640%2C426',
//                    'previewImageUrl' => 'https://i2.wp.com/beebom.com/wp-content/uploads/2016/01/Reverse-Image-Search-Engines-Apps-And-Its-Uses-2016.jpg?resize=640%2C426',
//                    'animated' => false]]
//                 Sticker
//                'messages' => [[
//                    'type' => 'sticker',
//                    'packageId' => '4',
//                    'stickerId' => '623']]
//                 Location
//                'messages' => [[
//                    'type' => 'location',
//                    'title' => 'ศูนย์บริการโตโยต้าบัสส์',
//                    'address' => '69/40 ถนนบางยี่ขัน แขวง/เขตบางกอกใหญ่ กรุงเทพ',
//                    'latitude' => '13.840058',
//                    'longitude' => '100.580857',
//                ]]
                // Template
//                'messages' =>
//                    [[
//                        'type' => 'template',
//                        'altText' => 'this is a buttons template',
//                        'template' =>
//                            [
//                                'type' => 'buttons',
//                                'actions' =>
//                                    [
//                                        [
//                                            'type' => 'message',
//                                            'label' => 'Action 1',
//                                            'text' => 'Action 1',
//                                        ],
//                                        [
//                                            'type' => 'message',
//                                            'label' => 'Action 2',
//                                            'text' => 'Action 2',
//                                        ],
//                                    ],
//                                'thumbnailImageUrl' => 'https://i2.wp.com/beebom.com/wp-content/uploads/2016/01/Reverse-Image-Search-Engines-Apps-And-Its-Uses-2016.jpg?resize=640%2C426',
//                                'title' => 'คุณรู้สึกอย่างไรกับคลับเรา',
//                                'text' => 'ตอบแบบสอบถามเพื่อการพัฒนาที่ดียิ่งขึ้น',
//                            ]
//                    ]]
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_REPLY_URL, $POST_HEADER, $post_body);
            echo "Result: " . $send_result . "\r\n";
        }
    }
}
echo "OK";
function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function request_profile($url, $post_header)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>