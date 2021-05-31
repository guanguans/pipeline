<?php

/**
 * This file is part of the guanguans/pipeline.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Pipeline\Tests\Benchmark;

use Guanguans\Pipeline\PackageSkeleton;

/**
 * @BeforeMethods({"setUp"})
 */
final class PackageSkeletonBench
{
    /**
     * @var \Guanguans\Pipeline\PackageSkeleton
     */
    private $packageSkeleton;

    public function setUp(): void
    {
        $this->packageSkeleton = new PackageSkeleton();
    }

    public function benchTest(): void
    {
        // $this->packageSkeleton->test();
        PackageSkeleton::test();
    }
}
