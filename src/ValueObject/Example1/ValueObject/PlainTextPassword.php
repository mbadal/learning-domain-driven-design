<?php declare(strict_types=1);

namespace LearningDdd\ValueObject\Example1\ValueObject;

use InvalidArgumentException;
use ReflectionClass;

class PlainTextPassword
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

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
            password_hash($this->value, PASSWORD_DEFAULT)
        );
    }

    public function isEqualToString($plainTextPassword): bool
    {
        return ($this->value === $plainTextPassword);
    }
}
