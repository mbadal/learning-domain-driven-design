<?php declare(strict_types=1);

use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PlainTextPassword;

require '../../../vendor/autoload.php';

try {
    $email = EmailAddress::createFromString($_POST['email']);
} catch (InvalidArgumentException $e) {
    echo "String: [{$email}] is not a valid email address";
    exit;
}

try {
    $password       = PlainTextPassword::createFromString($_POST['password']);
    $passwordRepeat = PlainTextPassword::createFromString($_POST['passwordRepeat']);
} catch (InvalidArgumentException $e) {
    echo 'Password should be at least 4 characters long';
    exit;
}

if (!$password->isEqual($passwordRepeat)) {
    echo 'Passwords do not match';
    exit;
}

$usersJson  = file_get_contents('../../../users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email->toString());
});

if (!empty($users)) {
    echo 'User with email already exists';
    exit;
}

$usersArray[] = [
    'id'       => count($usersArray) + 1,
    'email'    => $email->toString(),
    'password' => $password->hash()->toString()
];
file_put_contents('../../../users.json', json_encode($usersArray));
echo "User with email: [{$email}] was registered successfully";