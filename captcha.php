<?php  //Marcio
session_start();
$code=rand(1000,99999);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(50, 24);
$bg = imagecolorallocate($im, 255, 153, 0); //background color blue
$fg = imagecolorallocate($im, 0, 0, 0);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
//DIEGO2
?>
