<?php

$dbConfig = parse_ini_file(__DIR__."/../config/db.ini");

[
    'DB_HOST' => $host,
    'DB_PORT' => $port,
    'DB_NAME' => $dbName,
    'DB_CHARSET' => $dbCharset,
    'DB_USER' => $user,
    'DB_PASSWORD' => $password
] = $dbConfig;

$dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";  //le port 3306 est celui par défaut donc on n'est pas obligé de le renseigner
try {
    $pdo= new PDO($dsn, "$user", "$password");
} catch (PDOException $e) {
    die('Une erreur est survenue : '. $e->getCode().' - ' . $e->getMessage());
}