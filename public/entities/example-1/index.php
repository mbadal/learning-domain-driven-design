<?php declare(strict_types=1);

use LearningDdd\Repository\UserRepository;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PlainTextPassword;
use LearningDdd\ValueObject\PasswordHash;
use LearningDdd\ValueObject\UserId;

require '../../../vendor/autoload.php';

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
echo "User ID: [{$user1['id']}], email: [{$user1['email']}]\n";

//-------------------------------------------------------------------------
//@todo implement changing of user password
$user = $repository->findUserByEmail(
    EmailAddress::createFromString('test1@profesia.sk')
);

$password = PasswordHash::createFromString($user['password']);
if (!$password->verify(PlainTextPassword::createFromString('test1'))) {
    echo 'Authentication failed';
    exit;
}

$user['password'] = PlainTextPassword::createFromString('changed-password')->hash();
$id               = UserId::createFromInt((int)$user['id']);
$repository->updateUser($id, $user);
echo "Updated user with ID: [{$id}]", "\n";

