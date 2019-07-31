<?php declare(strict_types=1);

namespace App\Controller\Game;

use App\Service\GameService;
use Slim\Container;

abstract class BaseGame
{
    protected $container;

    protected $gameService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getGameService(): GameService
    {
        return $this->container->get('game_service');
    }
}
