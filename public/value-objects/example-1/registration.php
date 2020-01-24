<?php

$email          = $_POST['email'];
$password       = $_POST['password'];
$passwordRepeat = $_POST['passwordRepeat'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Supplied email address is not valid';
    exit;
}

$passwordLength = strlen($password);
if (0 === $passwordLength || $passwordLength < 6) {
    echo 'Password should be at least 6 characters long';
    exit;
}

if ($password !== $passwordRepeat) {
    echo 'Passwords do not match';
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

$usersArray[] = [
    'id'    => sizeof($usersArray),
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
echo 'Successfully registered';
exit;
