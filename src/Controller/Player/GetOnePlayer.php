<?php declare(strict_types=1);

namespace App\Controller\Player;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOnePlayer extends BasePlayer
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $player = $this->getPlayerService()->getPlayer((int) $args['id']);

        return $response->withJson($player, 200);
    }
}
