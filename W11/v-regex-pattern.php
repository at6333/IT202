<?php
$ucid = $_GET["ucid"];
$count = preg_match('/^[a-z]{2,3}[0-9]{2,4}$/i', $ucid, $matches);
if ($count == 0)
{
    echo "No match <br><br>";
}
else
{
    echo "Match <br>";
    echo "Match pattern is: " . $matches[0] . "<br>";
}
?>
