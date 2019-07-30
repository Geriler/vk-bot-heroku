<?php

$type = json_decode($_POST);

switch ($type->type) {
    case 'confirmation':
        return getenv('CONFIRMATION_TOKEN');
    default:
        return '404';
}