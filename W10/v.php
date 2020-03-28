<?php
session_start();
header("Content-Type: image/png");

$im = imagecreatetruecolor(500, 200);
$fillcolor = imagecolorallocate($im, 0, 175, 200);
$bordercolor = imagecolorallocate($im, 200, 0, 0); // bonus 2
$textcolor1 = imagecolorallocate($im, 255, 255, 0);
$textcolor2 = imagecolorallocate($im, 255, 0, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$font1 = "LaBelleAurore.ttf";
$font2 = "Xerox Sans Serif Narrow.ttf";

$text1 = substr(str_shuffle(md5(time() ) ), 0, 2 );
$text2 = substr(str_shuffle(md5(time() ) ), 0, 2 );
$_SESSION["captcha"] = $text1 . $text2;
$sessionid = "Session ID: " . session_id();
$captcha = "Captcha: " . $_SESSION["captcha"];

imagefilledrectangle($im, 0, 0, 500, 200, $bordercolor); // bonus 2
imagefilledrectangle($im, 10, 10, 490, 190, $fillcolor);
imagettftext($im, 20, 30, 150, 75, $black, $font1, $text1);
imagettftext($im, 30, -60, 300, 125, $black, $font1, $text2);
imagettftext($im, 10, 0, 20, 170, $black, $font2, $sessionid);
imagettftext($im, 10, 0, 20, 180, $black, $font2, $captcha);

imagepng($im);
imagedestroy($im);
?>
