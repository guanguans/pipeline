# pipeline

[简体中文](README-CN.md) | [ENGLISH](README.md)

> A simple PHP middleware pipeline. - 一个简单的 PHP 中间件管道。

[![Tests](https://github.com/guanguans/pipeline/workflows/Tests/badge.svg)](https://github.com/guanguans/pipeline/actions)
[![Check & fix styling](https://github.com/guanguans/pipeline/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/pipeline/actions)
[![codecov](https://codecov.io/gh/guanguans/pipeline/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/pipeline)
[![Latest Stable Version](https://poser.pugx.org/guanguans/pipeline/v)](//packagist.org/packages/guanguans/pipeline)
[![Total Downloads](https://poser.pugx.org/guanguans/pipeline/downloads)](//packagist.org/packages/guanguans/pipeline)
[![License](https://poser.pugx.org/guanguans/pipeline/license)](//packagist.org/packages/guanguans/pipeline)

## Requirement

* PHP >= 7.2

## Installation

```bash
$ composer require guanguans/pipeline --prefer-dist -vvv
```

## Usage

```php
use Guanguans\Pipeline\Pipeline;

(new Pipeline)
	->send($object)
    ->through($middleware)
    // ->via('differentMethod')
    // ->thenReturn()
    ->then(function(){
    	// middleware is finished
    });
```

## Testing

```bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [guanguans](https://github.com/guanguans)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
