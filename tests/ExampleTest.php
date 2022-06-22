<?php

namespace Javaabu\Boli\Tests;

use Orchestra\Testbench\TestCase;
use Javaabu\Boli\BoliServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BoliServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
