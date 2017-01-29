# moneywave-php
[![Latest Stable Version](https://poser.pugx.org/hngx/moneywave-php/v/stable)](https://packagist.org/packages/hngx/moneywave-php) [![Total Downloads](https://poser.pugx.org/hngx/moneywave-php/downloads)](https://packagist.org/packages/hngx/moneywave-php) [![License](https://poser.pugx.org/hngx/moneywave-php/license)](https://packagist.org/packages/hngx/moneywave-php) [![Latest Unstable Version](https://poser.pugx.org/hngx/moneywave-php/v/unstable)](https://packagist.org/packages/hngx/moneywave-php)

PHP wrapper for the [Moneywave API](http;//moneywave.flutterwave.com/api)

## Usage

```
use Moneywave\Moneywave;
use Moneywave\Transaction\WalletToAccountTransaction;
use Moneywave\Resources\GetWalletBalance;
use Moneywave\Bank;

//Get a moneywave client instance
$mw = new Moneywave();

//get a transaction instance
$tran = new WalletToAccountTransaction($mw);

//set details
$tran->amount = 25000;
$tran->bankcode = Bank::$STERLING;
$tran->accountNumber = "000056050";
$tran->senderName = "Johnson";
$tran->ref = 40;

//or you could do this in a batch
$tran->setDetails(array(
  "amount" => 25000,
  "bankcode" => Bank::$STERLING,
  "accountNumber" => "000056050",
  "senderName" => "Johnson",
  "ref" => 40
));

//make the transaction
$tran->dispatch();

//note: "success" is as defined by moneywave
if($tran->successful()) {
    //yay!
} else {
print_r($tran->getStatus();
}

//you can access the complete response
print_r($tran->getResponse());

//check your wallet balance
$bal=new GetWalletBalance($mw);
$bal->dispatch();
print_r($bal->getResponse());
```
### Available Transaction Types
```
CardToAccountTransaction
CardToWalletTransaction
ChargeToCardTransaction
WalletToAccountTransaction
BulkWalletToAccountTransaction
```

### Available Resource Types
```
GetWalletBalance
PreviousCardToAccount
PreviousWalletToAccount
RetryFailedTransaction
ValidateAccountNumber
```

### List of banks
Here is the list of banks currently supported by the Moneywave API. Their codes are available as constants in the `\Moneywavw\Bank` class:

```
FCMB   // FIRST CITY MONUMENT BANK PLC
UNITY   // UNITY BANK PLC
STANBIC_IBTC   // STANBIC IBTC BANK PLC
STERLING   // STERLING BANK PLC
STANBIC_MOBILE   //  STANBIC Mobile PLC
PAYCOM //  PAYCOM
ECOBANK_MOBILE //  ECOBANK MOBILE
FBN_MOBILE //  FBN MOBILE
PARKWAY //  PARKWAY
GTBANK_MOBILE //  GTBank Mobile Money
ZENITH_MOBILE //  ZENITH Mobile
ACCESS_MOBILE //  ACCESS Mobile
ASO //  Aso Savings and Loans
ACCESS //  ACCESS BANK NIGERIA
AFRIBANK //  AFRIBANK NIGERIA PLC
DIAMOND //  DIAMOND BANK PLC
ECOBANK //  ECOBANK NIGERIA PLC
ENTERPRISE //  ENTERPRISE BANK LIMITED
FIDELITY //  FIDELITY BANK PLC
FIRST //  FIRST BANK PLC
GTBANK //  GTBANK PLC
HERITAGE //  HERITAGE BANK
KEYSTONE //  KEYSTONE BANK PLC
SKYE //  SKYE BANK PLC
STANDARD_CHARTERED //  STANDARD CHARTERED BANK NIGERIA LIMITED
UNION //  UNION BANK OF NIGERIA PLC
UBA //  UNITED BANK FOR AFRICA PLC
WEMA //  WEMA BANK PLC
ZENITH //  ZENITH BANK PLC

```

## Installation

```
composer require hngx/moneywave-php
```
