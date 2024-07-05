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