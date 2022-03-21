<?php

/** Google URL with which notifications will be pushed */
$url = "https://fcm.googleapis.com/fcm/send";
/**
 * Firebase Console -> Select Projects From Top Naviagation
 *      -> Left Side bar -> Project Overview -> Project Settings
 *      -> General -> Scroll Down and you will be able to see KEYS
 */
//$subscription_key = "key=AAAAjy5s-xY:APA91bE2e7zYmd6ISOr0vum55OB1Xf_dyL62qpQxXj-zakngD35k3NkvurTdj2kaIasZKdTycJyVHzqR7wfU_kbhcUWiGkoC-MYfDxq7BSSUB2nvwFbjBGGlugVxoGrkoABQnnrnkhPp";
$subscription_key = "key=AAAAQYoOAi0:APA91bHxcphlwarR50q7Q0dtD2jAkjFfJEFJpmIL-SbD_K3OgZyUiTKHr_0aQjGlE-Nm7l74GGz6iTpu_8ikd9i7m8eZkxq2n6-gZN1kUA0MInSOtTzvre6vVu4JVzAglq-J1R7zcJBh";

/** We will need to set the following header to make request work */
$request_headers = array(
    "Authorization:" . $subscription_key,
    "Content-Type: application/json"
);

/** Data that will be shown when push notifications get triggered */
$postRequest = [
    "notification" => [
        "title" =>  "Anjay",
        "body" =>  "Anda mendapat 8 tugas baru yang harus diselesaikan",
        "icon" =>  "https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg",
        "click_action" =>  "http://localhost/pismart_web/"
    ],
    /** Customer Token, As of now I got from console. You might need to pull from database */
    //"to" =>  "ee3snfyEZFnSiJTbJSQTkl:APA91bEhq753eM4ZIzC5Zgnmy3UsUQ57LgJ9xgmAEYUgsacn-M_Ul_nlbfZ9SQ10xQ7nD4LC12uNOtcDX5Kz8oaXdk1vm7AfYLfDSy1bfMYxwAwQbVgc7FmYaDsf7yyKH2fjDrkY_fmD"
    "to" => "cHLG8YVkmLCWYohhES0fLO:APA91bFupWOO9F2Do1dAoK8P2L55Kvbyl_Pg_4Nvi6O3leqYyqLP6OTZ6gA87g9kzxSbxCz0Bo-KxgPgazPM4xoKD-Nzw_L1dc7v0FIiymieHSP9kkXfg5I9SlqU119CfcXgrciu-qHa"
];

/** CURL POST code */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postRequest));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);


$season_data = curl_exec($ch);

if (curl_errno($ch)) {
    print "Error: " . curl_error($ch);
    exit();
}
// Show me the result
curl_close($ch);
$json = json_decode($season_data, true);

echo '<pre>';
print_r($json);
