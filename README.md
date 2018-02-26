# moneywave-php
[![Latest Stable Version](https://poser.pugx.org/hngx/moneywave-php/v/stable)](https://packagist.org/packages/hngx/moneywave-php) [![Total Downloads](https://poser.pugx.org/hngx/moneywave-php/downloads)](https://packagist.org/packages/hngx/moneywave-php) [![License](https://poser.pugx.org/hngx/moneywave-php/license)](https://packagist.org/packages/hngx/moneywave-php) [![Latest Unstable Version](https://poser.pugx.org/hngx/moneywave-php/v/unstable)](https://packagist.org/packages/hngx/moneywave-php)

PHP wrapper for the [Moneywave API](http://moneywave.flutterwave.com/api)
Please consult the official documentation for more details.

## Contents
* [Configuration](#configuration)
* [Usage:  Dispatching Transactions/Resources](#usage1)
* [Usage: Handling Responses](#usage2)
* [Usage: Errors](#usage3)
* [Installation](#installation)
* [Bugs](#bugs)


## <a name="configuration">Configuration</a>
To carry out a transaction or access a resource, you will need an instance of the moneywave client
This will be used for your API calls.

```php
$mw = new \HngX\Moneywave\Moneywave($yourApiKey, $yourSecretKey);
```

## <a name="usage1">Usage: Dispatching Transactions/Resources</a>
### Performing Transactions
To perform a transaction, there are 3 simple steps:

1. Create the transaction.
  All transactions take the moneywave client instance as a constructor argument. The `WalletToAccountTransaction` and `BulkWalletToAccountTransaction` transactions also take a second parameter: the wallet password

2. Set the appropriate details
  All the fields listed for each transaction in [the docs](https://moneywave.flutterwave.com/api) are available as properties on the transaction class (via magic methods), so you can set them individually. Alternatively, you could use the `setDetails()` function to set them in one go.
  **Caution**: be sure to use the *exact* parameter names (including capitalisation) as described at https://moneywave.flutterwave.com/api.
  The following fields are automatically set for you on each transaction:

  | Field     | Default                                                                   |
  | --------- | ----------------------------------------------------------------------------- |
  | apiKey    | the API key used when creating the `Moneywave` client    |
  | secret    | the secret key used when creating the `Moneywave` client      |
  | currency  | "NGN"                                 |
  | lock      | (for `WalletToAccountTransaction` and `BulkWalletToAccountTransaction`) the wallet password supplied in the constructor                                                     |

3. Dispatch the transaction by calling `dispatch()`

Here is an example:
```php

//we want to perform a wallet to account transfer
$tran = new \HngX\Moneywave\Transactions\WalletToAccountTransaction($mw, $walletPassword);

//set details
$tran->amount = 25000;
$tran->bankcode = \HngX\Moneywave\Bank::STERLING;
$tran->accountNumber = "000056050";
$tran->senderName = "Johnson";
$tran->ref = 40;

//then make the transaction
$tran->dispatch();

//or you could do this in a batch
$tran->setDetails(array(
  "amount" => 25000,
  "bankcode" => \HngX\Moneywave\Bank::STERLING,
  "accountNumber" => "000056050",
  "senderName" => "Johnson",
  "ref" => 40
))->dispatch();
```

#### Available Transaction Types
```
AccountToAccountTransaction
CardToAccountTransaction
CardToWalletTransaction
TotalChargeToCardTransaction
WalletToAccountTransaction
BulkWalletToAccountTransaction
```

#### Available bank codes
Here is the list of banks currently supported by the Moneywave API. Their codes are available as constants in the `\HngX\Moneywavw\Bank` class:

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

### Accessing a Resource
The same 3 steps apply:

1. Create the resource.
  All resources take the moneywave client instance as their only constructor argument.

2. Set the appropriate details, if any. The `GetWalletBalance` do not need any extra data
  All the fields listed for each resource in [the docs](https://moneywave.flutterwave.com/api) are available as properties on the resource class (via magic methods), so you can set them individually. Alternatively, you could use the `setDetails()` function to set them in one go.
  **Caution**: be sure to use the *exact* parameter names (including capitalisation) as described at https://moneywave.flutterwave.com/api.
  The following fields are automatically set for you on each resource:

  | Field     | Default                                                                   |
  | --------- | ----------------------------------------------------------------------------- |
  | apiKey    | the API key used when creating the `Moneywave` client    |
  | secret    | the secret key used when creating the `Moneywave` client      |

3. Dispatch the resource by calling `dispatch()`.

Here is an example:
```php
//we want to check our wallet balance
$bal=new \HngX\Moneywave\Resources\GetWalletBalance($mw);
$bal->dispatch();
```
#### Available Resource Types
```
GetWalletBalance
PreviousCardToAccount
PreviousWalletToAccount
RetryFailedTransaction
ValidateAccountNumber
TokenizeCard
```
## <a name="usage2">Usage: Handling Responses</a>
After dispatching a transaction or resource, you may access the full response by calling `getResponse()` on the object.
```php
$tran->getResponse();

/*
[
  "status" => "success",
  "data" => [
    ...]
  ]
*/
```
You can also find out the `status` alone by calling `getStatus()`.
```php
$tran->getStatus(); // -> "success" or "error"
```
You may also call `successful()` directly to test if the `status` of the response was `success`:
Caution: According to Moneywave, "success" does not neccessarily mean The transaction has gone through. Consult the official docs for more details

```php
if ($tran->successful()) {
  //yay!
} else {
  print_r($tran->getResponse());
}
```

#### Validating Transactions
According to the docs, the two transaction types `AccountToAccountTransaction` and `CardToAccountTransaction` may also need validation after being dispatched. To do that, simply call `validate()` on the transaction object with the appropriate data:
```php
$tran = new \HngX\Moneywave\AccountToAccountTransaction($mw);
$tran->setDetails([
    "firstname" => "Donald",
    "lastname" => "Trump",
    ...
  ])
  ->dispatch();
if ($tran->successful()){
  $tran->validate([
    "transactionRef" => $tran->getResponse()["data"]["ref"],
    "authType" => "OTP",
    "authValue" => "7489",
  ]);
}
```
Note: after this, calling `getResponse()` or `getStatus()` will return the response or status for the validation process

## <a name="usage3">Usage: Errors</a>
You will get an instance of `\HngX\MoneywaveException` if you do anything naughty.

## <a name="installation">Installation</a>

```
composer require hngx/moneywave-php
```
## <a name="bugs">Bugs</a>
If you notice any bugs, please create a new issue. We will attend to it promptly.
