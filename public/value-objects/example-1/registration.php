<?php

use LearningDdd\Example1\ValueObject\EmailAddress;
use LearningDdd\Example1\ValueObject\PlainTextPassword;

require_once __DIR__ . '/../../../vendor/autoload.php';

$email          = EmailAddress::createFromString($_POST['email']);
$password       = PlainTextPassword::createFromString($_POST['password']);
$passwordRepeat = $_POST['passwordRepeat'];

if ($password !== $passwordRepeat) {
    echo 'Passwords do not match';
    exit;
}

$usersJson  = file_get_contents('users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($email->isEqualToString($item['email']));
});

if (!empty($users)) {
    echo 'User with email already exists';
    exit;
}

$usersArray[] = [
    'id'    => sizeof($usersArray),
    'email' => (string)$email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
file_put_contents('users.json', json_encode($usersArray));
echo 'Successfully registered';
exit;
