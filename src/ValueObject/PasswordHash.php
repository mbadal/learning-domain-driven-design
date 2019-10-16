<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

use InvalidArgumentException;
use ReflectionClass;

class PasswordHash extends AbstractPassword
{
    public static function createFromString(string $value): PasswordHash
    {
        if (strpos($value, '$2y$') !== 0) {
            throw new InvalidArgumentException("Argument: [{$value}] is not a valid password hash");
        }

        return new self($value);
    }

    public function verify(PlainTextPassword $plainTextPassword): bool
    {
        return (password_verify($plainTextPassword->getValue(), $this->getValue()));
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return $this->getValue();
    }
}