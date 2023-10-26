<?php
use Ijdb\JokeWebsite;
use Ninja\EntryPoint;

// include_once __DIR__ . '/classes/EntryPoint.php';
// include_once __DIR__ . '/classes/JokeWebsite.php';
include __DIR__ . '/includes/autoload.php';

$uri = strtok(ltrim($_SERVER['REQUEST_URI'], '/'), '?');

$jokeWebsite = new JokeWebsite();
$entryPoint  = new EntryPoint($jokeWebsite);
$entryPoint->run($uri, $_SERVER['REQUEST_METHOD']);
