<?php declare(strict_types=1);

namespace LearningDdd\ValueObject;

abstract class AbstractPassword
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