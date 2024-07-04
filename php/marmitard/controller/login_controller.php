<?php

session_start();

include_once('../db/db.php');

function receiveSanitize($data) {
    if (isset($data) && !empty($data)) {
        return $data;
    }
    else {
        $text = "All fields are required!";
        header("Location: http://localhost/marmitard/views/login.php?error=".urlencode($text));
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $email = filter_var(receiveSanitize($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(receiveSanitize($_POST['password']), FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt -> bindParam(':email', $email);
    try {
        $stmt -> execute();
    }
    catch (Exception $e) {
        echo $e -> getMEssage();
    }

    $data = $stmt -> fetch();

    if (!empty($data)){
        if (password_verify($password, $data['mdp'])) {
            $_SESSION = [
                'id_user'       => $data['id'],
                'name_user'     => $data['nom'],
                'prenom_user'   => $data['prenom'],
                'email_user'    => $data['email'],
                'sexe_user'     => $data['sexe'],
                'age_user'      => $data['age'],
                'photo_user'    => $data['profile_image'],
                'status_user'   => $data['status'],
                'logged_in'     => true
            ];

            header("Location: http://localhost/marmitard/");
            exit();
        }
        else {
            $text = "The password does not match!";
            header("Location: http://localhost/marmitard/views/login.php?error=".$text );
            exit();
        }
    }
    else {
        $text = "The email you provided does not exist!";
        header("Location: http://localhost/marmitard/views/login.php?error=".$text );
        exit();
    }
    
}
else {
    $text = "There was an error when trying to connect to the server.";
    header("Location: http://localhost/marmitard/views/login.php?error=".$text );
    exit();
}