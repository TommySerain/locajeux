<?php


class search
{
    private string $type;
    private string $cat;
    private string $name;

    public function __construct($type, $cat, $name)
    {

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
        require_once __DIR__ . "/../pdo/db.php";
        $where = implode(' AND ', $whereRequest);
        $join = implode(' ', $joinRequest);
        $request = "SELECT * FROM jeux $join WHERE $where;";
        $stmt = $pdo->prepare($request);
        $stmt->execute(
            $executeRequest
        );
    }
}

/*
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
*/