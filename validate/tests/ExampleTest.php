<?php

namespace Lazy\Validate\Tests;

use Orchestra\Testbench\TestCase;
use Lazy\Validate\ValidateServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ValidateServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
