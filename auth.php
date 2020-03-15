<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

include ("account.php");
include ("myfunctions.php");
$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db($db, $project);

$ucid = safe("ucid");
$pass = safe("pass");

if (!authenticate($ucid, $pass))
{
    echo "<br> Not authenticated";
    header ("refresh: 2; url=auth.html");
    exit();
}
else
{
    echo "<br> Authenticated";
    $_SESSION["logged"] = true;
    $_SESSION["ucid"] = $ucid;
    header ("refresh: 2; url=pin1.php");
    exit();
}


/*
$s = "select * from users where ucid = '$ucid' and pass = '$pass' ";
echo "<br> SQL insert $s";
($t = mysqli_query($db, $s) ) or die(mysqli_error($db) );

$num = mysqli_num_rows($t);
if ($num == 0)
{
    echo "<br> Not authenticated";
}
else
{
    echo "<br> Authenticated successfully";
}
*/

/*
$s = "insert into transactions values('$ucid', '$account', '$amount', NOW(), 'N')";
print "<br> SQL insert $s";

mysqli_query($db, $s) or die(mysqli_error($db) );
print "<br> Bye";

    $s = "update accounts 
        set balance = balance + '$amount', 
        recent = NOW()

        where
            ucid = '$ucid' and account = '$account' ";

print "<br> SQL update $s";

mysqli_query($db, $s) or die(mysqli_error($db) );
*/
print "<br> Bye";
?>
