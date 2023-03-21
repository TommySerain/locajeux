<?php

$joinRequest = [];
$whereRequest = [];
$executeRequest = [];
if (!empty($_GET) && (!empty($_GET['type']) || !empty($_GET['categories'])|| !empty($_GET['nom']))) {


    $type = $_GET['type'];
    $cat = $_GET['categories'];
    $name = $_GET['nom'];

    // $results = search($type, $cat, $name);

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
    $request = "SELECT * FROM jeux $join WHERE $where;";
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
