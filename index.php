<?php
require_once __DIR__ . "/classes/GamesDbFromFile.php";
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/data/fileToDb.php";
require_once __DIR__ . "/connexion/modal.php";
require_once __DIR__ . "/connexion/connexion.php";


?>
<section class="container mx-auto pb-4 rounded-5 w-50 mt-3 bg-danger" id="recherche">
    <form class="d-flex mx-auto justify-content-center" action="">
        <select class="form-control w-auto m-4 mb-0" name="type" id="">
            <option value="">Type &nbsp &nbsp ⬇️</option>
            <?php
            $statement = $pdo->query('SELECT * FROM types');
            while ($option = $statement->fetch()) {
            ?>
                <option value="<?php echo $option['name_t']; ?>"><?php echo $option['name_t']; ?></option>
            <?php
            }
            ?>
        </select>
        <select class="form-control w-auto m-4 mb-0" name="categories" id="">
            <option value="">Catégorie ⬇️</option>
            <?php
            $statement = $pdo->query('SELECT * FROM categories');
            while ($option = $statement->fetch()) {
            ?>
                <option value="<?php echo $option['name_c']; ?>"><?php echo $option['name_c']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="text" class="form-control w-auto m-4 mb-0" name="nom" id="">
        <input type="submit" class=" w-auto mt-4 mb-0 bg-danger border-0 fs-3" value="🔍">
    </form>
</section>

<section class="container">
    <div class="row">
        <?php
        require_once __DIR__ . "/recherche/recherche.php";
        ?>
    </div>
</section>

<?php


require_once __DIR__ . "/layout/footer.php";
