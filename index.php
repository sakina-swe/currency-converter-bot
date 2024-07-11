<?php

require 'calculations.php';
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$token = "7036846020:AAEa9XpQbFKrvn4IfnlReayCgZeVv2MyiWQ";
$tgApi = "https://api.telegram.org/bot$token/";

$client = new Client(['base_uri' => $tgApi]);

$ccy = new Client(['base_uri' => "https://cbu.uz/uz/arkhiv-kursov-valyut/json/"]);

$update = json_decode(file_get_contents('php://input'));
echo "localhost";
if (isset($update) && isset($update->message)) {
    $message = $update->message;
    $chat_id = $message->chat->id;
    $type = $message->chat->type;
    $miid = $message->message_id;
    $name = $message->from->first_name;
    $user = $message->from->username;
    $fromid = $message->from->id;
    $text = $message->text;
    $title = $message->chat->title;
    $chatuser = $message->chat->username;
    $chatuser = $chatuser ? $chatuser : "Shaxsiy Guruh!";
    $caption = $message->caption;
    $entities = $message->entities;
    $entities = $entities[0];
    $left_chat_member = $message->left_chat_member;
    $new_chat_member = $message->new_chat_member;
    $photo = $message->photo;
    $video = $message->video;
    $audio = $message->audio;
    $voice = $message->voice;
    $reply = $message->reply_markup;
    $fchat_id = $message->forward_from_chat->id;
    $fid = $message->forward_from_message_id;

    $currency = new Calculations();
    if (!empty($text)) {
        $client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chat_id,
                'text' => $currency->exchange($text),
            ]
        ]);
    } else {
        error_log("The string is empty.");
    }
} else {
    error_log("There is no update or message.");
}
