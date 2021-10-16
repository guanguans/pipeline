<?php

/**
 * This file is part of the guanguans/pipeline.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

require __DIR__.'/../vendor/autoload.php';

use Guanguans\Pipeline\Pipeline;

$ret = (new Pipeline())
    ->send('passable - ')
    ->through(
        function ($passable, Closure $next) {
            echo $before = '1. Before apply first middleware.'.PHP_EOL;

            $passable .= $before;

            $stack = $next($passable);

            echo $after = '7. After apply first middleware.'.PHP_EOL;

            $stack .= $after;

            return $stack;
        },
        function ($passable, Closure $next) {
            echo $before = '2. Before apply second middleware.'.PHP_EOL;

            $passable .= $before;

            $stack = $next($passable);

            echo $after = '6. After apply second middleware.'.PHP_EOL;

            $stack .= $after;

            return $stack;
        },
        function ($passable, Closure $next) {
            echo $before = '3. Before apply third middleware.'.PHP_EOL;

            $passable .= $before;

            $stack = $next($passable);

            echo $after = '5. After apply third middleware.'.PHP_EOL;

            $stack .= $after;

            return $stack;
        }
    )
    // ->via('differentMethod')
    // ->thenReturn()
    ->then(function ($passable) {
        echo '4. Middleware is finished.'.PHP_EOL.PHP_EOL;

        var_dump($passable);

        // return PHP_EOL;
        return $passable.PHP_EOL;
    });

echo PHP_EOL;
var_dump($ret);
