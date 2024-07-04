<?php
    session_start();
    include_once('./includes/functions_index.php');
    $recettes = getRecipeList();
    include_once('./includes/navbar.php');

    ?>
    <div class="min-h-screen">
        <div class="flex flex-row xl:max-w-[1300px] mx-auto flex-wrap justify-between mt-8">
        <?php

        foreach ($recettes as $item) {
            ?>
                    <div class="flex flex-col my-4 min-w-96 max-w-96 border p-8 hover:scale-110 transition-all duration-300">
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