<?php declare(strict_types=1);

namespace App\Controller\Game;

use Slim\Http\Request;
use Slim\Http\Response;

class GetPositions extends BaseGame
{
    public function __invoke(Request $request, Response $response): Response
    {
        $positions = $this->getGameService()->getPositions();

        return $response->withJson($positions, 200);
    }
}
