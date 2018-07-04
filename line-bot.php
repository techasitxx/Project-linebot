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
//                if ($text == 'รถมีทั้งหมดกี่รุ่น') {
//                    $reply_message = 'คุณต้องการถามถึงรถรุ่น Yaris หรือ Yaris ATIV?';
//                } else if ($text == 'Yaris') {
//                    $reply_message = 'มีทั้งหมด 4 รุ่น ดังนี้ 1';
//                } else if ($text == 'Yaris ATIV') {
//                    $reply_message = 'มีทั้งหมด 5 รุ่น ดังนี้ xxxxxx';
//                }
                if ($text == 'สวัสดี'){
                    $reply_message [0] ['type'] = 'text';
                    $reply_message [0]['text'] = "สวัสดีจ้าาา";
                    $reply_message [1]['type'] = "sticker";
                    $reply_message [1]['packageId'] = "2";
                    $reply_message [1]['stickerId'] = "34";
                }
                else if ($text == 'image') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'image',
                            'originalContentUrl' => 'https://simg.kapook.com/o/photow/924/kapook_world-921102.jpg',
                            'previewImageUrl' => 'https://simg.kapook.com/o/photow/924/kapook_world-921102.jpg',
                            'animated' => false
                        ]]
                    ];
                } else if ($text == 'sticker') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'sticker',
                            'packageId' => '1',
                            'stickerId' => '2584'
                        ]]
                    ];
                } else if ($text == 'video') {
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
                } else if ($text == 'image Map') {
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
                } else if ($text == 'บวกเท่าไหร่ดี') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'template',
                            'altText' => 'this is a buttons template',
                            'template' => [
                                'type' => 'buttons',
                                'actions' => [
                                    [
                                        'type' => 'message',
                                        'label' => '+1',
                                        'text' => '+1'
                                    ],
                                    [
                                        'type' => 'message',
                                        'label' => '+2',
                                        'text' => '+2'
                                    ]
                                ],
                                'title' => '+ เท่าไหร่',
                                'text' => '+ เท่าไหร่ดี ?'
                            ]
                        ]]
                    ];
                } else if ($text == 'สายเขียว') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'template',
                            'altText' => 'this is a buttons template',
                            'template' => [
                                'type' => 'buttons',
                                'actions' => [
                                    [
                                        'type' => 'message',
                                        'label' => '+1',
                                        'text' => '+1'
                                    ],
                                    [
                                        'type' => 'message',
                                        'label' => '+2',
                                        'text' => '+2'
                                    ]
                                ],
                                'thumbnailImageUrl' => 'https://i.ebayimg.com/images/g/eqoAAOSwOu5Zmpq2/s-l300.jpg',
                                'title' => '+ เท่าไหร่',
                                'text' => '+ เท่าไหร่ดี ?'
                            ]
                        ]]
                    ];
                } else if ($text == 'เยอะ') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'template',
                            'altText' => 'this is a carousel template',
                            'template' => [
                                'type' => 'carousel',
                                'actions' => [],
                                'columns' => [
                                    [
                                        'thumbnailImageUrl' => 'https://vignette.wikia.nocookie.net/tedmovie/images/5/56/Tedisreal.png/revision/latest?cb=20120712192108',
                                        'title' => 'Title',
                                        'text' => 'Text',
                                        'actions' => [
                                            [
                                                'type' => 'message',
                                                'label' => 'Action 1',
                                                'text' => 'Action 1'
                                            ],
                                            [
                                                'type' => 'message',
                                                'label' => 'Action 2',
                                                'text' => 'Action 2'
                                            ]
                                        ]
                                    ],
                                    [
                                        'thumbnailImageUrl' => 'https://www.brandchannel.com/wp-content/uploads/2012/12/ted_movie_grocery_store.jpg',
                                        'title' => 'Title',
                                        'text' => 'Text',
                                        'actions' => [
                                            [
                                                'type' => 'message',
                                                'label' => 'Action 1',
                                                'text' => 'Action 1'
                                            ],
                                            [
                                                'type' => 'message',
                                                'label' => 'Action 2',
                                                'text' => 'Action 2'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]]
                    ];
                } else if ($text == 'รถมีกี่รุ่น') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'template',
                            'altText' => 'this is a confirm template',
                            'template' => [
                                'type' => 'confirm',
                                'actions' => [
                                    [
                                        'type' => 'message',
                                        'label' => 'Yaris',
                                        'text' => 'Yaris'
                                    ],
                                    [
                                        'type' => 'message',
                                        'label' => 'Yaris ATIV+',
                                        'text' => 'Yaris ATIV+'
                                    ]
                                ],
                                'text' => 'Continue?'
                            ]
                        ]]
                    ];
                } else if ($text == 'อิอินะ') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'bubble',
                            'styles' => [
                                'header' => [
                                    'backgroundColor' => '#ffaaaa',
                                ],
                                'body' => [
                                    'backgroundColor' => '#aaffaa',
                                    'separator' => true,
                                    'separatorColor' => '#efefef'
                                ],
                                'footer' => [
                                    'backgroundColor' => '#aaaaff'
                                ]
                            ],
                            'header' => [],
                            'hero' => [],
                            'body' => [],
                            'footer' => []
                        ]]
                    ];
                } else if ($text == 'ใช่นะ') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'bubble',
                            'body' => [
                                'type' => 'box',
                                'layout' => 'vertical',
                                'spacing' => 'md',
                                'contents' => [
                                    [
                                        'type' => 'button',
                                        'style' => 'primary',
                                        'action' => [
                                            'type' => 'uri',
                                            'label' => 'Primary style button',
                                            'uri' => 'https://developers.line.me'
                                        ]
                                    ],
                                    [
                                        'type' => 'button',
                                        'style' => 'secondary',
                                        'action' => [
                                            'type' => 'uri',
                                            'label' => 'Secondary style button',
                                            'uri' => 'https://developers.line.me'
                                        ]
                                    ],
                                    [
                                        'type' => 'button',
                                        'style' => 'link',
                                        'action' => [
                                            'type' => 'uri',
                                            'label' => 'Link style button',
                                            'uri' => 'https://developers.line.me'
                                        ]
                                    ]
                                ]
                            ]
                        ]]
                    ];
                } else if ($text == 'กุเอง') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            'type' => 'bubble',
                            'hero' => [
                                'type' => 'image',
                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png',
                                'size' => 'full',
                                'aspectRatio' => '20:13',
                                'aspectMode' => 'cover',
                                'action' => [
                                    'type' => 'uri',
                                    'uri' => 'http://linecorp.com/'
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
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png'
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png'
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png'
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png'
                                            ],
                                            [
                                                'type' => 'icon',
                                                'size' => 'sm',
                                                'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gray_star_28.png'
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
                        ]]
                    ];
                } else if ($text == 'Yaris ATIV+') {
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[
                            "type" => "template",
                            "altText" => "รายการรถยน์รุ่น Yaris ATIV",
                            "template" =>
                                [
                                    "type" => "carousel",
                                    "actions" => [],
                                    "columns" =>
                                        [
                                            [
                                                "thumbnailImageUrl" => "https://www.toyota.co.th/media/files_usage/product/large/7aee2366ff550c5eada98722c8d3e65027644abbad370cec4f54ea63b805c1f8.png",
                                                "title" => "รุ่น 1.2 S CVT",
                                                "text" => "ราคา 635,000 บาท",
                                                "actions" => [
                                                    [
                                                        "type" => "message",
                                                        "label" => "รายละเอียด",
                                                        "text" => "รายละเอียด ATIV 1.2 S CVT"
                                                    ]
                                                ]
                                            ],
                                            [
                                                "thumbnailImageUrl" => "https://www.toyota.co.th/media/files_usage/product/large/34abf17927ce881b4c5a79a9bcff5d0bbf648345312c21bf0378bc5fcd2d0b63.png",
                                                "title" => "รุ่น 1.2 G CVT",
                                                "text" => "ราคา 609,000 บาท",
                                                "actions" => [
                                                    [
                                                        "type" => "message",
                                                        "label" => "รายละเอียด",
                                                        "text" => "รายละเอียด ATIV 1.2 G CVT"
                                                    ]
                                                ]
                                            ],
                                            [
                                                "thumbnailImageUrl" => "https://www.toyota.co.th/media/files_usage/product/large/9bbb65df329426be113b590c4a06c0df4adb8af43f4dd6d5a7fe87dd76bbb839.png",
                                                "title" => "รุ่น 1.2 E CVT",
                                                "text" => "ราคา 559,000 บาท",
                                                "actions" => [
                                                    [
                                                        "type" => "message",
                                                        "label" => "รายละเอียด",
                                                        "text" => "รายละเอียด ATIV 1.2 E CVT"
                                                    ]
                                                ]
                                            ],
                                            [
                                                "thumbnailImageUrl" => "https://www.toyota.co.th/media/files_usage/product/large/cac95fd8be30c963ae0f113265fd5d36f09c74ef9d9029481c8951724c7a2502.png",
                                                "title" => "รุ่น 1.2 J CVT",
                                                "text" => "ราคา 529,000 บาท",
                                                "actions" => [
                                                    [
                                                        "type" => "message",
                                                        "label" => "รายละเอียด",
                                                        "text" => "รายละเอียด ATIV 1.2 J CVT"
                                                    ]
                                                ]
                                            ],
                                            [
                                                "thumbnailImageUrl" => "https://www.toyota.co.th/media/files_usage/product/large/46f12669788d6f5cd804bde6aba0833608f91bfb1d8b2443275d94962d1d309a.png",
                                                "title" => "รุ่น 1.2 J Eco CVT",
                                                "text" => "ราคา 479,000 บาท",
                                                "actions" => [
                                                    [
                                                        "type" => "message",
                                                        "label" => "รายละเอียด",
                                                        "text" => "รายละเอียด ATIV 1.2 J Eco CVT"
                                                    ]
                                                ]
                                            ]
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