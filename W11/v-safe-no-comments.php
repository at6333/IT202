<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

function safe($fieldname)
{
    global $flag;
    $v = $_GET[$fieldname];
    $v = trim($v);
    // my_sqli needed

    if ($fieldname == "ucid")
    {
        $count = preg_match ('/^[a-z]{2,3}[0-9]{2,4}$/i', $v, $matches);
        if ($count == 0)
        {
            echo "$fieldname $v did not satisfy regex";
            $flag = false;
            return "Illegal";
        }
        else
        {
            echo "ucid $v did satisfy regex";
            return $v;
        }
    }

    echo "<br>$fieldname has value $v";
    return $v;
}

$flag = true;
$ucid = safe("ucid");
$pass = safe("pass");
if (!$flag)
{
    echo "<br>Redirect bad value";
    exit();
}
echo "<br>Continue on with authentication; data good";
?>
