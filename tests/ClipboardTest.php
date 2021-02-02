<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ClipboardTest extends TestCase
{
    
    public function testCanPostValue()
    {
        $this->json('POST', '/example', ['data' => 'Hello World'])
             ->seeJson([
                'data' => 'Hello World',
             ]);

        $this->get('/json/example')
        ->seeJson([
        'data' => 'Hello World',
        ]);

    }

    public function testCanGetXmlFormat()
    {
        $this->json('POST', '/example', ['data' => 'Hello World'])
             ->seeJson([
                'data' => 'Hello World',
             ]);

        $response = $this->get('/xml/example');
        $this->assertXmlStringEqualsXmlString(
            $this->response->getContent(), 
            '<root><data>Hello World</data></root>'
        );

    }

    
}
