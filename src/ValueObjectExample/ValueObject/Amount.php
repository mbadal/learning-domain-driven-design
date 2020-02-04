<?php declare(strict_types=1);

namespace LearningDdd\ValueObjectExample\ValueObject;

class Amount
{
    /** @var float */
    private $value;

    private function __construct(float $value)
    {
        $this->value = $value;
    }

    public static function createFromFloat(float $value): Amount
    {
        return new self($value);
    }

    public function add(Amount $amount): Amount
    {
        return new Amount(
            $this->value + $amount->getValue()
        );
    }

    public function sub(Amount $amount): Amount
    {
        return new Amount(
            $this->value - $amount->getValue()
        );
    }

    private function getValue(): float
    {
        return $this->value;
    }
}
