<?php
    include_once('./db/db.php');
    $stmt = $pdo->prepare("SELECT * FROM recettes");
    $stmt->execute();
    $recettes = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $recettes[] = $row;
    }
    include_once('./includes/navbar.php');
    ?>
    <div class="min-h-screen">
        <div class="flex flex-row xl:max-w-[1300px] mx-auto flex-wrap">
        <?php

        foreach ($recettes as $item) {
            ?>
                    <div class="flex flex-col mx-4 my-8 min-w-96 max-w-96">
                        <a href="./views/recette.php?id=<?php echo $item['id']; ?>">
                            <h2 class="text-2xl bold"><?php echo $item['nom']; ?><h2>
                            <div>
                                <p><?php echo $item['description']?></p>
                            </div>
                        </a>
                    </div>
            <?php
        }
        ?>
        </div>
    </div>
    <?php
    include_once('./includes/footer.php');
?>