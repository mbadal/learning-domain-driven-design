<?php declare(strict_types=1);

namespace LearningDdd\Example1\ValueObject;

use InvalidArgumentException;

class PasswordHash extends PasswordAbstract
{
    public static function createFromHashedString(string $value): PasswordHash
    {
        if (strpos($value, '$2y$') !== 0) {
            throw new InvalidArgumentException("Argument: [{$value}] is not a valid password hash");
        }

        return new self($value);
    }

    public function verify(PlainTextPassword $plainTextPassword): bool
    {
        return password_verify(
            $plainTextPassword->getValue(),
            $this->getValue()
        );
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
