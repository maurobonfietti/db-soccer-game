<?php declare(strict_types=1);

namespace App\Service;

use App\Service\PlayerService;
use App\Service\MatchService;

class GameService extends BaseService
{
    protected $playersService;

    protected $matchesService;

    public function __construct(PlayerService $playersService, MatchService $matchesService)
    {
        $this->playersService = $playersService;
        $this->matchesService = $matchesService;
    }

    public function playGame(): object
    {
        $players = $this->playersService->getPlayers();
        $teams = $this->getAndSelectPlayers($players);
        $myteam1 = $teams[0];
        $myteam2 = $teams[1];
        $winner = random_int(1, 3);
        $result = $this->updateMatchStats($winner, $myteam1, $myteam2);
        $matchInfo = [
            'result' => $result,
            'team1' => $myteam1,
            'team2' => $myteam2,
        ];
        $input = ['match' => json_encode($matchInfo)];
        $match = $this->matchesService->createMatch($input);
        unset($match->match);
        $match->result = $result;
        $match->teams = new \stdClass();
        $match->teams->team1 = $this->getPlayersByName($myteam1);
        $match->teams->team2 = $this->getPlayersByName($myteam2);
        $match->positions = $this->getPositions();

        return $match;
    }

    private function getPlayersById($players)
    {
        $data = [];
        foreach ($players as $player) {
            $data[] = $player['id'];
        }

        return $data;
    }

    private function getPlayersByName($players)
    {
        $data = [];
        foreach ($players as $player) {
            $data[] = $player['name'];
        }

        return $data;
    }

    private function updateMatchStats($winner, $myteam1, $myteam2)
    {
        $matchResult = '';
        $team1PlayersByIds = $this->getPlayersById($myteam1);
        $team2PlayersByIds = $this->getPlayersById($myteam2);
        if ($winner === 1) {
            foreach ($team1PlayersByIds as $player) {
                $this->playersService->updatePlayerWon($player);
            }
            foreach ($team2PlayersByIds as $player) {
                $this->playersService->updatePlayerLost($player);
            }
            $matchResult = 'team1 won!';
        }
        if ($winner === 2) {
            foreach ($team1PlayersByIds as $player) {
                $this->playersService->updatePlayerLost($player);
            }
            foreach ($team2PlayersByIds as $player) {
                $this->playersService->updatePlayerWon($player);
            }
            $matchResult = 'team2 won!';
        }
        if ($winner === 3) {
            foreach ($team1PlayersByIds as $player) {
                $this->playersService->updatePlayerTied($player);
            }
            foreach ($team2PlayersByIds as $player) {
                $this->playersService->updatePlayerTied($player);
            }
            $matchResult = 'teams tied!';
        }

        return $matchResult;
    }

    public function getPositions()
    {
        $scoreboard = [];
        $positions = [];
        $allPlayers = $this->playersService->getPlayers();
        foreach ($allPlayers as $player) {
            $scoreboard[] = [
                'player' => $player['name'],
                'points' => $player['won'] * 3 + $player['drawn'],
                'stats' => [
                    'played' => $player['won'] + $player['lost'] + $player['drawn'],
                    'won' => $player['won'],
                    'drawn' => $player['drawn'],
                    'lost' => $player['lost'],
                ],
            ];
        }
        array_multisort(array_column($scoreboard, 'points'), SORT_DESC, $scoreboard);
        foreach ($scoreboard as $key => $player) {
            $positions[] = [
                'position' => '#' . ++$key,
                'player' => $player['player'],
                'points' => $player['points'],
                'stats' => $player['stats'],
            ];
        }

        return $positions;
    }

    private function getAndSelectPlayers($players)
    {
        shuffle($players);
        $team1 = [];
        $team2 = [];
        for ($i = 0; $i < 5; $i++) {
            $team1[] = [
                'id' => $players[$i]['id'],
                'name' => $players[$i]['name'],
            ];
        }
        for ($i = 5; $i < 10; $i++) {
            $team2[] = [
                'id' => $players[$i]['id'],
                'name' => $players[$i]['name'],
            ];
        }

        return [$team1, $team2];
    }
}
