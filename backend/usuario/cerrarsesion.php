<?php 

session_start();

session_destroy();

header("Location: ../../frontend/index/index.php");

?>