<?php

/**
 * This file is part of the guanguans/pipeline.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Pipeline\Tests;

use Guanguans\Pipeline\Pipeline;

class PipelineTest extends TestCase
{
    public function testPipelineBasicUsage()
    {
        $pipeOne = function ($piped, $next) {
            $_SERVER['__test.pipe.one'] = $piped;

            return $next($piped);
        };

        $pipeTwo = function ($piped, $next) {
            $_SERVER['__test.pipe.two'] = $piped;

            return $next($piped);
        };

        $result = (new Pipeline())
            ->send('foo')
            ->through([
                $pipeOne,
                $pipeTwo,
            ])
            ->then(function ($piped) {
                return $piped;
            });

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);
        $this->assertSame('foo', $_SERVER['__test.pipe.two']);

        unset($_SERVER['__test.pipe.one'], $_SERVER['__test.pipe.two']);
    }

    public function testPipelineUsageWithObjects()
    {
        $result = (new Pipeline())
            ->send('foo')
            ->through([new PipelineTestPipeOne()])
            ->then(function ($piped) {
                return $piped;
            });

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);
    }

    public function testPipelineUsageWithInvokableObjects()
    {
        $result = (new Pipeline())
            ->send('foo')
            ->through([new PipelineTestPipeTwo()])
            ->then(
                function ($piped) {
                    return $piped;
                }
            );

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);
    }

    public function testPipelineUsageWithCallable()
    {
        $function = function ($piped, $next) {
            $_SERVER['__test.pipe.one'] = 'foo';

            return $next($piped);
        };

        $result = (new Pipeline())
            ->send('foo')
            ->through([$function])
            ->then(
                function ($piped) {
                    return $piped;
                }
            );

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);

        $result = (new Pipeline())
            ->send('bar')
            ->through($function)
            ->thenReturn();

        $this->assertSame('bar', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);
    }

    public function testPipelineUsageWithInvokableClass()
    {
        $result = (new Pipeline())
            ->send('foo')
            ->through([new PipelineTestPipeTwo()])
            ->then(
                function ($piped) {
                    return $piped;
                }
            );

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);
    }

    public function testPipelineUsageWithParameters()
    {
        $this->markTestSkipped();

        $parameters = ['one', 'two'];

        $result = (new Pipeline())
            ->send('foo')
            ->through(PipelineTestParameterPipe::class.':'.implode(',', $parameters))
            ->then(function ($piped) {
                return $piped;
            });

        $this->assertSame('foo', $result);
        $this->assertEquals($parameters, $_SERVER['__test.pipe.parameters']);

        unset($_SERVER['__test.pipe.parameters']);
    }

    public function testPipelineViaChangesTheMethodBeingCalledOnThePipes()
    {
        $pipelineInstance = new Pipeline();
        $result = $pipelineInstance->send('data')
            ->through(new PipelineTestPipeOne())
            ->via('differentMethod')
            ->then(function ($piped) {
                return $piped;
            });
        $this->assertSame('data', $result);
    }

    public function testPipelineThrowsExceptionOnResolveWithoutContainer()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('A container instance has not been passed to the Pipeline.');

        (new Pipeline())->send('data')
            ->through(PipelineTestPipeOne::class)
            ->then(function ($piped) {
                return $piped;
            });
    }

    public function testPipelineThenReturnMethodRunsPipelineThenReturnsPassable()
    {
        $result = (new Pipeline())
            ->send('foo')
            ->through([new PipelineTestPipeOne()])
            ->thenReturn();

        $this->assertSame('foo', $result);
        $this->assertSame('foo', $_SERVER['__test.pipe.one']);

        unset($_SERVER['__test.pipe.one']);
    }
}

class PipelineTestPipeOne
{
    public function handle($piped, $next)
    {
        $_SERVER['__test.pipe.one'] = $piped;

        return $next($piped);
    }

    public function differentMethod($piped, $next)
    {
        return $next($piped);
    }
}

class PipelineTestPipeTwo
{
    public function __invoke($piped, $next)
    {
        $_SERVER['__test.pipe.one'] = $piped;

        return $next($piped);
    }
}

class PipelineTestParameterPipe
{
    public function handle($piped, $next, $parameter1 = null, $parameter2 = null)
    {
        $_SERVER['__test.pipe.parameters'] = [$parameter1, $parameter2];

        return $next($piped);
    }
}
