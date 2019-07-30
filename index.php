<?php

$type = $_POST['type'];

switch ($type) {
    case 'confirmation':
        return getenv('CONFIRMATION_TOKEN');
    default:
        return '404';
}