<?php
$ACCESS_TOKEN = 'd+AuX4Sgxk9q+Y/Kv9oB8zLBSIqr12UJ7d/Vw9fVA/ACUm3zKzq9vOZ+MX6fYhJx42KE9KJqB7mD1FAajepmrXg8crtSjCctWY1/OjCpSD+YzmBth+pyFLYK6vFOxFkyT2M9s3Ot5AIdjHSOwYQpEgdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น
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
                } else if ($text == 'sticker'){
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [
                            ['type' => 'sticker',
                            'packageId' => '1',
                            'stickerId' => '2584'],
                            ['type' => 'text',
                            'text' => 'test']
                        ]
                    ];
                } else if ($text == 'video'){
                    $data = [
                        'replyToken' => $reply_token,
                    'messages' => [[
                        'type' => 'video',
                        'originalContentUrl' => 'https://www.youtube.com/watch?v=C0DPdy98e4c',
                        'previewImageUrl' => 'https://www.youtube.com/watch?v=C0DPdy98e4c'
                    ]]
                    ];
                } else if ($text == 'audio') {
                    $data = [
                        'replyToken' => $reply_token,
                    'messages' => [[
                        'type' => 'audio',
                        'originalContentUrl' => 'https://example.com/original.m4a',
                        'duration' => 60000
                    ]]
                    ];
                } else if ($text == 'location') {
                    $data = [
                        'replyToken' => $reply_token,
                    'messages' => [[
                        'type' => 'location',
                        'title' => 'My location',
                        'address' => 'ท่าดินแดง',
                        'latitude' => 13.7354462,
                        'longitude' => 100.5034802
                    ]]
                    ];
                } else if ($text == 'image Map'){
                    $data = [
                      'replyToken' => $reply_token,
                    'messages' => [[
                        'type' => 'imagemap',
                        'baseUrl' => 'https://www.picz.in.th/images/2018/07/02/NB8aWb.jpg',
                        'altText' => 'This is an imagemap',
                        'baseSize' => [
                            'width' => 1040,
                            'height' => 693
                        ],
                        'actions' => [
                            [
                                'type' => 'message',
                                'area' => [
                                    'x' => 3,
                                    'y' => 0,
                                    'width' => 517,
                                    'height' => 345
                                ],
                                'text' => 'ยำแซวมอน'
                            ],
                            [
                                'type' => 'message',
                                'area' => [
                                    'x' => 522,
                                    'y' => 1,
                                    'width' => 518,
                                    'height' => 345
                                ],
                                'text' => 'สปาเก็ตตี้ต้มยำกุ้ง'
                            ],
                            [
                                'type' => 'message',
                                'area' => [
                                    'x' => 3,
                                    'y' => 346,
                                    'width' => 516,
                                    'height' => 347
                                ],
                                'text' => 'ต้มยำกุ้ง'
                            ],
                            [
                                'type' => 'message',
                                'area' => [
                                    'x' => 523,
                                    'y' => 346,
                                    'width' => 513,
                                    'height' => 347
                                ],
                                'text' => 'ผัดกระเพรา'
                            ]
                        ]
                    ]]
                    ];
                } else if ($text == 'bubble') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'flex',
                            'altText' => 'This is a Flex message',
                            'contents' => [
                            'type' => 'bubble',
                            'hero' => [
                                'type' => 'image',
                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png',
                                'size' => 'full',
                                'aspectRatio' => '20:13',
                                'aspectMode' => 'cover',
                                'action' => [
                                    'type' => 'uri',
                                    'uri' => 'http://linecorp.com'
                                ]
                            ],
                            'body' => [
                                'type' => 'box',
                                'layout' => 'vertical',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Brown Cafe',
                                        'weight' => 'bold',
                                        'size' => 'xl'
                                    ],
                                    [
                                        'type' => 'box',
                                        'layout' => 'baseline',
                                        'margin' => 'md',
                                        'contents' => [
                                            [
                                            'type' => 'icon',
                                            'size' => 'sm',
                                            'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => '4.0',
                                                'size' => 'sm',
                                                'color' => '#999999',
                                                'margin' => 'md',
                                                'flex' => 0
                                            ]
                                        ]
                                    ],
                                   [
                                       'type' => 'box',
                                       'layout' => 'vertical',
                                       'margin' => 'lg',
                                       'spacing' => 'sm',
                                       'contents' => [
                                           [
                                               'type' => 'box',
                                               'layout' => 'baseline',
                                               'spacing' => 'sm',
                                               'contents' => [
                                                   [
                                                       'type' => 'text',
                                                       'text' => 'Place',
                                                       'color' => '#aaaaaa',
                                                       'size' => 'sm',
                                                       'flex' => 1
                                                   ],
                                                   [
                                                       'type' => 'text',
                                                       'text' => 'Miraina Tower, 4-1-6 Shinjuku, Tokyo',
                                                       'wrap' => true,
                                                       'color' => '#666666',
                                                       'size' => 'sm',
                                                       'flex' => 5
                                                   ]
                                               ]
                                           ],
                                           [
                                               'type' => 'box',
                                               'layout' => 'baseline',
                                               'spacing' => 'sm',
                                               'contents' => [
                                                   [
                                                       'type' => 'text',
                                                       'text' => 'Time',
                                                       'color' => '#aaaaaa',
                                                       'size' => 'sm',
                                                       'flex' => 1
                                                   ],
                                                   [
                                                       'type' => 'text',
                                                       'text' => '10:00 - 23:00',
                                                       'wrap' => true,
                                                       'color' => '#666666',
                                                       'size' => 'sm',
                                                       'flex' => 5
                                                   ]
                                               ]
                                           ]
                                       ]
                                   ]
                                ]

                            ],
                            'footer' => [
                                'type' => 'box',
                                'layout' => 'vertical',
                                'spacing' => 'sm',
                                'contents' => [
                                    [
                                        'type' => 'button',
                                        'style' => 'link',
                                        'height' => 'sm',
                                        'action' => [
                                            'type' => 'uri',
                                            'label' => 'CALL',
                                            'uri' => 'https://linecorp.com'
                                        ]
                                    ],
                                    [
                                        'type' => 'button',
                                        'style' => 'link',
                                        'height' => 'sm',
                                        'action' => [
                                            'type' => 'uri',
                                            'label' => 'WEBSITE',
                                            'uri' => 'https://linecorp.com'
                                        ]
                                    ],
                                    [
                                        'type' => 'spacer',
                                        'size' => 'sm'
                                    ]
                                ],
                                'flex' => 0
                            ]
                        ]
                        ]]
                        ];
                }
            }

        } else if ($event['type'] == 'join') {
            $reply_message = 'สวัสดีครับ! ผมคือผู้ช่วยของเพื่อนสมาชิก ฝากเนื้อฝากตัวด้วยนะครับ ^^ ';
        } else if ($event['type'] == 'leave') {
            $reply_message = 'ขอบคุณที่ให้ผมได้พบกับทุกท่าน ลาก่อนครับ';
        } else {
//            $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
            $reply_message = json_encode($event);
        }

    }
}
//        $reply_message = $request_profile_data
$post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
$send_result = send_reply_message($API_REPLY_URL, $POST_HEADER, $post_body);
echo "Result: " . $send_result . "\r\n";
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