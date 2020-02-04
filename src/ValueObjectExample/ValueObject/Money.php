<?php declare(strict_types=1);

namespace LearningDdd\ValueObjectExample\ValueObject;

use InvalidArgumentException;

class Money
{
    /** @var Currency */
    private $currency;

    /** @var Amount */
    private $amount;

    private function __construct(Amount $amount, Currency $currency)
    {
        $this->currency = $currency;
        $this->amount   = $amount;
    }

    public static function createFromAmountAndCurrency(Amount $amount, Currency $currency): self
    {
        return new self($amount, $currency);
    }

    public function sub(Money $money): Money
    {
        if (!$this->currency->isEqual($money->getCurrency())) {
            throw new InvalidArgumentException("Cannot perform sub operation. Money in currency: [{$money->getCurrency()}] supplied. Current currency: [{$this->currency}]");
        }

        return new self(
            $this->amount->sub(
                $money->getAmount()
            ),
            $this->currency
        );
    }

    public function add(Money $money): Money
    {
        if (!$this->currency->isEqual($money->getCurrency())) {
            throw new InvalidArgumentException("Cannot perform add operation. Money in currency: [{$money->getCurrency()}] supplied. Current currency: [{$this->currency}]");
        }

        return new self(
            $this->amount->add(
                $money->getAmount()
            ),
            $this->currency
        );
    }

    public function subAmount(float $amount): Money
    {
        return new self(
            $this->amount->sub(Amount::createFromFloat($amount)),
            $this->currency
        );
    }

    public function addAmount(float $amount): Money
    {
        return new self(
            $this->amount->add(Amount::createFromFloat($amount)),
            $this->currency
        );
    }

    private function getAmount(): Amount
    {
        return $this->amount;
    }

    private function getCurrency(): Currency
    {
        return $this->currency;
    }
}
