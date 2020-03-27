<?php
session_start();
$captcha = $_GET["captcha"];
$actual = $_SESSION["captcha"];

if ($captcha == $actual)
{
    echo "Correct";
}
else
{
    echo "Incorrect";
}

?>
