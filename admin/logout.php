<?php
session_start();

unset($_SESSION['admin_login']);
unset($_SESSION['admin_username']);

header("Location: admin_login.php?logout=success");
exit();
?>