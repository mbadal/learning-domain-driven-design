<?php

$email    = $_POST['email'];
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Supplied email address is not valid';
    exit;
}

$passwordLength = strlen($password);
if (0 === $passwordLength || $passwordLength < 6) {
    echo 'Password should be at least 6 characters long';
    exit;
}

$usersJson  = file_get_contents('users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email);
});

if (sizeof($users) > 1) {
    echo('Fatal error. More than one user with email found in DB');
    exit;
}

if (sizeof($users) === 0) {
    echo('Invalid user');
    exit;
}

$user = $users[0];
if (!password_verify($password, $user['password'])) {
    echo('Invalid Password');
    exit;
}

echo 'Login successful';
exit;


