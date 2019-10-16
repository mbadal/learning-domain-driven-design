<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

use InvalidArgumentException;
use ReflectionClass;

class PasswordHash
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function createFromString(string $value): PasswordHash
    {
        if (strpos($value, '$2y$') !== 0) {
            throw new InvalidArgumentException("Argument: [{$value}] is not a valid password hash");
        }

        return new self($value);
    }

    public function verify(PlainTextPassword $plainTextPassword): bool
    {
        $reflector = new ReflectionClass($plainTextPassword);
        $property  = $reflector->getProperty('value');
        $property->setAccessible(true);

        return (password_verify($property->getValue($plainTextPassword), $this->value));
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