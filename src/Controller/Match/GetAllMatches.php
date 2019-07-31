<?php declare(strict_types=1);

namespace App\Controller\Match;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllMatches extends BaseMatch
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matchs = $this->getMatchService()->getMatches();

        return $response->withJson($matchs, 200);
    }
}
