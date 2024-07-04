<?php
    include_once '../includes/navbar.php';
?>
<div class="min-h-screen">
    <form action="<?= BASE_URL?>controller/register_controller.php" method="post" class="flex flex-col md:flex-row flex-wrap w-96 mx-auto" enctype="multipart/form-data">
        <div class="flex flex-col mx-auto">
            <label for="name" class="text-center">Name</label>
            <input type="text" name="nom" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:ml-4">
            <label for="prenom" class="text-center">Prenom</label>
            <input type="text" name="prenom" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4">
            <label for="email" class="text-center">Email</label>
            <input type="email" name="email" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4 md:ml-4">
            <label for="password" class="text-center">Password</label>
            <input type="password" name="password" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0 md:pt-4">
            <label for="age" class="text-center">Age</label>
            <input type="number" name="age" class="border border-1 mt-2" min="0" max="100" step="1">
        </div>
        <div class="flex flex-col mx-auto mt-4 md:mt-0">
            <label for="sexe" class="text-center">Sex</label>
            <div class="flex flex-row mt-2">
                <span><input type="radio" id="homme" name="sexe" value="homme" /><label for="homme" class="pl-2">Male</label></span>
                <span><input type="radio" id="femme" name="sexe" value="femme" class="ml-8" /><label for="femme" class="pl-2">Female</label></span>
            </div> 
        </div>
        <div class="flex flex-col mx-auto mt-4 md:pr-8">
            <label for="profileImage" class="text-center">Profile image</label>
            <input type="file" name="profileImage" class="border border-1 mt-2" accept="image/png, image/jpeg/, image/jpg">
        </div>
        <button class="mx-auto border border-1 mt-4 px-4 py-2 rounded hover:bg-gray-200 active:bg-gray-300 drop-shadow-sm" name="register" type="submit">Register</button>
    </form>
</div>

<?php

    include_once('../includes/footer.php');

?>