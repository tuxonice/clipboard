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

    public function testCanPostWithMultipleKeys()
    {
        $this->json(
            'POST',
            '/example',
            [
                'data1' => 'Hello World 1',
                'data2' => 'Hello World 2',
            ]
        )->seeJson([
            'data1' => 'Hello World 1',
            'data2' => 'Hello World 2',
        ]);

        $this->get('/json/example')
            ->seeJson([
                'data1' => 'Hello World 1',
                'data2' => 'Hello World 2',
            ]);

    }

    public function testDataIsSanitizeBeforeCached()
    {
        $this->json(
            'POST',
            '/example',
            [
                '<script>' => 'Hello <script> World']
        )->seeJson([
            'script' => 'Hello &lt;script&gt; World',
        ]);

        $this->get('/json/example')
            ->seeJson([
                'script' => 'Hello &lt;script&gt; World',
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

    public function testCanGetRawFormat()
    {
        $this->json('POST', '/example', ['data' => 'Hello World'])
            ->seeJson([
                'data' => 'Hello World',
            ]);

        $expectedResult = <<<END
<html>
<head>
<title></title>
</head>
</html>
<body>
            <h4>data</h4>
        <p>Hello World</p>
        
</body>
</html>

END;
        $this->get('/raw/example');
        $this->assertEquals(
            $this->response->getContent(),
            $expectedResult);

    }
}
