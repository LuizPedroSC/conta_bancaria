<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

abstract class BaseTest extends TestCase
{
    use RefreshDatabase;

    protected $connection = 'mysql_test';

    protected $tokenApiTest;

    public function __construct()
    {
        parent::__construct();
    }

    protected function getTokenApiTest(){
        return env('TOKEN_API_TEST');
    }
}
