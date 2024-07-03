<?php

include_once('../db/db.php');

include_once('../includes/navbar.php');

?>

<div class="min-h-screen">

    <?php

    $data = '';

    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
        $stmt -> bindParam(':id', $_GET['id']);

        $stmt2 = $pdo->prepare("SELECT c.nom FROM recettes r JOIN categories c ON r.id_category = c.id WHERE r.id = :id");
        $stmt2 -> bindParam(':id', $_GET['id']);
        try {
            $stmt->execute();
            $stmt2->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

        $data = $stmt->fetch();
        $categories = array();

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
            $categories[] = $row;
        }

        $ingredients = explode(",", $data['liste_ingredients']);

        ?>
        <div class="flex justify-center">
            
            <div class="flex flex-col mx-4 my-8 w-96 max-w-96">
            <div class="flex flex-wrap w-96">
                <?php
                    foreach ($categories as $item) {
                        ?>
                        <span class="text-gray-800 text-xs font-medium mr-2 py-0.5">
                            <?php echo htmlspecialchars($item['nom']); ?>
                        </span>
                        <?php
                    }
                ?>
            </div>
                <h2 class="text-2xl bold"><?= $data['nom']?></h2>
                <p class="mt-2"><?= $data['description'] ?></p>

                <ul class="mt-2 italic text-gray-600">
                    <?php
                    foreach ($ingredients as $item) {
                        ?>
                        <li><?= htmlspecialchars($item)?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        

        <?php
    }
    else {
        header('Location: http://localhost/marmitard/');
    }

    ?>

</div>

<?php

include_once('../includes/footer.php');

?>