<?php

use LearningDdd\Example1\ValueObject\EmailAddress;
use LearningDdd\Example1\ValueObject\PasswordHash;
use LearningDdd\Example1\ValueObject\PlainTextPassword;

require_once __DIR__ . '/../../../vendor/autoload.php';

$email    = EmailAddress::createFromString($_POST['email']);
$password = PlainTextPassword::createFromString($_POST['password']);

$usersJson  = file_get_contents('users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($email->isEqualToString($item['email']));
});

if (sizeof($users) > 1) {
    echo('Fatal error. More than one user with email found in DB');
    exit;
}

if (sizeof($users) === 0) {
    echo('Invalid user');
    exit;
}

$user         = current($users);
$passwordHash = PasswordHash::createFromHashedString($user['password']);
if (!$passwordHash->verify($password)) {
    echo('Invalid Password');
    exit;
}

echo 'Login successful';
exit;


