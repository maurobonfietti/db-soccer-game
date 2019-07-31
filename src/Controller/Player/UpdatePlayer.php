<?php declare(strict_types=1);

namespace App\Controller\Player;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdatePlayer extends BasePlayer
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $player = $this->getPlayerService()->updatePlayer($input, (int) $args['id']);

        return $response->withJson($player, 200);
    }
}
