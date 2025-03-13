<?php

namespace Javaabu\Boli\Tests;


use Illuminate\Support\Facades\App;
use Javaabu\Boli\Boli;

class BoliTest extends TestCase
{

    public function test_it_can_make_a_boli_instance()
    {
        $api = App::make('boli');

        $this->assertInstanceOf(Boli::class, $api);
    }
}
