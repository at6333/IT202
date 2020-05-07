<?php

$zipcode = $_GET['zipcode'];

$url = "http://api.openweathermap.org/data/2.5/weather?zip=".$zipcode.",us&APPID=2a8fa623403e74e816aefd10d717b2a5"; 
$fp = fopen ($url, "r"); 
$contents = "";

while ($more = fread ($fp, 1000) ) {
   $contents .=  $more;
}
echo $contents; 

?>
