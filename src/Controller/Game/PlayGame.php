<?php declare(strict_types=1);

namespace App\Controller\Game;

use Slim\Http\Request;
use Slim\Http\Response;

class PlayGame extends BaseGame
{
    public function __invoke(Request $request, Response $response): Response
    {
        $game = $this->getGameService()->playGame();

        return $response->withJson($game, 200);
    }
}
