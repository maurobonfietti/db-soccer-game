<?php declare(strict_types=1);

use App\Repository\PlayerRepository;
use App\Repository\MatchRepository;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['player_repository'] = function (ContainerInterface $container): PlayerRepository {
    return new PlayerRepository($container->get('db'));
};

$container['match_repository'] = function (ContainerInterface $container): MatchRepository {
    return new MatchRepository($container->get('db'));
};
