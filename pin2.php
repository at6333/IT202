<?php
session_start();
include ("account.php");
include ("myfunctions.php");

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
mysqli_select_db($db, $project);

if (!isset($_SESSION["logged"]))
{
    echo "<br> Not authorized; please log in";
    header("refresh: 2; url=pin1.php");
    exit();
}

$pin = safe("pin");
$OGPin = $_SESSION["pin"];

echo "Randomly generated pin: '$OGPin' ";
if ($pin == $OGPin)
{
    echo "<br> Correct pin";
    $_SESSION["pinpass"] = true;
    header("refresh: 2; url=service1.php");
    exit();
}
else
{
    echo "<br> Incorrect pin";
    header("refresh: 2; url=pin1.php");
    exit();
}
?>
