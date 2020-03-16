<?php
function safe($fieldname)
{
    global $db;
    $temp = $_GET[$fieldname];
    $temp = trim($temp);
    $temp = mysqli_real_escape_string($db, $temp);
    return $temp;
}

function authenticate($ucid, $pass)
{
    global $db;
    $s = "select * from users where ucid = '$ucid' and pass = '$pass' ";
    ($t = mysqli_query($db, $s) ) or die (mysqli_error($db) );
    $num = mysqli_num_rows($t);
    if ($num == 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function retrieve($ucid, $num)
{
    global $db;
    global $ucid;
    $f = "select * from accounts where ucid = '$ucid' ";
    ($x = mysqli_query($db, $f) ) or die(mysqli_error($db) );
    $s = "select * from transactions where ucid = '$ucid' ";
    ($t = mysqli_query($db, $s) ) or die(mysqli_error($db) );
    while ($y = mysqli_fetch_array($x, MYSQLI_ASSOC))
    {
        echo "<hr>";
        $ucid = $y["ucid"];
        $account = $y["account"];
        $balance = $y["balance"];
        $recent = $y["recent"];
        echo "<b>$ucid $account balance: $$balance $recent</b>";
        while ($r = mysqli_fetch_array($t, MYSQLI_ASSOC))
        {
            $amount = $r["amount"];
            $timestamp = $r["timestamp"];
            $mail = $r["mail"];
            echo "<br> <i>$$amount $timestamp mail copy: '$mail'</I>";
        }
    }
}

function update($ucid, $account, $amount)
{
    global $db;
    $s = "insert into transactions values('$ucid', '$account', '$amount', NOW(), 'N')";
    ($t = mysqli_query($db, $s) ) or die(mysqli_error($db) );

    $m = "update accounts
        set balance = balance + '$amount', recent = NOW()
        where ucid = '$ucid' and account = '$account'
        and balance + $amount >= 0.00";
    ($n = mysqli_query($db, $m) ) or die(mysqli_error($db) );

    $affectedRows = mysqli_affected_rows($db);
    if ($affectedRows == 0)
    {
        echo "Overdraft; account balance didn't change";
        $a = "delete from transactions where ucid = '$ucid' and account = '$account' and amount = '$amount'";
        ($b = mysqli_query($db, $a) ) or die(mysqli_error($db) );
    }
    mysqli_close($db);
}

function clear($ucid, $account)
{
    global $db;
    $s = "delete from transactions where ucid = '$ucid' and account = '$account' ";
    ($t = mysqli_query($db, $s) ) or die(mysqli_error($db) );
    $u = "update accounts
        set balance = 0.00, recent = NOW()
        where ucid = '$ucid' and account = '$account'";
    ($v = mysqli_query($db, $u) ) or die(mysqli_error($db) );
}
?>
