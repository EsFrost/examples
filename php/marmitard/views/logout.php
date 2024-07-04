<?php

session_start();

$_SESSION = array();

session_destroy();

$msg = 'Logged out successfully!';
header('Location: http://localhost/marmitard/views/login.php?msg='.$msg);
exit();

?>