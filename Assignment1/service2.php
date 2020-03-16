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

if (!isset($_SESSION["pinpass"]))
{
    echo "<br> Not authorized; please enter correct pin";
    header("refresh: 2; url=pin1.php");
    exit();
}

$choice = safe("choice");

switch ($choice)
{
    case "List":
        $number = safe("number");
        $ucid = $_SESSION["ucid"];
        retrieve($ucid, $number);
        echo "<br>";
        break;
    case "Perform":
        $ucid = $_SESSION["ucid"];
        $account = safe("account");
        $amount = safe("amount");
        perform($ucid, $account, $amount);
        echo "<br> Account balance updated <br>";
        break;
    case "Clear":
        $ucid = $_SESSION["ucid"];
        $account = safe("account");
        clear($ucid, $account);
        echo "<br> Account cleared <br>";
        break;
}

echo "<br> <a href=service1.php> Service1 </a>" . " for new action";
echo "<br> <a href=logout.php> Logout </a>" . " to exit";

?>
