<?php declare(strict_types=1);

use App\Service\PlayerService;
use App\Service\MatchService;
use App\Service\GameService;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['player_service'] = function (ContainerInterface $container): PlayerService {
    return new PlayerService($container->get('player_repository'));
};

$container['match_service'] = function (ContainerInterface $container): MatchService {
    return new MatchService($container->get('match_repository'));
};

$container['game_service'] = function (ContainerInterface $container): GameService {
    return new GameService(
        $container->get('player_service'),
        $container->get('match_service')
    );
};
