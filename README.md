# DB SOCCER GAME

Database Soccer Players Mini Game :-)

* Given a list of soccer players, randomly choose 2 teams of 5 players.
* Simulate the result of the match.
* The players who won the match add 3 points.
* Losing players do not add points.
* In case of a tie, all the players who participated add 1 point.
* For each game, the API update and show the table of positions, with the points and stats of each player.


## PLAY GAME ;-)

Request To Play New Game: `POST /api/v1/game/play`

Response:

```javascript
{
    "id": 18,
    "result": "team1 won!",
    "teams": {
        "team1": [
            "Luis Suarez",
            "Paulo Dybala",
            "Dani Alves",
            "Carlos Tevez",
            "Cristiano Ronaldo"
        ],
        "team2": [
            "James Rodriguez",
            "Luka Modrić",
            "Frenkie de Jong",
            "Antoine Griezmann",
            "Matthijs de Ligt"
        ]
    },
    "positions": [
        {
            "position": "#1",
            "player": "Luis Suarez",
            "points": 28,
            "stats": {
                "played": 16,
                "won": 7,
                "drawn": 7,
                "lost": 2
            }
        },
        {
            "position": "#2",
            "player": "Lionel Messi",
            "points": 22,
            "stats": {
                "played": 15,
                "won": 5,
                "drawn": 7,
                "lost": 3
            }
        },
        {
            "position": "#3",
            "player": "Frenkie de Jong",
            "points": 21,
            "stats": {
                "played": 14,
                "won": 5,
                "drawn": 6,
                "lost": 3
            }
        },
        {
            "position": "#4",
            "player": "James Rodriguez",
            "points": 19,
            "stats": {
                "played": 15,
                "won": 4,
                "drawn": 7,
                "lost": 4
            }
        },
        {
            "position": "#5",
            "player": "Antoine Griezmann",
            "points": 18,
            "stats": {
                "played": 13,
                "won": 4,
                "drawn": 6,
                "lost": 3
            }
        },
        {
            "position": "#6",
            "player": "Cristiano Ronaldo",
            "points": 17,
            "stats": {
                "played": 11,
                "won": 4,
                "drawn": 5,
                "lost": 2
            }
        },
        {
            "position": "#7",
            "player": "Neymar",
            "points": 16,
            "stats": {
                "played": 9,
                "won": 4,
                "drawn": 4,
                "lost": 1
            }
        },
        {
            "position": "#8",
            "player": "Dani Alves",
            "points": 15,
            "stats": {
                "played": 13,
                "won": 3,
                "drawn": 6,
                "lost": 4
            }
        },
        {
            "position": "#9",
            "player": "Paulo Dybala",
            "points": 15,
            "stats": {
                "played": 15,
                "won": 3,
                "drawn": 6,
                "lost": 6
            }
        },
        {
            "position": "#10",
            "player": "Carlos Tevez",
            "points": 14,
            "stats": {
                "played": 13,
                "won": 3,
                "drawn": 5,
                "lost": 5
            }
        },
        {
            "position": "#11",
            "player": "Matthijs de Ligt",
            "points": 12,
            "stats": {
                "played": 14,
                "won": 2,
                "drawn": 6,
                "lost": 6
            }
        },
        {
            "position": "#12",
            "player": "Luka Modrić",
            "points": 8,
            "stats": {
                "played": 12,
                "won": 1,
                "drawn": 5,
                "lost": 6
            }
        }
    ]
}
```


## QUICK INSTALL:

### Pre Requisite:

- Git.
- Composer.
- PHP.
- MySQL/MariaDB.

### Run commands:

In your terminal execute this commands:

```bash
$ git clone https://github.com/maurobonfietti/db-soccer-game.git && cd db-soccer-game
$ cp .env.example .env
$ composer install
$ composer database
$ composer start
```


## USING DOCKER:

If you prefer, you can use this project with **docker** and **docker-compose**.


### MINIMAL DOCKER VERSION:

* Engine: 18.03+
* Compose: 1.21+


Docker Commands:

```bash
# Create and start containers for the API.
$ docker-compose up -d --build

# Execute script to create the database and import test data from scratch.
$ ./bin/docker/restart-db.sh

# Checkout the API.
$ curl http://localhost:8081

# Stop and remove containers.
$ docker-compose down
```


## DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.


## DOCUMENTATION:

### ENDPOINTS LIST:

- Help: `GET /`

- Status: `GET /status`

#### PLAYERS:

- Get All Players: `GET /api/v1/player`

- Get One Player: `GET /api/v1/player/{id}`

- Search Players: `GET /api/v1/player/search/{name}`

- Create Player: `POST /api/v1/player`

- Update Player: `PUT /api/v1/player/{id}`

- Delete Player: `DELETE /api/v1/player/{id}`

#### MATCHES:

- Get All Matches: `GET /api/v1/match`

- Get One Match: `GET /api/v1/match/{id}`

- Create Match: `POST /api/v1/match`

- Update Match: `PUT /api/v1/match/{id}`

- Delete Match: `DELETE /api/v1/match/{id}`

#### GAME:

- Play Game: `POST /api/v1/game/play`

- Get Positions: `GET /api/v1/game/position`
