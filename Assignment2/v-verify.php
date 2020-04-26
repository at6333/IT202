<?php
session_start();
$captcha = $_GET["captcha"];
$actual = $_SESSION["captcha"];
$delay = $_GET["delay"];

if ($captcha == $actual)
{
    echo "Correct<br>Redirecting to form in $delay seconds";
    $_SESSION["authcaptcha"] = true;
    header("refresh: $delay; url=authForm.php");
    exit();
}
else
{
    echo "Incorrect; sending back to captcha<br>Redirecting in $delay seconds";
    header("refresh: $delay; url=v.html");
    exit();
}
?>
