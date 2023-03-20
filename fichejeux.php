<?php
require_once __DIR__."/layout/header.php";
require_once __DIR__."/pdo/db.php";

$stmt=$pdo->query('SELECT * FROM jeux');







require_once __DIR__."/layout/footer.php";