<?php

function sendMessage($message, $attachment, $peer_id) {
    $params = http_build_query([
        'message' => $message,
        'attachment' => $attachment,
        'peer_id' => $peer_id,
        'access_token' => getenv('ACCESS_TOKEN'),
        'v' => getenv('VK_API_VERSION')
    ]);
    return file_get_contents(getenv('VK_API_METHOD') . 'messages.send?' . $params);
}
