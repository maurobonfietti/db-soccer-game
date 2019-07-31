<?php declare(strict_types=1);

namespace App\Controller\Match;

use App\Service\MatchService;
use Slim\Container;

abstract class BaseMatch
{
    protected $container;

    protected $matchService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getMatchService(): MatchService
    {
        return $this->container->get('match_service');
    }
}
