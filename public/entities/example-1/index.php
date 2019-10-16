<?php declare(strict_types=1);

use LearningDdd\Repository\UserRepository;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PlainTextPassword;

require '../../../vendor/autoload.php';

$repository = new UserRepository();

$userId1 = $repository->registerUser([
    'email'    => EmailAddress::createFromString('test1@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test1'))->hash()
]);

$userId2 = $repository->registerUser([
    'email'    => EmailAddress::createFromString('test2@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test2'))->hash()
]);

$userId3 = $repository->registerUser([
    'email'    => EmailAddress::createFromString('test3@profesia.sk'),
    'password' => (PlainTextPassword::createFromString('test3'))->hash()
]);


$user1 = $repository->findUser($userId1);
