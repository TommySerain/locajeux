<?php

$joinRequest = [];
$whereRequest = [];
$executeRequest = [];
if (!empty($_GET) && ($_GET['type'] !== "" || $_GET['categories'] !== "" || $_GET['nom'] !== "")) {
    // $results = search($_GET);

    $type = $_GET['type'];
    $cat = $_GET['categories'];
    $name = $_GET['nom'];

    // $results = search();

    if (!empty($type)) {
        $joinRequest[] = "NATURAL JOIN types";
        $whereRequest[] = "name_t=:type";
        $executeRequest['type'] = $type;
    }
    if (!empty($cat)) {
        $joinRequest[] = "NATURAL JOIN categories";
        $whereRequest[] = "name_c=:cat";
        $executeRequest['cat'] = $cat;
    }
    if (!empty($name)) {
        $whereRequest[] = "name_j LIKE :nom";
        $executeRequest['nom'] = '%' . $name . '%';
    }
    $where = implode(' AND ', $whereRequest);
    $join = implode(' ', $joinRequest);

    // var_dump($executeRequest);
    // var_dump($exe);
    $request = "SELECT * FROM jeux $join WHERE $where;";
    // var_dump($request);
    $stmt = $pdo->prepare($request);
    $stmt->execute(
        $executeRequest
    );
}

while ($game = $stmt->fetch()) {
?>
    <div class="col-3 p-0">
        <div class="rounded-4 m-4 jeux">
            <a href="fichejeux.php?id=<?php echo $game['id_j']; ?>">
                <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4  jeux" src="<?php echo $game['img_j']; ?>" alt="">
            </a>
        </div>
    </div>
<?php
}
