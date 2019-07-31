<?php declare(strict_types=1);

namespace Tests\integration;

class GameTest extends BaseTestCase
{
    public function testPlayGame()
    {
        $response = $this->runApp('POST', '/api/v1/game/play');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('result', $result);
        $this->assertStringContainsString('teams', $result);
        $this->assertStringContainsString('positions', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPositions()
    {
        $response = $this->runApp('GET', '/api/v1/game/position');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('position', $result);
        $this->assertStringContainsString('player', $result);
        $this->assertStringContainsString('points', $result);
        $this->assertStringContainsString('stats', $result);
        $this->assertStringContainsString('played', $result);
        $this->assertStringContainsString('won', $result);
        $this->assertStringContainsString('drawn', $result);
        $this->assertStringContainsString('lost', $result);
        $this->assertStringNotContainsString('error', $result);
    }
}
