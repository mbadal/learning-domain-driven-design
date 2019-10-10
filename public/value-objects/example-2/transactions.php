<?php declare(strict_types=1);

require '../../../vendor/autoload.php';

use LearningDdd\ValueObjectExample\BankAccount;

/** @var BankAccount $vubAccount */
$vubAccount = BankAccount::createEurAccount(120);

$vubAccount->depositAmount(180);
$vubAccount->withdrawAmount(100);
$vubAccount->depositAmount(300);

/** @var BankAccount $csobAccount */
$csobAccount = BankAccount::transferFromAnotherAccount($vubAccount);

// z csob uctu chcem vybrat 1000 CZK, lebo idem do Prahy(ale z EURoveho uctu neviem vyberat v inej mene :( )

//tak si vsetky peniaze z csob vytiahnem a vytvorim ucet vo fio banke v CZK a vlozim si tam 10000 CZK

//vytvor ucet v CZK
$fioAccount = BankAccount::createAccountFromMoney();


//a z neho si vytiahnem 1000 CZK na cestu do ciech