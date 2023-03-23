<section class="container mx-auto p-2 pb-3 rounded-5  w-50 mt-3 " id="recherche">
    <form class="d-flex mx-auto justify-content-center" action="" method="GET">
        <select class="form-control w-auto m-2 mb-0" name="type" id="">
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
        <select class="form-control w-auto m-2 mb-0" name="categories" id="">
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
        <input type="text" class="form-control w-auto m-2 mb-0" name="nom" id="">
        <input type="submit" class=" w-auto mt-2 mb-0 bg-dark border-0 fs-3" value="🔍">
    </form>
</section>