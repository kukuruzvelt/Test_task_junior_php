<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{


    public function test_getting_companies()
    {
        $client = static::createClient();

        $client->request('GET', '/companies');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('companies', $responseData);
        $this->assertIsArray($responseData['companies']);
        foreach ($responseData['companies'] as $company) {
            $this->assertArrayHasKey('name', $company);
            $this->assertArrayHasKey('class', $company);
        }
    }

    public function test_calculate_price()
    {
        $client = static::createClient();

        $requestData = [
            'company' => 'App\Service\PackGroup',
            'weight' => 5,
        ];

        $client->request('POST', '/calculate', [], [], [], json_encode($requestData));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertIsArray($responseData);

        $this->assertArrayHasKey('price', $responseData);
    }
}