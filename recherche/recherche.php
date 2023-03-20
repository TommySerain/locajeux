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
            <a href="fichejeux.php?id=<?php echo $game['id_j'];?>">
                <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4  jeux" src="<?php echo $game['img_j'] ;?>" alt="">
            </a>
            </div>
        </div>
    <?php
    }
}else if (empty($_GET['type']) && empty($_GET['categories'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux WHERE name_j LIKE :nom ;");
    $stmt->execute([
        'nom'=>'%'.$name.'%',
    ]);
}else if (empty($_GET['type']) && empty($_GET['nom'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN categories WHERE name_c = :cat ;");
    $stmt->execute([
        'cat'=>$cat,
    ]);
}else if (empty($_GET['categories']) && empty($_GET['nom'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types WHERE name_t = :types ;");
    $stmt->execute([
        'types'=>$type,
    ]);
}else if (empty($_GET['type'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN categories WHERE name_c = :cat AND name_j LIKE :nom ;");
    $stmt->execute([
        'cat'=>$cat,
        'nom'=>'%'.$name.'%',
    ]);
}else if (empty($_GET['categories'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types WHERE name_t = :types AND name_j LIKE :nom ;");
    $stmt->execute([
        'types'=>$type,
        'nom'=>'%'.$name.'%',
    ]);
}else if (empty($_GET['nom'])){
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE name_t = :types AND name_c = :cat ;");
    $stmt->execute([
        'types'=>$type,
        'cat'=>$cat,
    ]);
}else{
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE name_t=:types AND name_c=:cat AND name_j LIKE :nom ;");
    $stmt->execute([
        'types'=>$type,
        'cat'=>$cat,
        'nom'=>'%'.$name.'%',
    ]);
}

    while ($game = $stmt->fetch()){
        ?>
        <div class="col-3 p-0">
            <div class="rounded-4 m-4 jeux">
                <a href="fichejeux.php?id=<?php echo $game['id_j'];?>">
                    <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4  jeux" src="<?php echo $game['img_j'] ;?>" alt="">
                </a>
            </div>
        </div>
    <?php
    }