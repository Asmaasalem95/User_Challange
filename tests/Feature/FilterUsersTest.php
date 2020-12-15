<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterUsersTest extends TestCase
{
/*
    public function orderTickets($concert,$params)
    {
        return   $this->json('GET', "/api/users/{$concert->id}/orders",$params);
    }*/


    /**
     * @test
     */
    function user_cannot_filter_with_invalid_status_code()
    {

        $response = $this->json('GET','/api/users?statusCode=unknown');

        $response->assertStatus(422);
        $response->assertJson(['status'=>"Invalid inputs!"]);

    }

    /**
     * @test
     */
    function user_cannot_filter_with_invalid_provider_name()
    {

        $response = $this->json('GET','/api/users?provider=DataProviderZ');

        $response->assertStatus(422);
        $response->assertJson(['status'=>"Invalid inputs!"]);

    }

    /**
     * @test
     */
    function user_cannot_filter_with_invalid_min_and_max_balance()
    {

        $response = $this->json('GET','/api/users?balanceMin=150&balanceMax=100');

        $response->assertStatus(422);
        $response->assertJson(['status'=>"Invalid inputs!"]);
    }


}
