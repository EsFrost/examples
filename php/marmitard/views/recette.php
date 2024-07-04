<?php

session_start();

include_once('../includes/navbar.php');
include_once('../includes/functions.php');

?>

<div class="min-h-screen">

    <?php

    $data = '';
    $categories = array();

    if (isset($_GET['id'])) {
        $res = getSingleRecipe($_GET['id']);
        $data = $res['data'];
        $categories = $res['categories'];

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
        exit();
    }

    ?>

</div>

<?php

include_once('../includes/footer.php');

?>