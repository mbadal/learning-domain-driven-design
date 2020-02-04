<?php declare(strict_types=1);

require '../../../vendor/autoload.php';

use LearningDdd\ValueObjectExample\BankAccount;

/** @var BankAccount $eurAccount */
$eurAccount = BankAccount::createEurAccount(120);

$eurAccount->depositAmount(180);
$eurAccount->withdrawAmount(100);
$eurAccount->depositAmount(300);
$eurAccount->withdrawAmount(1000);

/** @var BankAccount $secondAccount */
$secondAccount = BankAccount::transferFromAnotherAccount($eurAccount);

// z csob uctu chcem vybrat 1000 CZK, lebo idem do Prahy(ale z EURoveho uctu neviem vyberat v inej mene :(

//tak si vsetky peniaze z uctu v eurach vytiahnem a vytvorim ucete v CZK a vlozim si tam 10000 CZK

//vytvor ucet v CZK
$czkAccount = BankAccount::createAccountFromMoney(
    \LearningDdd\ValueObjectExample\ValueObject\Money::createFromAmountAndCurrency(
        \LearningDdd\ValueObjectExample\ValueObject\Amount::createFromFloat(10000.00),
        \LearningDdd\ValueObjectExample\ValueObject\Currency::createCzkCurrency()
    )
);


//a z neho si vytiahnem 1000 CZK na cestu do ciech
