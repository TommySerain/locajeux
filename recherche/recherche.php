<?php

$joinRequest=[];
$whereRequest=[];
if(count($_GET)!==0){
    $type=$_GET['type'];
    $cat=$_GET['categories'];
    $name=$_GET['nom'];

    if(!empty($type)){
        $joinRequest[]="NATURAL JOIN types";
        $whereRequest[]="name_t='$type'";
    }
    if(!empty($cat)){
        $joinRequest[]="NATURAL JOIN categories";
        $whereRequest[]="name_c='$cat'";
    }
    if(!empty($name)){
        $whereRequest[]="name_j LIKE '%$name%'";
    }
    $where=implode(' AND ', $whereRequest);
    $join=implode(' ', $joinRequest);
    var_dump($whereRequest);
    $request="SELECT * FROM jeux $join WHERE $where;";
    var_dump($request);
    $stmt=$pdo->query($request);
}

/*
else{
    $stmt= $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE name_t=:types AND name_c=:cat AND name_j LIKE :nom ;");
    $stmt->execute([
        'types'=>$type,
        'cat'=>$cat,
        'nom'=>'%'.$name.'%',
    ]);
}
*/
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