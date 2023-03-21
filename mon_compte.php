<?php
require_once __DIR__."/layout/header.php";
?>
<h1>Mon compte LocaJeux</h1>
<h2>Mes infos</h2>

<h3>Nom : <?php echo $_SESSION['name'];?></h3>


<?php
require_once __DIR__."/layout/footer.php";