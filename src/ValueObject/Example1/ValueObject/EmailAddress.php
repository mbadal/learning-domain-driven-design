<?php declare(strict_types=1);

namespace LearningDdd\ValueObject\Example1\ValueObject;

use InvalidArgumentException;

class EmailAddress
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function createFromString(string $value): EmailAddress
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Argument: [{$value}] is not a valid email address");
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return $this->value;
    }
}