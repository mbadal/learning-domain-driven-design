<?php declare(strict_types=1);

namespace LearningDdd\Repository;

use LearningDdd\Entity\User;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PasswordHash;
use LearningDdd\ValueObject\UserId;

class UserRepository
{
    private $filePath = '../../../users.json';

    public function insertUser(EmailAddress $emailAddress, PasswordHash $password): UserId
    {
        $allUsers                        = $this->getAllUsers();
        $foundUser                       = $this->findUserByEmail($emailAddress);
        $userId                          = $foundUser === null ? UserId::createFromInt(count($allUsers) + 1) : $foundUser->getId();
        $allUsers[$userId->__toString()] = [
            'id'       => $userId->__toString(),
            'email'    => $emailAddress->__toString(),
            'password' => $password->__toString(),
        ];

        $this->writeFileContents($allUsers);

        return $userId;
    }

    public function findUser(UserId $userId): ?User
    {
        $allUsers = $this->getAllUsers();
        if (!isset($allUsers[$userId->__toString()])) {
            return null;
        }

        $userData = $allUsers[$userId->__toString()];

        return User::loadUser(
            UserId::createFromInt((int)$userData['id']),
            EmailAddress::createFromString($userData['email']),
            PasswordHash::createFromString($userData['password'])
        );
    }

    public function findUserByEmail(EmailAddress $email): ?User
    {
        $filteredUser = array_filter($this->getAllUsers(), function ($item) use ($email) {
            return ($email->isEqualToString($item['email']));
        });

        if (empty($filteredUser)) {
            return null;
        }

        $userData = current($filteredUser);

        return User::loadUser(
            UserId::createFromInt((int)$userData['id']),
            EmailAddress::createFromString($userData['email']),
            PasswordHash::createFromString($userData['password'])
        );
    }

    public function updateUser(UserId $id, User $user)
    {
        $allUsers                    = $this->getAllUsers();
        $allUsers[$id->__toString()] = $user->printUserData();

        $this->writeFileContents($allUsers);
    }

    public function listAllUsers(): array
    {
        return $this->getAllUsers();
    }

    private function getAllUsers(): array
    {
        return json_decode(
            file_get_contents($this->filePath),
            true
        );
    }

    private function writeFileContents(array $users)
    {
        file_put_contents(
            $this->filePath,
            json_encode($users)
        );
    }
}
