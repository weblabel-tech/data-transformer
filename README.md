Data Transformer
============

[![Build Status](https://travis-ci.org/weblabel-tech/data-transformer.svg?branch=master)](https://travis-ci.org/weblabel-tech/data-transformer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/weblabel-tech/data-transformer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/weblabel-tech/data-transformer/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/weblabel-tech/data-transformer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/weblabel-tech/data-transformer/?branch=master)

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
$ composer require weblabel/data-transformer
```

Basic Usage
===========
```php
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Weblabel\DataTransformer\Decoder\JsonDecoder;
use Weblabel\DataTransformer\Resolver\DecoderResolver;

$decoders = [
    new JsonDecoder(),
];
$decoderResolver = new DecoderResolver($decoders);

$jsonDecoder = $decoderResolver->resolve('json');
$data = $jsonDecoder->decode('{"status":"ok"}');

// will return
// [
//   'status' => 'ok',
// ]
```

Testing
=======
To run all unit tests, use the locally installed PHPUnit:

```console
$ ./vendor/bin/phpunit
```
