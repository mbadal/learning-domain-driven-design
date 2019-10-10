<?php declare(strict_types=1);

namespace LearningDdd\ValueObjectExample;

use LearningDdd\ValueObjectExample\ValueObject\Money;

class BankAccount
{
    /** @var Money */
    private $balance;

    private function __construct(Money $money)
    {
    }

    public static function createEurAccount(float $amount)
    {
        //
    }

    public static function createAccountFromMoney(Money $money)
    {
        //
    }

    public static function transferFromAnotherAccount(BankAccount $bankAccount)
    {
        //
    }

    public function depositMoney(Money $money)
    {
        //
    }

    public function withdrawMoney(Money $money)
    {
        //
    }

    public function depositAmount(float $amount)
    {
        //
    }

    public function withdrawAmount(float $amount)
    {
        //
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
