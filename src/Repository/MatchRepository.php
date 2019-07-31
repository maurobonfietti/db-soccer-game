<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\MatchException;

class MatchRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetMatch(int $matchId)
    {
        $query = 'SELECT `id`, `match` FROM `match` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $matchId);
        $statement->execute();
        $match = $statement->fetchObject();
        if (empty($match)) {
            throw new MatchException('Match not found.', 404);
        }

        return $match;
    }

    public function getMatches(): array
    {
        $query = 'SELECT * FROM `match` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createMatch($match)
    {
        $query = 'INSERT INTO `match` (`match`) VALUES (:match)';
        $statement = $this->database->prepare($query);
        $statement->bindParam('match', $match->match);
        $statement->execute();

        return $this->checkAndGetMatch((int) $this->database->lastInsertId());
    }

    public function updateMatch($match)
    {
        $query = 'UPDATE `match` SET `match` = :match WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $match->id);
        $statement->bindParam('match', $match->match);
        $statement->execute();

        return $this->checkAndGetMatch((int) $match->id);
    }

    public function deleteMatch(int $matchId): string
    {
        $query = 'DELETE FROM `match` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $matchId);
        $statement->execute();

        return 'The match was deleted.';
    }
}
