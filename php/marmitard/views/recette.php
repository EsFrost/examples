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

                <?php
                if ($data['photos'] !== '' && isImageUrlValid("http://localhost/marmitard".substr($data['photos'], 2))) {
                    $photo_url = substr($data['photos'], 2);
                    ?>
                        <img class="my-8" src="<?= "http://localhost/marmitard".$photo_url?>" alt="<?= $photo_url?>">
                    <?php
                }
                ?>

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
            $comments = getComments($data['id']);


            if (!empty($comments)) {
        ?>
        
        <div class="flex justify-center mt-20">
            <div class="flex flex-col mx-4 my-8 w-96 max-w-96">
                <p class="text-lg">Comments</p>

                <?php

                    foreach($comments as $item) {
                    ?>
                    <span class="mt-4 flex border p-4 rounded bg-gray-100">
                        <p><span class="font-bold"><?= $item['prenom']?></span> says:</p>
                        <p class="ml-4 italic"><?= $item['commentaires']?></p>
                    </span>
                    <?php
                    }
                }
                ?>
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