<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: http://localhost/marmitard");
    exit();
}

include_once('../includes/navbar.php');
include_once('../includes/functions.php');

$categories = getCategoryList();


?>

<div class="min-h-screen">
    <form action="<?= BASE_URL?>controller/recipe_controller.php" method="post" class="flex flex-col md:flex-row flex-wrap w-96 mx-auto" enctype="multipart/form-data">
        <div class="flex flex-col mx-auto">
            <label for="nom" class="text-center">Recipe name*</label>
            <input type="text" name="nom" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0">
            <label for="ingredients" class="text-center">Ingredients list*</label>
            <textarea type="text" name="ingredients" class="border border-1 mt-2"></textarea>
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4">
            <label for="description" class="text-center">Description*</label>
            <textarea type="text" name="description" class="border border-1 mt-2"></textarea>
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4">
            <label for="category" class="text-center">Category*</label>
            <select name="category" class="my-4">
                <?php
                    foreach ($categories as $item) {
                        echo $item['nom'];
                        ?>
                        <option value="<?= $item['id']?>"><?= $item['nom']?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4">
            <label for="recipeImage" class="text-center">Recipe image</label>
            <input type="file" name="recipeImage" class="border border-1 mt-2" accept="image/png, image/jpeg/, image/jpg">
        </div>
        <div class="flex flex-col mx-auto">
            <div class="text-xl mt-4 mb-2 text-red-600 mx-auto">
                <p><?php
                    if(isset($_GET['error'])) {
                        echo htmlspecialchars($_GET['error']);
                    }
                ?></p>
            </div>
            <div class="text-xl mt-4 mb-2 text-green-600 mx-auto">
                <p><?php
                    if(isset($_GET['msg'])) {
                        echo htmlspecialchars($_GET['msg']);
                    }
                ?></p>
            </div>
            <button class="mx-auto border border-1 mt-4 px-4 py-2 rounded hover:bg-gray-200 active:bg-gray-300 drop-shadow-sm" name="add_recipe" type="submit">Add recipe</button>
        </div>
        
    </form>
</div>

<?php

include_once('../includes/footer.php');



?>