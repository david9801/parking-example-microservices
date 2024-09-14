<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterAcceptTest extends WebTestCase
{
    public function testRegisterAcceptController(): void
    {
        $client = static::createClient();
        $client->request('GET', '/v1/accept');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['ok' => true]),
            $client->getResponse()->getContent()
        );
    }

}