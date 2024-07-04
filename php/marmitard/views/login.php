<?php

include_once('../includes/navbar.php');

?>
<div class="min-h-screen">
    <form action="<?= BASE_URL?>controller/login_controller.php" method="post" class="flex flex-col">
        <div class="flex flex-col mx-auto mt-4">
            <label for="email" class="text-center">Email</label>
            <input type="email" name="email" class="border border-1 mt-2">
        </div>
        <div class="flex flex-col mx-auto mt-4">
            <label for="password" class="text-center">Password</label>
            <input type="password" name="password" class="border border-1 mt-2">
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
            
            <button class="mx-auto border border-1 mt-4 px-4 py-2 rounded hover:bg-gray-200 active:bg-gray-300 drop-shadow-sm" name="login" type="submit">Login</button>
        </div>
    </form>

</div>

<?php

include_once('../includes/footer.php');

?>