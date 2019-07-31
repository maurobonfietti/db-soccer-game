<?php declare(strict_types=1);

namespace App\Controller\Match;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteMatch extends BaseMatch
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $match = $this->getMatchService()->deleteMatch((int) $args['id']);

        return $response->withJson($match, 204);
    }
}
