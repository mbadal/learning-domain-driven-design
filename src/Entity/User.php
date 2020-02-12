<?php declare(strict_types=1);

namespace LearningDdd\Entity;

use LearningDdd\Repository\UserRepository;
use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PasswordHash;
use LearningDdd\ValueObject\PlainTextPassword;
use LearningDdd\ValueObject\UserId;

class User
{
    /** @var UserId */
    private $id;

    /** @var EmailAddress */
    private $email;

    /** @var PasswordHash */
    private $password;

    private function __construct(UserId $id, EmailAddress $email, PasswordHash $password)
    {
        $this->id       = $id;
        $this->email    = $email;
        $this->password = $password;
    }

    public static function registerUser(EmailAddress $email, PasswordHash $password, UserRepository $repository): User
    {
        $userId = $repository->insertUser($email, $password);

        return new self($userId, $email, $password);
    }

    public static function loadUser(UserId $userId, $email, PasswordHash $password): User
    {
        return new self($userId, $email, $password);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function changePassword(PasswordHash $password, UserRepository $repository): User
    {
        $this->password = $password;
        $repository->updateUserPassword($this->id, $this->password);

        return $this;
    }

    public function verify(PlainTextPassword $plainTextPassword): bool
    {
        return ($this->password->verify($plainTextPassword));
    }

    public function printUserData(): array
    {
        return [
            'id'       => (string)$this->id,
            'email'    => (string)$this->email,
            'password' => (string)$this->password,
        ];
    }
}
