# moneywave-php

## Usage

```
use Moneywave\Moneywave;
use Moneywave\WalletToAccountTransaction;
use Moneywave\Bank;

//Get a moneywave client instance
$mw = new Moneywave();

//get a transaction instance
$tran = new WalletToAccountTransaction($mw);

//set details
$tran->lock = "hgot6574kik";
$tran->amount => 25000;
$tran->bankcode => Bank::STERLING;
$tran->accountNumber => "";
$tran->senderName => "Johnson";
$tran->ref => 40;

//or you could do this in a batch
$tran->setDetails(array(
));

//make the transaction
$tran->dispatch();

//note: "success" is as defined by moneywave, see
if($tran->successful()) {
    //yay!
} else {
print_r($tran->getStatus();
}

//you can access the complete response
print_r($trans->getResponse());
```

### List of banks