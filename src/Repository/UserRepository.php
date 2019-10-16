<?php declare(strict_types=1);

namespace LearningDdd\Repository;

use LearningDdd\ValueObject\UserId;

class UserRepository
{
    private $filePath = '../../../users.json';

    public function registerUser(array $userData): UserId
    {
        $allUsers                        = $this->getAllUsers();
        $userId                          = UserId::createFromInt(count($allUsers) + 1);
        $allUsers[$userId->__toString()] = [
            'id'       => $userId->__toString(),
            'email'    => $userData['email']->__toString(),
            'password' => $userData['password']->__toString()
        ];

        $this->writeFileContents($allUsers);

        return $userId;
    }

    public function findUser(UserId $userId): ?array
    {
        $allUsers = $this->getAllUsers();

        return $allUsers[$userId->__toString()] ?? null;
    }

    public function updateUser(UserId $id, array $userData)
    {
        $allUsers = $this->getAllUsers();
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