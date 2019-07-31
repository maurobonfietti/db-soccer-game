<?php declare(strict_types=1);

$app->get('/', 'App\Controller\Base\DefaultController:getHelp');
$app->get('/status', 'App\Controller\Base\DefaultController:getStatus');

$app->group('/api/v1', function () use ($app) {
    $app->group('/player', function () use ($app) {
        $app->get('', 'App\Controller\Player\GetAllPlayers');
        $app->get('/[{id}]', 'App\Controller\Player\GetOnePlayer');
        $app->get('/search/[{query}]', 'App\Controller\Player\SearchPlayers');
        $app->post('', 'App\Controller\Player\CreatePlayer');
        $app->put('/[{id}]', 'App\Controller\Player\UpdatePlayer');
        $app->delete('/[{id}]', 'App\Controller\Player\DeletePlayer');
    });
    $app->group('/match', function () use ($app) {
        $app->get('', 'App\Controller\Match\GetAllMatches');
        $app->get('/[{id}]', 'App\Controller\Match\GetOneMatch');
        $app->post('', 'App\Controller\Match\CreateMatch');
        $app->put('/[{id}]', 'App\Controller\Match\UpdateMatch');
        $app->delete('/[{id}]', 'App\Controller\Match\DeleteMatch');
    });
    $app->group('/game', function () use ($app) {
        $app->get('/position', 'App\Controller\Game\GetPositions');
        $app->post('/play', 'App\Controller\Game\PlayGame');
    });
});
