<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

include("account.php");
include("myfunctionsauth.php");
$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (!isset($_SESSION["authcaptcha"]))
{
    echo "Didn't pass captcha; redirecting<br>";
    header("refresh: 3; url=v.html");
}

print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db($db, $project);

if (isset($_GET["ucid"]))
{
    $flag = true;
    $ucid = safe("ucid");
    $pass = safe("pass");
    $amount = safe("amount");
    $delay = $_GET["delay"];

    if (!$flag)
    {
        echo "<br>Incorrect format; refreshing page in $delay seconds";
        header("refresh: $delay; url=authForm.php");
        exit();
    }

    if (authenticate($ucid,$pass))
    {
        echo "<br>Authenticated; redirecting to pin verification in $delay seconds";
        $_SESSION["logged"] = true;
        $_SESSION["ucid"] = $ucid;
        header("refresh: $delay; url=pin1.php");
        exit();
    }
    else
    {
        echo "<br>Not authenticated; refreshing page in $delay seconds";
        header("refresh: $delay; url=authForm.php");
        exit();
    }
}
?>

<form action="authForm.php" autocomplete="off">
    <input type=text name="ucid" value=""> ucid
    <br><input type=text name="pass" value=""> pass
    <br><input type=text name="amount" value=""> amount
    <br><input type=text name="delay" value=""> delay <br>
    <br><input type=submit>
</form>
