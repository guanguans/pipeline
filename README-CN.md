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
