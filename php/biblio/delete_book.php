<?php

include_once('./config.php');

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteFunction'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $titre = '';
        $author = '';

        if($id) {
            $stmt = $mysqli->prepare("SELECT * FROM livres WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $titre = $row['titre'];
                    $author = $row['auteur'];
                }
            }
        
            $stmt->close();
        }
        
        // Validate and sanitize the ID as needed
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        // Process the ID (e.g., delete the record from the database)
        $stmt = $mysqli->prepare("DELETE FROM livres WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows < 1) {
            $err =  "No record found with ID " . htmlspecialchars($id) . ".";
        }

        $stmt->close();
    } else {
        $err = "ID not received.";
    }
} else {
    $err = "Invalid request method or missing delete function.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tailwind_output.css">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo htmlspecialchars($titre); ?></title>
</head>
<body>
    <?php
        if($err) {
            echo "
                <h1 class='mt-1 text-3xl font-bold text-center'>" .
                    htmlspecialchars($err) . 
                "</h1>
            ";
        }
        else {
            echo "
                <h1 class='mt-1 text-3xl font-bold text-center'>" .
                    htmlspecialchars($titre) .
                ": has been deleted.</h1>
            ";
        }
    ?>
    <div class="mt-8 flex justify-center gap-x-8">
        <button onclick="goBack()">Back</button> 
    </div>

    <script>
        const goBack = () => {
            window.location.href = '/biblio/'
        }
    </script>
</body>
</html>