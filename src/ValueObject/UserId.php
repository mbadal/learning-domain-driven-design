<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

use InvalidArgumentException;

class UserId
{
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function createFromInt(int $value): UserId
    {
        if ($value <= 0) {
            throw new InvalidArgumentException("Argument: [{$value}] has to be greater than 0");
        }

        return new self($value);
    }

    public function __toString()
    {
        return (string)$this->value;
    }
}