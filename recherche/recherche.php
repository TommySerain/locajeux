<?php

if(count($_GET)!==0){
    $type=$_GET['type'];
    $cat=$_GET['categories'];
    $name=$_GET['nom'];
}


if (empty($_GET)){
    while ($game = $stmt->fetch()){?>
        <div class="col-3 p-0">
            <div class="rounded-4 m-4 jeux">
                <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4  jeux" src="<?php echo $game['img_j'] ;?>" alt="">
            </div>
        </div>
    <?php
    }
}else if (empty($_GET['type']) && empty($_GET['categories'])){
    $stmt= $pdo->query("SELECT * FROM jeux WHERE name_j LIKE '%$name%' ;");
}else if (empty($_GET['type']) && empty($_GET['nom'])){
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN categories WHERE name_c = '$cat' ;");
}else if (empty($_GET['categories']) && empty($_GET['nom'])){
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN types WHERE name_t = '$type' ;");
}else if (empty($_GET['type'])){
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN categories WHERE name_c = '$cat' AND name_j LIKE '%$name%' ;");
}else if (empty($_GET['categories'])){
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN types WHERE name_t = '$type' AND name_j LIKE '%$name%' ;");
}else if (empty($_GET['nom'])){
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE name_t = '$type' AND name_c = '$cat' ;");
}else{
    $stmt= $pdo->query("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE name_t='$type' AND name_c='$cat' AND name_j LIKE '%$name%' ;");
}

    while ($game = $stmt->fetch()){?>
        <div class="col-3 p-0">
            <div class="rounded-4 m-4 jeux">
                <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4  jeux" src="<?php echo $game['img_j'] ;?>" alt="">
            </div>
        </div>
    <?php
    }