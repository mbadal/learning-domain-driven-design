<?php declare(strict_types=1);

namespace LearningDdd\Example1\ValueObject;

use InvalidArgumentException;

class PlainTextPassword
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function createFromString(string $value): PlainTextPassword
    {
        $stringLength = mb_strlen($value);
        if ($stringLength < 6 || $stringLength > 32) {
            throw new InvalidArgumentException('Password should be <6, 32> characters long');
        }

        return new self($value);
    }

    public function hash(): PasswordHash
    {
        return PasswordHash::createFromHashedString(
            password_hash($this->value, PASSWORD_DEFAULT)
        );
    }
}
