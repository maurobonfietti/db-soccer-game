<?php declare(strict_types=1);

namespace Tests\integration;

class PlayerTest extends BaseTestCase
{
    private static $id;

    public function testGetPlayers()
    {
        $response = $this->runApp('GET', '/api/v1/player');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPlayer()
    {
        $response = $this->runApp('GET', '/api/v1/player/8');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPlayerNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/player/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringContainsString('error', $result);
    }

    public function testSearchPlayers()
    {
        $response = $this->runApp('GET', '/api/v1/player/search/j');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testSearchPlayerNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/player/search/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    public function testCreatePlayer()
    {
        $response = $this->runApp(
            'POST', '/api/v1/player',
            ['name' => 'Juan Futbol']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testCreatePlayerWithoutName()
    {
        $response = $this->runApp('POST', '/api/v1/player');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testCreatePlayerWithInvalidName()
    {
        $response = $this->runApp('POST', '/api/v1/player', ['name' => '']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdatePlayer()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/player/' . self::$id, ['name' => 'New Player']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testUpdatePlayerWithOutData()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/player/' . self::$id, ['a' => 'b']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testDeletePlayer()
    {
        $response = $this->runApp('DELETE', '/api/v1/player/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeletePlayerNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/player/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }
}
