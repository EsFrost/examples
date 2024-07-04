<?php

session_start();

include_once('../db/db.php');

function receiveSanitize($data) {
    if (isset($data) && !empty($data)) {
        return $data;
    }
    else {
        $text = "All fields with * are required!";
        header("Location: http://localhost/marmitard/views/add_recipe.php?error=".urlencode($text));
        exit();
    }
}

$url = '';
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_recipe'])) {
        $name = filter_var(receiveSanitize($_POST['nom']), FILTER_SANITIZE_STRING);
        $ingerdients = filter_var(receiveSanitize($_POST['ingredients']), FILTER_SANITIZE_STRING);
        $description = filter_var(receiveSanitize($_POST['description']), FILTER_SANITIZE_STRING);
        $category = filter_var(receiveSanitize($_POST['category']), FILTER_SANITIZE_NUMBER_INT);
        if (!empty($_FILES['recipeImage'])) {
            $url = '../public/profile_images/'.$name."_".$category."_".date("Y_m_d_h_m_s")."_".htmlspecialchars(basename($_FILES['recipeImage']['name']));
            try {
                move_uploaded_file($_FILES['recipeImage']['tmp_name'], $url);
                $flag = true;
            }
            catch(Exception $e) {
                echo $e -> getMEssage();
            }
        }

        $id = (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] : null;

        $stmt = $pdo->prepare("INSERT INTO recettes (nom, liste_ingredients, description, photos, id_user, id_category) VALUES (:nom, :liste_ingredients, :description, :photos, :id_user, :id_category)");

        $stmt->bindParam(':nom', $name);
        $stmt->bindParam(':liste_ingredients', $ingerdients);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_user', $id);
        $stmt->bindParam(':id_category', $category);
        $flag === true ? $stmt->bindParam(':photos', $url) : $stmt->bindParam(':photos', PDO_PARAM_NULL);
        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            echo $e -> getMEssage();
        }
        
        $text = "Recipe added succesfully";
        header("Location: http://localhost/marmitard/views/add_recipe.php?msg=".$text);
        exit();
        }
}
else {
    header("Location: http://localhost/marmitard" );
    exit();
}