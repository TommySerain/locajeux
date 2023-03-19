<?php
require_once __DIR__."/layout/header.php";
require_once __DIR__."/connexion/modal.php";
?>
<h1 class="text-center m-5">Vous êtes déconnecté</h1>
<?php
header ("Refresh: 1; URL=index.php");
require_once __DIR__."/layout/footer.php";