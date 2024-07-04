<?php

include_once('../db/db.php');

function receiveSanitize($data) {
    if (isset($data) && !empty($data)) {
        return $data;
    }
    else {
        header("Location: http://localhost/marmitard/views/register.php" );
        exit();
    }
}

$url = '';
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    
    $name = filter_var(receiveSanitize($_POST['nom']), FILTER_SANITIZE_STRING);
    $prenom =filter_var( receiveSanitize($_POST['prenom']), FILTER_SANITIZE_STRING);
    $email = filter_var(receiveSanitize($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(receiveSanitize($_POST['password']), FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $age = filter_var(receiveSanitize($_POST['age']), FILTER_SANITIZE_NUMBER_INT);
    $sexe = filter_var(receiveSanitize($_POST['sexe']), FILTER_SANITIZE_STRING);
    if (!empty($_FILES['profileImage'])) {
        $url = '../public/profile_images/'.$name."_".$prenom."_".date("Y_m_d_h_m_s")."_".htmlspecialchars(basename($_FILES['profileImage']['name']));
        try {
            move_uploaded_file($_FILES['profileImage']['tmp_name'], $url);
            $flag = true;
        }
        catch(Exception $e) {
            echo $e -> getMEssage();
        }
    }

    $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, mdp, age, sexe, profile_image) VALUES (:nom, :prenom, :email, :password, :age, :sexe, :profileImage)");

    $stmt->bindParam(':nom', $name);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':sexe', $sexe);
    $flag === true ? $stmt->bindParam(':profileImage', $url) : $stmt->bindParam(':profileImage', PDO_PARAM_NULL);
    try {
        $stmt->execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }
    
    
    header("Location: http://localhost/marmitard/" );
    exit();
}
else {
    header("Location: http://localhost/marmitard/views/register.php" );
    exit();
}