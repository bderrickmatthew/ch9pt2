<?php
namespace Ijdb;

use PDO;
use Ninja\DatabaseTable;
use Ninja\Website;
use Ijdb\Controllers\Joke;
use Ijdb\controllers\Author;

// DB credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // db username
define('DB_PASS', 'root'); // db password
define('DB_NAME', 'ijdb'); //db name

class JokeWebsite implements Website
{
    public function getDefaultRoute(): string
    {
        return 'joke/home';
    }

    public function getController(string $controllerName): ?object
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

        $jokesTable   = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($controllerName === 'joke')
        {
            $controller = new Joke($jokesTable, $authorsTable);
        }
        else if ($controllerName === 'author')
        {
            $controller = new Author($authorsTable);
        }
        else
        {
            $controller = null;
        }

        return $controller;
    }
}
