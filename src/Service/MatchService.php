<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\MatchException;
use App\Repository\MatchRepository;

class MatchService extends BaseService
{
    protected $matchRepository;

    public function __construct(MatchRepository $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    protected function checkAndGetMatch(int $matchId)
    {
        return $this->matchRepository->checkAndGetMatch($matchId);
    }

    public function getMatches(): array
    {
        return $this->matchRepository->getMatches();
    }

    public function getMatch(int $matchId)
    {
        return $this->checkAndGetMatch($matchId);
    }

    public function createMatch($input)
    {
        $match = json_decode(json_encode($input), false);
        if (!isset($match->match)) {
            throw new MatchException('The field: match, is required.', 400);
        }

        return $this->matchRepository->createMatch($match);
    }

    public function updateMatch(array $input, int $matchId)
    {
        $match = $this->checkAndGetMatch($matchId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->match)) {
            throw new MatchException('The field: match, is required.', 400);
        }
        $match->match = $data->match;

        return $this->matchRepository->updateMatch($match);
    }

    public function deleteMatch(int $matchId): string
    {
        $this->checkAndGetMatch($matchId);

        return $this->matchRepository->deleteMatch($matchId);
    }
}
