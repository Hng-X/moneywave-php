# moneywave-php

## Usage

```
$mw = new Moneywave();
$tran = new Transaction($mw);
$tran->fname="";
$tran->dispatch();
if($tran->status == ""){

}
```

### List of banks