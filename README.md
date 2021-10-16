# pipeline

[简体中文](README-CN.md) | [ENGLISH](README.md)

> An elegant PHP middleware pipeline. - 一个优雅的 PHP 中间件管道。

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

### Code

```php
<?php
require __DIR__.'/vendor/autoload.php';

use Guanguans\Pipeline\Pipeline;

(new Pipeline())
    ->send('passable')
    ->through(
        function ($passable, Closure $next){
            echo '1. Before apply first middleware.'.PHP_EOL;
            $next($passable);
            echo '7. After apply first middleware.'.PHP_EOL;
        },
        function ($passable, Closure $next){
            echo '2. Before apply second middleware.'.PHP_EOL;
            $next($passable);
            echo '6. After apply second middleware.'.PHP_EOL;
        },
        function ($passable, Closure $next){
            echo '3. Before apply third middleware.'.PHP_EOL;
            $next($passable);
            echo '5. After apply third middleware.'.PHP_EOL;
        }
    )
    // ->via('differentMethod')
    // ->thenReturn()
    ->then(function ($passable){
        echo '4. Middleware is finished.'.PHP_EOL;

        return $passable;
    });
```

### Output

```md
1. Before apply first middleware.
2. Before apply second middleware.
3. Before apply third middleware.
4. Middleware is finished.
5. After apply third middleware.
6. After apply second middleware.
7. After apply first middleware.
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
