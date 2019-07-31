<?php

if (!isset($_REQUEST)) {
    return;
}

$data = json_decode(file_get_contents('php://input'));

require_once 'vk_api.php';

switch ($data->type) {
    case 'confirmation':
        echo getenv('CONFIRMATION_TOKEN');
        break;
    case 'wall_post_new':
        $post_id = $data->object->id;
        $owner_id = $data->object->owner_id;
        $attachment = "wall{$owner_id}_{$post_id}";
        $message = 'В группе появился новый пост! Посмотри, лайкни, прокоментируй! Можешь рассказать друзьям!';
        sendMessage($message, $attachment, getenv('PEER_ID'));
        echo 'ok';
        break;
}
