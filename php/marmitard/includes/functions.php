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

function isImageUrlValid($url) {
    // Use get_headers to fetch headers
    $headers = @get_headers($url);
    
    // Check if headers are fetched and if status code is 200
    if ($headers && strpos($headers[0], '200') !== false) {
        // Additional check for image content-type
        foreach ($headers as $header) {
            if (strpos(strtolower($header), 'content-type: image') !== false) {
                return true;
            }
        }
    }
    
    return false;
}

function getComments($id) {

    global $pdo;

    $data = '';

    $stmt = $pdo->prepare("SELECT c.commentaires, u.prenom FROM commentaires c JOIN recettes r ON c.id_recette = r.id JOIN users u ON u.id = c.id_user WHERE r.id = :id");
    $stmt -> bindParam(':id', $id);
    try {
        $stmt -> execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $comments[] = $row;
    }

    if  (!empty($comments)) {
        return $comments;
    }
    else {
        return;
    }
    
}

/* this doesn't work yet, fix it */
/*
function getNotes($id) {

    global $pdo;

    $data = '';

    $stmt = $pdo->prepare("SELECT c.commentaires, u.prenom FROM commentaires c JOIN recettes r ON c.id_recette = r.id JOIN users u ON u.id = c.id_user WHERE r.id = :id");
    $stmt -> bindParam(':id', $id);
    try {
        $stmt -> execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $comments[] = $row;
    }

    return $comments;
}
*/