<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\PlayerException;

abstract class BaseService
{
    protected static function validatePlayerName(string $name): string
    {
        $nameLength = strlen($name);
        if ($nameLength < 1 || $nameLength > 100) {
            throw new PlayerException('Invalid name.', 400);
        }

        return $name;
    }
}
