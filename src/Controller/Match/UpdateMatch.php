<?php declare(strict_types=1);

namespace App\Controller\Match;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdateMatch extends BaseMatch
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $match = $this->getMatchService()->updateMatch($input, (int) $args['id']);

        return $response->withJson($match, 200);
    }
}
