<?php

if (!isset($_REQUEST)) {
    return;
}

$data = json_decode(file_get_contents('php://input'));

switch ($data->type) {
    case 'confirmation':
        echo getenv('CONFIRMATION_TOKEN');
        break;
}