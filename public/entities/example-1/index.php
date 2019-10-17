<?php declare(strict_types=1);

use LearningDdd\Repository\UserRepository;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PlainTextPassword;
use LearningDdd\Entity\User;

require '../../../vendor/autoload.php';

$repository = new UserRepository();

$user1 = User::registerUser(
    EmailAddress::createFromString('test1@profesia.sk'),
    (PlainTextPassword::createFromString('test1'))->hash(),
    $repository
);

$user2 = User::registerUser(
    EmailAddress::createFromString('test2@profesia.sk'),
    (PlainTextPassword::createFromString('test2'))->hash(),
    $repository
);

$user3 = User::registerUser(
    EmailAddress::createFromString('test3@profesia.sk'),
    (PlainTextPassword::createFromString('test3'))->hash(),
    $repository
);


$user1 = $repository->findUser($user1->getId());
$userData = $user1->printUserData();
echo "User ID: [{$userData['id']}], email: [{$userData['email']}]\n";

//-------------------------------------------------------------------------
//@todo implement changing of user password
$user = $repository->findUserByEmail(
    EmailAddress::createFromString('test1@profesia.sk')
);

if (!$user->verify(PlainTextPassword::createFromString('test1'))) {
    echo 'Authentication failed';
    exit;
}

$user->changePassword(PlainTextPassword::createFromString('changed-password')->hash(), $repository);
echo "Updated user with ID: [{$user->getId()}]", "\n";

