<?php

include_once('./config.php');

$titre = '';
$author = '';
$dispo = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveEdit'])) {
    if (isset($_POST['id']) && isset($_POST['titleInput']) && isset($_POST['authorInput'])) {
        echo "works";

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if($id) {
            $stmt = $mysqli->prepare("SELECT * FROM livres WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $titre = $row['titre'];
                    $author = $row['auteur'];
                    $dispo = $row['dispo'];
                }
            }
        
            $stmt->close();
        }

        if (isset($_POST['titleInput']) && $_POST['titleInput'] !== '') {
            $titre = filter_var($_POST['titleInput'], FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['authorInput']) && $_POST['authorInput'] !== '') {
            $author = filter_var($_POST['authorInput'], FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['availability']) && $_POST['availability'] === 'yes') {
            $dispo = 1;
        }
        else {
            $dispo = 0;
        }

        // Process the ID (e.g., edit the record in the database)
        $stmt = $mysqli->prepare("UPDATE livres SET titre = ?, auteur = ?, dispo = ? WHERE id = ?");
        $stmt->bind_param("ssii", $titre, $author, $dispo, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $actionPerformed = "Record updated successfully.";
        }

        $stmt->close();
    }

    // Redirect back to the original page after action is completed
    $redirectUrl = "/biblio/book.php?id=" . urlencode($id);
    header("Location: " . $redirectUrl);
    exit;
}
else {
    echo 'There was an error';
}