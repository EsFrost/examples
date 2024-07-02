<?php

include_once('./config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}



$id = isset($_GET['id']) ? $_GET['id']: null;
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
    <h1 class='mt-1 text-3xl font-bold text-center'>
        <?php
            echo htmlspecialchars($titre);
        ?>
    </h1>
    <div class="flex gap-x-8 justify-center mt-8">
        <div class="flex-col">
            <div>Title</div>
            <div>
                <?php echo htmlspecialchars($titre); ?>
            </div>
        </div>
        <div class="flex-col">
            <div>Author</div>
            <div>
                <?php echo htmlspecialchars($author); ?>
            </div>
        </div>
        <div class="flex-col">
            <div>Availability</div>
            <div>
                <?php echo $dispo === 1 ? 'Yes' : 'No'; ?>
            </div>
        </div>
    </div>
    <div class="mt-8 flex justify-center gap-x-8">
        <form action="edit_book.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="editFunction">Edit</button>
        </form>
        <form action="delete_book.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="deleteFunction">Delete</button>
        </form>
        <button onclick="goBack()">Back</button> 
    </div>

    <script>
        const goBack = () => {
            window.history.back()
        }
    </script>
</body>
</html>