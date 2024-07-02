<?php

include_once('./config.php');

$err = '';
$actionPerformed = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editFunction'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $titre = '';
        $author = '';
        $dispo = 0;

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
        
        // Validate and sanitize the ID as needed
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if (isset($_POST['titleInput'])) {
            $titre = filter_var($_POST['titleInput'], FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['authorInput'])) {
            $author = filter_var($_POST['authorInput'], FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['availability'])) {
            $dispo = $_POST['availability'] === 'on' ? 1 : 0;
        }

        // Process the ID (e.g., edit the record in the database)
        $stmt = $mysqli->prepare("UPDATE livres SET titre = ?, auteur = ?, dispo = ? WHERE id = ?");
        $stmt->bind_param("ssii", $titre, $author, $dispo, $id);
        $stmt->execute();

        if ($stmt->affected_rows < 1) {
            $err =  "No record found with ID " . htmlspecialchars($id) . ".";
        } else {
            $actionPerformed = "Record updated successfully.";
        }

        $stmt->close();
    } else {
        $err = "ID not received.";
    }
} else {
    $err = "Invalid request method or missing edit function.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tailwind_output.css">
    <link rel="stylesheet" href="./styles.css">
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
                    "Now editing: ".
                    htmlspecialchars($titre)
                    ."</h1>";
        }
    ?>
    <form action="edit_book.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="flex gap-x-8 justify-center mt-8">
            <div class="flex-column">
                <div>
                    <label for="titleInput">Title:</label>
                </div>
                <div>
                    <input class="text-black" type="text" id="titleInput" name="titleInput" placeholder="<?php echo htmlspecialchars($titre); ?>" value="<?php echo htmlspecialchars($titre); ?>">
                </div>
            </div>
            <div class="flex-column">
                <div>
                    <label for="authorInput">Author:</label>
                </div>
                <div>
                    <input class="text-black" type="text" id="authorInput" name="authorInput" placeholder="<?php echo htmlspecialchars($author); ?>" value="<?php echo htmlspecialchars($author); ?>">
                </div>
            </div>
            <div class="flex-column">
                <div>
                    <label for="availability">Availability:</label>
                </div>
                <div>
                    <input type="checkbox" id="availability" name="availability" <?php echo $dispo ? 'checked' : ''; ?>>
                </div>
            </div>
        </div>

        <?php
        // Display action result message
        if ($actionPerformed !== '') {
            echo "<h2 class='mt-8 text-xl font-bold text-center'>" . htmlspecialchars($actionPerformed) . "</h2>";
        }
        ?>
        
        <div class="mt-8 flex justify-center">
            <button type="submit" name="editFunction">Save</button> 
        </div>
    </form>
    <div class="mt-8 flex justify-center gap-x-8">
        <button type="button" id="clickBtn">Back</button> 
    </div>

    <script>
        document.querySelector('#clickBtn').addEventListener('click', function() {
            window.location.href = '/biblio/'
        });
    </script>
</body>
</html>
