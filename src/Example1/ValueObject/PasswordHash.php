<?php declare(strict_types=1);

namespace LearningDdd\Example1\ValueObject;

use InvalidArgumentException;

class PasswordHash
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function createFromHashedString(string $value): PasswordHash
    {
        if (strpos($value, '$2y$') !== 0) {
            throw new InvalidArgumentException("Argument: [{$value}] is not a valid password hash");
        }

        return new self($value);
    }

    public function verify(): bool
    {

    }

    public function toString(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
