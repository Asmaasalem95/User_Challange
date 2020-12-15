<?php

namespace Tests\Unit;

use App\Transformers\ProviderXTransformer;
use App\Transformers\ProviderYTransformer;
use Tests\TestCase;

class TransformProviderDataTest extends TestCase
{

    /**
     * @test
     */
    public function transform_data_from_provider_x()
    {
        $providerXTransformer = new ProviderXTransformer();
        $data = [
            [
                "parentAmount" => 400,
                "Currency" => "AED",
                "parentEmail" => "parent4@parent.eu",
                "statusCode" => 1,
                "registerationDate" => "2019-09-07",
                "parentIdentification" => "d3dwwd70-1d25-11e3-8591-034165a3a613"
            ],
            [
                "parentAmount" => 200,
                "Currency" => "EUR",
                "parentEmail" => "parent5@parent.eu",
                "statusCode" => 1,
                "registerationDate" => "2018-10-30",
                "parentIdentification" => "d3d29d40-1d25-11e3-8591-034165a3a6133"
            ]
        ];


        $restults = $providerXTransformer->transform($data);
        $this->assertEquals($restults[0],["parentAmount" => 400,
            "currency" => "AED",
            "parentEmail" => "parent4@parent.eu",
            "statusCode" => 1,
            "registrationDate" => "2019-09-07",
            "parentIdentification" => "d3dwwd70-1d25-11e3-8591-034165a3a613",
            "provider" => "DataProviderX",
        ]);
    }

    /**
     * @test
     */
    public function transform_data_from_provider_y()
    {
        $providerYTransformer = new ProviderYTransformer();
        $data = [
            ["balance"=> 354.5,
            "currency"=> "AED",
            "email"=> "parent100@parent.eu",
            "status"=>100,
            "created_at"=> "22/12/2018",
            "id"=> "3fc2-a8d1"],
        [
            "balance"=> 1000,
            "currency"=> "USD",
            "email"=> "parent200@parent.eu",
            "status"=> 100,
            "created_at"=> "22/12/2018",
            "id"=> "4fc2-a8d1"
        ]

        ];

        $results = $providerYTransformer->transform($data);

        $this->assertEquals($results[0], ["parentAmount" => 354.5,
            "currency" => "AED",
            "parentEmail" => "parent100@parent.eu",
            "statusCode" => 1,
            "registrationDate" => "22/12/2018",
            "parentIdentification" => "3fc2-a8d1",
            "provider" => "DataProviderY",
        ]);
        $this->assertEquals($data[0]['balance'],$results[0]['parentAmount']);
        $this->assertEquals($data[0]['email'],$results[0]['parentEmail']);
    }


}
