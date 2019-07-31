<?php declare(strict_types=1);

namespace App\Controller\Player;

use Slim\Http\Request;
use Slim\Http\Response;

class SearchPlayers extends BasePlayer
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $players = $this->getPlayerService()->searchPlayers($args['query']);

        return $response->withJson($players, 200);
    }
}
