<?php
session_start();
global $db;

$pass = $_GET["pass"];
echo "<br>Pass is: $pass <br><br>";

$hash = password_hash($pass, PASSWORD_DEFAULT);
echo "<br>Hash is: $hash <br><br>";
?>
