<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\PlayerException;
use App\Repository\PlayerRepository;

class PlayerService extends BaseService
{
    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    protected function checkAndGetPlayer(int $playerId)
    {
        return $this->playerRepository->checkAndGetPlayer($playerId);
    }

    public function getPlayers(): array
    {
        return $this->playerRepository->getPlayers();
    }

    public function getPlayer(int $playerId)
    {
        return $this->checkAndGetPlayer($playerId);
    }

    public function searchPlayers(string $playersName): array
    {
        return $this->playerRepository->searchPlayers($playersName);
    }

    public function createPlayer($input)
    {
        $player = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new PlayerException('The field: name, is required.', 400);
        }
        $player->name = self::validatePlayerName($data->name);

        return $this->playerRepository->createPlayer($player);
    }

    public function updatePlayer(array $input, int $playerId)
    {
        $player = $this->checkAndGetPlayer($playerId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new PlayerException('The field: name, is required.', 400);
        }
        if (isset($data->name)) {
            $player->name = self::validatePlayerName($data->name);
        }

        return $this->playerRepository->updatePlayer($player);
    }

    public function deletePlayer(int $playerId): string
    {
        $this->checkAndGetPlayer($playerId);

        return $this->playerRepository->deletePlayer($playerId);
    }

    public function updatePlayerWon(int $playerId)
    {
        return $this->playerRepository->updatePlayerWon($playerId);
    }

    public function updatePlayerLost(int $playerId)
    {
        return $this->playerRepository->updatePlayerLost($playerId);
    }

    public function updatePlayerTied(int $playerId)
    {
        return $this->playerRepository->updatePlayerTied($playerId);
    }
}
