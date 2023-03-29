<?php

session_start();
require_once __DIR__ . '/fonctions/fonctions.php';

if (!isset($_SESSION['connected'])) {
    redirect('index.php');
};

redirectDeconnexion($_SESSION);

require_once __DIR__ . "/layout/header.php";

?>
<h1 class="text-center m-5 text-white">Vous êtes déconnecté</h1>
<?php

require_once __DIR__ . "/layout/footer.php";
