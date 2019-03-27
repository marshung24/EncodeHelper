# EncodeHelper
Encoding processing library, providing encoding, decoding and other functions

> Continuation library marshung/helper, only keep and maintain EncodeHelper

[![Latest Stable Version](https://poser.pugx.org/marsapp/encodehelper/v/stable)](https://packagist.org/packages/marsapp/encodehelper) [![Total Downloads](https://poser.pugx.org/marsapp/encodehelper/downloads)](https://packagist.org/packages/marsapp/encodehelper) [![Latest Unstable Version](https://poser.pugx.org/marsapp/encodehelper/v/unstable)](https://packagist.org/packages/marsapp/encodehelper) [![License](https://poser.pugx.org/marsapp/encodehelper/license)](https://packagist.org/packages/marsapp/encodehelper)

# Outline
- [Installation](#Installation)
- [Usage](#Usage)
  - [EncodeHelper](#EncodeHelper)


# [Installation](#Outline)
## Composer Install
```
# composer require marsapp/encodehelper
```

## Include
Include composer autoloader before use.
```php
require __PATH__ . "vendor/autoload.php";
```

# [Usage](#Outline)

## [EncodeHelper](#Outline)
Namespace use:
```php
use marsapp\helper\encode\EncodeHelper;
```


### snapshotEncode()
Snapshot encode(zip)
```php
snapshotEncode($data, $forceCompress = false) : String
```

Example :
```php
$data = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
];

$result = EncodeHelper::snapshotEncode($data);
```
$result:
```php
// String
$result = '0[{"c_sn":"a110","u_sn":"b1","u_no":"a001","u_name":"name1"}]';
```


### snapshotDecode()
Snapshot decode(unzip)
```php
snapshotDecode(String $data, $assoc = true) : mixed
```

Example :
```php
$data = '0[{"c_sn":"a110","u_sn":"b1","u_no":"a001","u_name":"name1"}]';

$result = EncodeHelper::snapshotDecode($data);
```
$result:
```php
$result = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
];
```


