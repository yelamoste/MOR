<?php

session_start();

$_session = array();

session_destroy();

header("Location: ../html/index.php");
exit;

?>