<?php

$email    = $_POST['email'];
$password = $_POST['password'];

$usersJson  = file_get_contents('users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email);
});

if (sizeof($users) !== 1) {
    echo 'Redirect to Login';
    exit;
}

$user = $users[0];
if (!password_verify($password, $user['password'])) {
    echo 'Invalid Password';
    exit;
}

echo 'Login successful';
exit;


