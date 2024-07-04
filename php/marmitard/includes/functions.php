<?php

require_once '../db/db.php';

function getCategoryList() {

    global $pdo;

    $categories = array();

    $stmt = $pdo->prepare("SELECT id, nom FROM categories");
    try {
        $stmt -> execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categories[] = $row;
    }

    return $categories;
}

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

function getSingleRecipe($id) {

    global $pdo;
    
    $data = '';

    $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
    $stmt -> bindParam(':id', $id);

    $stmt2 = $pdo->prepare("SELECT c.nom FROM recettes r JOIN categories c ON r.id_category = c.id WHERE r.id = :id");
    $stmt2 -> bindParam(':id', $id);
    try {
        $stmt->execute();
        $stmt2->execute();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }

    $data = $stmt->fetch();
    $categories = array();

    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $categories[] = $row;
    }

    $res['data'] = $data;
    $res['categories'] = $categories;

    return $res;
}