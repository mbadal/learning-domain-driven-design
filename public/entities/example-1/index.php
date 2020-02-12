<?php declare(strict_types=1);

use LearningDdd\Repository\UserRepository;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PlainTextPassword;
use LearningDdd\ValueObject\PasswordHash;
use LearningDdd\ValueObject\UserId;

require __DIR__ . '/../../../vendor/autoload.php';

$repository = new UserRepository();

$userId1 = $repository->insertUser([
    'email'    => EmailAddress::createFromString('test1@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test1'))->hash(),
]);

$userId2 = $repository->insertUser([
    'email'    => EmailAddress::createFromString('test2@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test2'))->hash(),
]);

$userId3 = $repository->insertUser([
    'email'    => EmailAddress::createFromString('test3@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test3'))->hash(),
]);


$user1 = $repository->findUser($userId1);
echo "User ID: [{$user1->getId()}], email: [{$user1->getEmail()}]\n";

//-------------------------------------------------------------------------
//@todo implement changing of user password
$user = $repository->findUserByEmail(
    EmailAddress::createFromString('test1@profesia.sk')
);

if (!$user->getPassword()->verify(PlainTextPassword::createFromString('test1'))) {
    echo 'Authentication failed 1';
    exit;
}

$user->setPassword(PlainTextPassword::createFromString('changed-password')->hash());
$repository->updateUser($user->getId(), $user);
echo "Updated user with ID: [{$user->getId()}]", "\n";

if (!$user->getPassword()->verify(PlainTextPassword::createFromString('changed-password'))) {
    echo 'Authentication failed 2';
    exit;
}

echo 'Auth 2 OK', "\n";

