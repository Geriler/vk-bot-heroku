<?php

if (!isset($_REQUEST)) {
    return;
}

$data = json_decode(file_get_contents('php://input'));

switch ($data->type) {
    case 'confirmation':
        return getenv('CONFIRMATION_TOKEN');
    default:
        return '404';
}