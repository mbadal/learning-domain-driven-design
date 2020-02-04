<?php declare(strict_types=1);

namespace LearningDdd\ValueObjectExample\ValueObject;

use InvalidArgumentException;

class Currency
{
    private const CURRENCY_EUR = 'eur';
    private const CURRENCY_CZK = 'czk';

    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function createFromString(string $value): self
    {
        if (!in_array($value, [
            self::CURRENCY_EUR,
            self::CURRENCY_CZK,
        ])) {
            throw new InvalidArgumentException("Currency: [{$value}] is not supported");
        }

        return new self($value);
    }

    public static function createEurCurrency(): self
    {
        return self::createFromString(self::CURRENCY_EUR);
    }

    public static function createCzkCurrency(): self
    {
        return self::createFromString(self::CURRENCY_CZK);
    }

    public function isEqual(Currency $currency): bool
    {
        return $this->value === $currency->getValue();
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function getValue(): string
    {
        return $this->value;
    }
}
