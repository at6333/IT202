<?php
function authenticate($ucid, $pass)
{
    global $db;
    $s = "select * from users where ucid = '$ucid'";
    ($t = mysqli_query($db, $s)) or die(mysqli_error($db));
    $num = mysqli_num_rows($t);
    if ($num == 0)
    {
        echo "No matching credentials; try again";
    }
    else
    {
        while ($u = mysqli_fetch_array($t, MYSQLI_ASSOC))
        {
            $hash = $u["hash"];
        }
    }
    return (password_verify($pass, $hash));
}

function safe($fieldname)
{
    global $flag;
    global $db;
    $v = $_GET[$fieldname];
    $v = trim($v);
    $v = mysqli_real_escape_string($db, $v);
    echo "<br>$fieldname is $v ";
    switch ($fieldname)
    {
        case "ucid":
            $count = preg_match('/^[a-z]{3,4}[0-9]{0,1}$/i', $v, $matches);
            if ($count == 0)
            {
                $flag = false;
                return "illegal ucid format";
                break;
            }
            else
            {
                return $v;
                break;
            }
        case "pass":
            $count = preg_match('/^[0-9]{3}$/i', $v, $matches);
            if ($count == 0)
            {
                $flag = false;
                return "illegal password format";
                break;
            }
            else
            {
                return $v;
                break;
            }
        case "amount":
            $count = preg_match('/^[0-9]+(?:\.[0-9]{1,3})?$/', $v, $matches);
            if ($count == 0)
            {
                $flag = false;
                return "illegal amount format";
                break;
            }
            else
            {
                return $v;
                break;
            }
        default:
            echo "Not a valid field";
            break;
    }
    
    return $v;
}
?>
