<?php

$email          = $_POST['email'];
$password       = $_POST['password'];
$passwordRepeat = $_POST['passwordRepeat'];

if ($password !== $passwordRepeat) {
    echo 'Password do not match';
    exit;
}

$usersJson  = file_get_contents('users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email);
});

if (!empty($users)) {
    echo 'User with email already exists';
    exit;
}
