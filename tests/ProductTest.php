<?php

class ProductTest extends TestCase{
    // public function testProductExistence(){
    //     $this->json('GET', '/user/products')->seeJson([
    //         'created' => true,
    //     ]);
    // }

    // public function testReturnAllProducts(){
    //     $this->get("api/v1/user/products", []);
    //     $this->seeStatusCode(200);
    //     $this->seeJson(
    //         ['message' =>
    //             [
    //                 'name',
    //                 'price',
    //                 'user_id',
    //                 'description',
    //                 'created_at',
    //                 'updated_at'
    //             ]
    //             ],

    //         ['pagination' => [
    //             // '*' => [
    //                 'total',
    //                 'pre_page',
    //                 'current_page',
    //                 'last_page',
    //                 'from',
    //                 'to',
    //                 ]
    //             ]
    //     );
    // }


    /**
     * /products/id [GET]
     */

    public function testShouldReturnProduct(){
        $this->get("api/v1/user/products/1", []);
        $this->seeStatusCode(200);
        $this->seeJson(
            [
                'message' =>

                [   'name',
                    'price',
                    'user_id',
                    'description',
                    'created_at',
                    'updated_at'
            ]
            ]
        );
    }


    /**
     * /products [POST]
     */
    public function testShouldCreateProduct(){

        $parameters = [
            'name' => 'Infinix',
            'price' => 52200,
            'user_id' => 1,
            'description' => 'NOTE 4 5.7-Inch IPS LCD (3GB, 32GB ROM) Android 7.0 ',
        ];

        $this->post("api/v1/user/products", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJson(
            [
                'message' =>
                [
                    'name',
                    'price',
                    'user_id',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            ]
        );

    }

    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct(){

        $parameters = [
            'name' => 'Infinix Hot Note',
            'price' => 75000,
            'user_id'=> 1,
            'description' => 'Champagne Gold, 13M AF + 8M FF 4G Smartphone',
        ];

        $this->put("api/v1/user/products/1", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJson(
            ['message' =>
                [
                    'name',
                    'price',
                    'description',
                    'user_id',
                    'created_at',
                    'updated_at',

                ]
            ]
        );
    }

    /**
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){

        $this->delete("api/v1/user/products/2", [], []);
        $this->seeStatusCode(200);
        $this->seeJson([
                'status',
                'message'
        ]);
    }

    /** @test **/
    public function testShouldShowFailWhenTheProductIdDoesNotExist()
    {
        $this->get('api/v1/user/products/324')
        ->seeStatusCode(201)
        ->seeJson([
            'status' => 'error',
            'message' => 'Product not found'
        ]);
    }

    // public function shouldShowFailWhenTheProductIdDoesNotExist()
    // {
    //     $this->markTestIncomplete('Pending test');
    // }

}
