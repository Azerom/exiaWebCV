<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpKernel\Client;

class testTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $client = new Client();
        $crawler = $this->request('GET', '/test');

        $this->assertTrue($this->client->getResponse()->isOk());

        $this->assertCount(1, $crawler->filter('h1:contains("Hello World!")'));
    }
}
