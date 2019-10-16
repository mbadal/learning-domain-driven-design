<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

use InvalidArgumentException;

class PlainTextPassword extends AbstractPassword
{
    public static function createFromString(string $value): PlainTextPassword
    {
        if (strlen($value) < 4) {
            throw new InvalidArgumentException("Argument: [{$value}] has to be at least 4 characters long");
        }

        return new self($value);
    }

    public function hash(): PasswordHash
    {
        return PasswordHash::createFromString(
            password_hash($this->getValue(), PASSWORD_DEFAULT)
        );
    }

    public function isEqualToString($plainTextPassword): bool
    {
        return ($this->getValue() === $plainTextPassword->getValue());
    }
}
