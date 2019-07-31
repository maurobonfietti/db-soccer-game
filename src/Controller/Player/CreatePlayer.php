<?php declare(strict_types=1);

namespace App\Controller\Player;

use Slim\Http\Request;
use Slim\Http\Response;

class CreatePlayer extends BasePlayer
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $player = $this->getPlayerService()->createPlayer($input);

        return $response->withJson($player, 201);
    }
}
