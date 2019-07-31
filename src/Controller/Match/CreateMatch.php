<?php declare(strict_types=1);

namespace App\Controller\Match;

use Slim\Http\Request;
use Slim\Http\Response;

class CreateMatch extends BaseMatch
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $match = $this->getMatchService()->createMatch($input);

        return $response->withJson($match, 201);
    }
}
