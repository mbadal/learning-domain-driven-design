<?php declare(strict_types=1);

namespace LearningDdd\ValueObjectExample;

use LearningDdd\ValueObjectExample\ValueObject\Amount;
use LearningDdd\ValueObjectExample\ValueObject\Currency;
use LearningDdd\ValueObjectExample\ValueObject\Money;

class BankAccount
{
    /** @var Money */
    private $money;

    private function __construct(Money $money)
    {
        $this->money = $money;
    }

    public static function createEurAccount(float $amount)
    {
        return new self(
            Money::createFromAmountAndCurrency(
                Amount::createFromFloat($amount),
                Currency::createEurCurrency()
            )
        );
    }

    public static function createAccountFromMoney(Money $money)
    {
        return new self($money);
    }

    public static function transferFromAnotherAccount(BankAccount $bankAccount)
    {
        return new self($bankAccount->getMoney());
    }

    public function depositMoney(Money $money)
    {
        $this->money = $this->money->add($money);
    }

    public function withdrawMoney(Money $money)
    {
        $this->money = $this->money->sub($money);
    }

    public function depositAmount(float $amount)
    {
        $this->money = $this->money->addAmount($amount);
    }

    public function withdrawAmount(float $amount)
    {
        $this->money = $this->money->subAmount($amount);
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
