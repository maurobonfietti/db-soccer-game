<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\PlayerException;

class PlayerRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetPlayer(int $playerId)
    {
        $query = 'SELECT `id`, `name`, `won`, `lost`, `drawn` FROM `player` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
        $player = $statement->fetchObject();
        if (empty($player)) {
            throw new PlayerException('Player not found.', 404);
        }

        return $player;
    }

    public function getPlayers(): array
    {
        $query = 'SELECT `id`, `name`, `won`, `lost`, `drawn` FROM `player` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function searchPlayers(string $playersName): array
    {
        $query = 'SELECT `id`, `name`, `won`, `lost`, `drawn` FROM `player` WHERE name LIKE :name ORDER BY `id`';
        $name = '%' . $playersName . '%';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $name);
        $statement->execute();
        $players = $statement->fetchAll();
        if (!$players) {
            throw new PlayerException('Player not found.', 404);
        }

        return $players;
    }

    public function createPlayer($player)
    {
        $query = 'INSERT INTO `player` (`name`) VALUES (:name)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $player->name);
        $statement->execute();

        return $this->checkAndGetPlayer((int) $this->database->lastInsertId());
    }

    public function updatePlayer($player)
    {
        $query = 'UPDATE `player` SET `name` = :name WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $player->id);
        $statement->bindParam('name', $player->name);
        $statement->execute();

        return $this->checkAndGetPlayer((int) $player->id);
    }

    public function deletePlayer(int $playerId): string
    {
        $query = 'DELETE FROM `player` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();

        return 'The player was deleted.';
    }

    public function updatePlayerWon($playerId)
    {
        $query = 'UPDATE `player` SET won = won + 1 WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
    }

    public function updatePlayerLost($playerId)
    {
        $query = 'UPDATE `player` SET lost = lost + 1 WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
    }

    public function updatePlayerTied($playerId)
    {
        $query = 'UPDATE `player` SET drawn = drawn + 1 WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
    }
}
