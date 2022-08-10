<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;
class ProductControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
        /** @test **/
    public function index_status_code_should_be_200(){
        $this->visit('/api/vq/user/products')->seeStatusCode(200);
    }
}
