<?php declare(strict_types=1);

namespace App\Controller\Player;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllPlayers extends BasePlayer
{
    public function __invoke(Request $request, Response $response): Response
    {
        $players = $this->getPlayerService()->getPlayers();

        return $response->withJson($players, 200);
    }
}
