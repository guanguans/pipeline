<?php

/**
 * This file is part of the guanguans/pipeline.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Pipeline;

use Psr\Container\ContainerInterface;

/**
 * This file is modified from `https://github.com/illuminate/pipeline`.
 */
class Hub
{
    /**
     * The container implementation.
     *
     * @var \Psr\Container\ContainerInterface|null
     */
    protected $container;

    /**
     * All of the available pipelines.
     *
     * @var array
     */
    protected $pipelines = [];

    /**
     * Create a new Hub instance.
     *
     * @return void
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Define the default named pipeline.
     *
     * @return void
     */
    public function defaults(\Closure $callback)
    {
        return $this->pipeline('default', $callback);
    }

    /**
     * Define a new named pipeline.
     *
     * @param string $name
     *
     * @return void
     */
    public function pipeline($name, \Closure $callback)
    {
        $this->pipelines[$name] = $callback;
    }

    /**
     * Send an object through one of the available pipelines.
     *
     * @param string|null $pipeline
     */
    public function pipe($object, $pipeline = null)
    {
        $pipeline = $pipeline ?: 'default';

        return call_user_func(
            $this->pipelines[$pipeline], new Pipeline($this->container), $object
        );
    }

    /**
     * Get the container instance used by the hub.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set the container instance used by the hub.
     *
     * @return $this
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        return $this;
    }
}
