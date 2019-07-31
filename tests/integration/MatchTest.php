<?php declare(strict_types=1);

namespace Tests\integration;

class MatchTest extends BaseTestCase
{
    private static $id;

    public function testCreateMatch()
    {
        $response = $this->runApp(
            'POST', '/api/v1/match',
            ['match' => '{"result":"team2 won!","team1":[{"id":15,"name":"Sergio Busquets"},{"id":14,"name":"Virgil van Dijk"},{"id":4,"name":"Lionel Messi"},{"id":7,"name":"Luis Suarez"},{"id":8,"name":"Antoine Griezmann"}],"team2":[{"id":10,"name":"Neymar"},{"id":9,"name":"James Rodriguez"},{"id":3,"name":"Paulo Dybala"},{"id":1,"name":"Mauro Bonfietti"},{"id":2,"name":"Carlos Tevez"}]}']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('match', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testCreateMatchError()
    {
        $response = $this->runApp('POST', '/api/v1/match', ['m' => 'b']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testGetMatchs()
    {
        $response = $this->runApp('GET', '/api/v1/match');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('match', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMatch()
    {
        $response = $this->runApp('GET', '/api/v1/match/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('match', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMatchNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/match/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateMatch()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/match/' . self::$id, ['match' => '{}']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('match', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testUpdateMatchError()
    {
        $response = $this->runApp('PUT', '/api/v1/match/' . self::$id, ['m' => 'b']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testDeleteMatch()
    {
        $response = $this->runApp('DELETE', '/api/v1/match/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
