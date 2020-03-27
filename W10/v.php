<?php
session_start();
header("Content-Type: image/png");

$im = imagecreatetruecolor(400, 400);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$font = "LaBelleAurore.ttf"; // must download to CWD
$text1 = "Good";
$text2 = "Bye";
$_SESSION["captcha"] = $text1 . $text2;

$text1 = substr(str_shuffle(md5(time() ) ), 0, 4 );
$text2 = "Bye";
$_SESSION["captcha"] = $text1 . $text2;

imagefilledrectangle($im, 10, 10, 390, 390, $white);
imagettftext($im, 20, 0, 50, 200, $black, $font, $text1);
imagettftext($im, 30, -60, 200, 50, $black, $font, $text2);
imagettftext($im, 30, 0, 20, 380, $black, $font, "stuff");

imagepng($im);
imagedestroy($im);
?>
