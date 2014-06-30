# AsanakClient
*AsanakClient* is an easy to use client for [Asanak](www.asanak.ir) sms service.

## Installation
For using *AsanakClient* you should add it to your project with one of following methods.

### Using composer
To install *AsanakClient* with Composer, add following line into your *composer.json* `requeire` key

```json
{
    "require": {
        "opilo/asanakclient": "dev-master"
    }
}

```

### Old method
If you don't like the composer stuffs, just use `require` or `include` php keyword.

#### example
```php
<?php

include '/path/to/src/ClientManager.php';

$data = array(
    // sms data
);

$client = new AsanakClient\ClientManager($data);
```

## Usages and methods

### sendSms() method usage
to use *sendSms()* method you just pass necessary data to its constructor and then call *sndSms()* method. 

#### example
```php
<?php

use AsanakClient\ClientManager;

$data = array(
    // sms data
);

$client = new AsanakClient\ClientManager($data);
$response = $client->sendSms();
```