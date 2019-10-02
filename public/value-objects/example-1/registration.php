<?php declare(strict_types=1);

require '../../../vendor/autoload.php';

$email          = $_POST['email'];
$password       = $_POST['password'];
$passwordRepeat = $_POST['passwordRepeat'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "String: [{$email}] is not a valid email address";
    exit;
}

if ($password !== $passwordRepeat) {
    echo 'Password do not match';
    exit;
}

if (strlen($password) < 4) {
    echo 'Password should be at least 4 characters long';
    exit;
}

$usersJson  = file_get_contents('../../../users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email);
});

if (!empty($users)) {
    echo 'User with email already exists';
    exit;
}

$usersArray[] = [
    'id'       => count($usersArray) + 1,
    'email'    => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
file_put_contents('../../../users.json', json_encode($usersArray));
echo "User with email: [{$email}] was registered successfully";