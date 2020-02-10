<?php declare(strict_types=1);

namespace LearningDdd\Repository\Domain;

use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\UserId;

class UserRepository
{
    private $filePath = '../../../users.json';

    public function insertUser(array $userData): UserId
    {
        $allUsers                        = $this->getAllUsers();
        $foundUser                       = $this->findUserByEmail($userData['email']);
        $userId                          = $foundUser === null ? UserId::createFromInt(count($allUsers) + 1): UserId::createFromInt((int)$foundUser['id']);
        $allUsers[$userId->__toString()] = [
            'id'       => $userId->__toString(),
            'email'    => $userData['email']->__toString(),
            'password' => $userData['password']->__toString(),
        ];

        $this->writeFileContents($allUsers);

        return $userId;
    }

    public function findUser(UserId $userId): ?array
    {
        $allUsers = $this->getAllUsers();

        return $allUsers[$userId->__toString()] ?? null;
    }

    public function findUserByEmail(EmailAddress $email): ?array
    {
        $filteredUser = array_filter($this->getAllUsers(), function ($item) use ($email) {
            return ($email->isEqualToString($item['email']));
        });

        if (empty($filteredUser)) {
            return null;
        }

        return current($filteredUser);
    }

    public function updateUser(UserId $id, array $userData)
    {
        $allUsers                    = $this->getAllUsers();
        $allUsers[$id->__toString()] = $userData;

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
