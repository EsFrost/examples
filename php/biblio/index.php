<?php

include_once("./config.php");

$stmt = $mysqli->prepare("SELECT * FROM livres");
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tailwind_output.css">
    <link rel="stylesheet" href="styles.css">
    <title>Books database</title>
</head>
<body>
    <h1 class='mt-1 text-3xl font-bold text-center'>
        <?php
            echo "Books";
        ?>
    </h1>
    <div class="flex justify-center mt-8">
        <ul class="text-left">
            <?php
                if ($result) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li><a href=book.php?id=" . urlencode(htmlspecialchars($row['id'])) .">" . $i . ") Title: " . htmlspecialchars($row['titre']) . "</a></li>";
                        $i++;
                    }
                }
            ?>
        </ul>
    </div>

    <div class="mt-8 text-center">
        <button onclick="goBack()">Add book</button> 
    </div>

    <script>
        const goBack = () => {
            window.location.href = '/biblio/add_book.php'
        }
    </script>
    
</body>
</html>