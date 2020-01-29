<?php declare(strict_types=1);

namespace LearningDdd\Example1\ValueObject;

abstract class PasswordAbstract
{
    /** @var string */
    private $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    protected function getValue(): string
    {
        return $this->value;
    }
}