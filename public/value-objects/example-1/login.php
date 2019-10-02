<?php declare(strict_types=1);

use LearningDdd\ValueObject\Example1\ValueObject\EmailAddress;
use LearningDdd\ValueObject\Example1\ValueObject\PasswordHash;
use LearningDdd\ValueObject\Example1\ValueObject\PlainTextPassword;

require '../../../vendor/autoload.php';


try {
    $email = EmailAddress::createFromString($_POST['email']);
} catch (InvalidArgumentException $e) {
    echo "String: [{$email}] is not a valid email address";
    exit;
}
try {
    $password = PlainTextPassword::createFromString($_POST['password']);
} catch (InvalidArgumentException $e) {
    echo 'Password should be at least 4 characters long';
    exit;
}

$usersJson  = file_get_contents('../../../users.json');
$usersArray = json_decode($usersJson, true);

$users = array_filter($usersArray, function ($item) use ($email) {
    return ($item['email'] === $email->toString());
});

if (sizeof($users) > 1) {
    echo 'Redirect to Login. Multiple users with email found.';
    exit;
}

if (sizeof($users) === 0) {
    echo "User with email: [{$email}] is not registered";
    exit;
}

$user         = current($users);
$passwordHash = PasswordHash::createFromString($user['password']);
if (!$passwordHash->verify($password)) {
    echo 'Invalid Password';
    exit;
}

echo 'Login successful';
exit;


