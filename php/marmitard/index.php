<?php
    session_start();
    include_once('./includes/functions_index.php');
    $recettes = getRecipeList();
    $res_per_page = 12;
    $total_recipes = count($recettes);
    $total_pages = ceil($total_recipes / $res_per_page);

    // Determine which page number visitor is currently on
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $current_page = (int) $_GET['page'];
    } else {
        $current_page = 1;
    }

    // Calculate the starting record for the current page
    $start_from = ($current_page - 1) * $res_per_page;

    // Extract the current page's records
    $current_page_items = array_slice($recettes, $start_from, $res_per_page);

    include_once('./includes/navbar.php');

    ?>
    <div class="min-h-screen">
        <div class="flex flex-row xl:max-w-[1300px] mx-auto flex-wrap justify-between mt-8">
        <?php

        foreach ($current_page_items as $item) {
            ?>
                    <div class="flex flex-col my-4 min-w-96 max-w-96 border p-8 hover:scale-110 transition-all duration-300 relative">
                        <a href="./views/recette.php?id=<?php echo $item['id']; ?>">
                            <h2 class="text-2xl bold"><?php echo $item['nom']; ?><h2>

                            <?php
                            if ($item['photos'] !== '' && isImageUrlValid("http://localhost/marmitard".substr($item['photos'], 2))) {
                                $photo_url = substr($item['photos'], 2);
                                isImageUrlValid("http://localhost/marmitard".$photo_url) 
                                ?>
                                    <img class="my-8" src="<?= "http://localhost/marmitard".$photo_url?>" alt="<?= $photo_url?>">
                                <?php
                            }
                            else {
                                ?>
                                <img class="my-8" src="http://localhost/marmitard/public/img/placeholder.jpg" alt="<?= $item['nom']?>">
                                <?php
                            }
                            ?>
                            <div>
                                <p><?php echo $item['description']?></p>
                            </div>

                            <div class="mt-8">Click for more details</div>
                        </a>
                    </div>
            <?php
        }
        ?>
        </div>
        <div class="flex justify-center items-center mt-8">
            <span class="mr-4">
                <p>Page: </p>
            </span>
            <?php
                for ($page = 1; $page <= $total_pages; $page++) {
                    if ($page === $current_page) {
                        echo '<a href="index.php?page=' . $page . '" class="text-xl text-blue-600">' . $page . '</a> ';
                    }
                    else {
                        echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
                    }
                    
                }
            ?>
        </div>
    </div>

    <?php
    include_once('./includes/footer.php');
?>