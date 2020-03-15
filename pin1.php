<?php
session_start();
include ("myfunctions.php");

if (!isset($_SESSION["logged"]))
{
    echo "<br> Not authorized; please log in";
    header("refresh: 2; url=auth.html");
    exit();
}

$pin = mt_rand(999, 10000);
$subj = "your pin";
$msg = $pin;
$to = "at633@g.njit.edu";
//mail($to, $subj, $msg);
$_SESSION["pin"] = $pin;

echo "<br> Pin: '$pin'";
?>

<form action="pin2.php">
    <input type=text name="pin">Enter PIN
    <input type=submit>
</form>
