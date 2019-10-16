<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

use InvalidArgumentException;

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

    public function isEqual(PlainTextPassword $plainTextPassword): bool
    {
        return ($this->value === $plainTextPassword->getValue());
    }

    private function getValue(): string
    {
        return $this->value;
    }
}