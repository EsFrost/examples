<?php 

include_once('./config.php'); // Include your database connection file

$actionPerformed = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createBook'])) {
    // Sanitize and validate input
    $title = isset($_POST['titleInput']) ? filter_var($_POST['titleInput'], FILTER_SANITIZE_STRING) : null;
    $author = isset($_POST['authorInput']) ? filter_var($_POST['authorInput'], FILTER_SANITIZE_STRING) : null;
    $availability = isset($_POST['Availability']) ? 1 : 0;

    // Validate and process form submission
    if (!empty($title) && !empty($author)) {
        
        // Prepare and execute SQL statement
        $stmt = $mysqli->prepare("INSERT INTO livres (titre, auteur, dispo) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $author, $availability);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $actionPerformed = "Book added successfully!";
        } else {
            $actionPerformed = "Failed to add book. Please try again.";
        }

        $stmt->close();
        $mysqli->close();
    } else {
        $actionPerformed = "Please fill in all the fields.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tailwind_output.css">
    <link rel="stylesheet" href="styles.css">
    <title>Add a book</title>
</head>
<body>
    <h1 class='mt-1 text-3xl font-bold text-center'>
        Add a book
    </h1>
    <form action="add_book.php" method="POST">
        <div class="flex gap-x-8 justify-center mt-8">
            <div class="flex-column">
                <div>
                    <label for="titleInput">Title:</label>
                </div>
                <div>
                    <input class="text-black" type="text" id="titleInput" name="titleInput">
                </div>
            </div>
            <div class="flex-column">
                <div>
                    <label for="authorInput">Author:</label>
                </div>
                <div>
                    <input class="text-black" type="text" id="authorInput" name="authorInput">
                </div>
            </div>
            <div class="flex-column">
                <div>
                    <label for="availability">Availability:</label>
                </div>
                <div>
                    <input type="checkbox" id="availability" name="Availability">
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
            <button type="submit" name="createBook">Add</button> 
        </div>
    </form>

    <div class="mt-8 flex justify-center">
        <button onclick="goBack()">Back</button>
    </div>

    <script>
        const goBack = () => {
            window.location.href = '/biblio/';
        }
    </script>
</body>
</html>