# pipeline

[简体中文](README-CN.md) | [ENGLISH](README.md)

> An elegant PHP middleware pipeline. - 一个优雅的 PHP 中间件管道。

[![Tests](https://github.com/guanguans/pipeline/workflows/Tests/badge.svg)](https://github.com/guanguans/pipeline/actions)
[![Check & fix styling](https://github.com/guanguans/pipeline/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/pipeline/actions)
[![codecov](https://codecov.io/gh/guanguans/pipeline/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/pipeline)
[![Latest Stable Version](https://poser.pugx.org/guanguans/pipeline/v)](//packagist.org/packages/guanguans/pipeline)
[![Total Downloads](https://poser.pugx.org/guanguans/pipeline/downloads)](//packagist.org/packages/guanguans/pipeline)
[![License](https://poser.pugx.org/guanguans/pipeline/license)](//packagist.org/packages/guanguans/pipeline)

## 环境要求

* PHP >= 7.2

## 安装

```bash
$ composer require guanguans/pipeline --prefer-dist -vvv
```

## 使用

### 代码

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

### 输出

```md
1. Before apply first middleware.
2. Before apply second middleware.
3. Before apply third middleware.
4. Middleware is finished.
5. After apply third middleware.
6. After apply second middleware.
7. After apply first middleware.
```

## 测试

```bash
$ composer test
```

## 变更日志

请参阅 [CHANGELOG](CHANGELOG.md) 获取最近有关更改的更多信息。

## 贡献指南

请参阅 [CONTRIBUTING](.github/CONTRIBUTING.md) 有关详细信息。

## 安全漏洞

请查看[我们的安全政策](../../security/policy)了解如何报告安全漏洞。

## 贡献者

* [guanguans](https://github.com/guanguans)
* [所有贡献者](../../contributors)

## 协议

MIT 许可证（MIT）。有关更多信息，请参见[协议文件](LICENSE)。
