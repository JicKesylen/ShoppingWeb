<?php

$Env = $EnvKeys = [];
$EnvFile = file_get_contents(dirname(__DIR__) . '/.env');

preg_match_all('/^(?!#).+?(?=\=)/m', $EnvFile, $EnvKeys);

foreach ($EnvKeys[0] as $key) {
    $Env[$key] = env($key);
}

return $Env;
