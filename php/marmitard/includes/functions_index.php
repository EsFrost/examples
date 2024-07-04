<?php

require_once './db/db.php';

function getRecipeList() {

    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM recettes");
    try {
        $stmt -> execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }
    $recettes = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $recettes[] = $row;
    }

    return $recettes;
}