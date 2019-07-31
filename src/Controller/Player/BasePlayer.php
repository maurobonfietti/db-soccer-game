<?php declare(strict_types=1);

namespace App\Controller\Player;

use App\Service\PlayerService;
use Slim\Container;

abstract class BasePlayer
{
    protected $container;

    protected $playerService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getPlayerService(): PlayerService
    {
        return $this->container->get('player_service');
    }
}
