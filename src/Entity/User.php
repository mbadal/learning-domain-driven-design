<?php declare(strict_types=1);

namespace LearningDdd\Entity;

use LearningDdd\ValueObject\EmailAddress;
use LearningDdd\ValueObject\PasswordHash;
use LearningDdd\ValueObject\UserId;

class User
{
    /** @var UserId */
    private $id;

    /** @var EmailAddress */
    private $email;

    /** @var PasswordHash */
    private $password;

    public function __construct(UserId $id, EmailAddress $email, PasswordHash $password)
    {
        $this->id       = $id;
        $this->email    = $email;
        $this->password = $password;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getPassword(): PasswordHash
    {
        return $this->password;
    }

    public function setEmail(EmailAddress $email): void
    {
        $this->email = $email;
    }

    public function setPassword(PasswordHash $password): void
    {
        $this->password = $password;
    }
}
