<?php
require_once __DIR__."/classes/GamesDbFromFile.php";
require_once __DIR__."/layout/header.php";
require_once __DIR__."/pdo/db.php";
require_once __DIR__."/data/fileToDb.php";






// $games=$stmt->fetch();
// var_dump($stmt->fetch());

?>
<section class="container-fluid">
<div class="row">
<?php
while ($game = $stmt->fetch()){?>
    <div class="col-3 p-0">
        <div class="border border-2 border-danger m-4">
            <img class="imgJeux w-100 m-0" src="<?php echo $game['img_j'] ;?>" alt="">
        </div>
    </div>
<?php
}
?>
</div>
</section>
<?php


require_once __DIR__."/layout/footer.php";

