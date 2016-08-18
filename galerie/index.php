<?php

$Bilderordner = "";//Ordner in dem sich die Bilder befinden
$webordner = "";
$html = "";

if(isset($_GET["album"])){
        $ordner = urldecode($_GET["album"]);
        if(strpos($ordner,".") === false){
                if(strpos($ordner,$Bilderordner) === 0){
                        if(is_dir($ordner)){
                                $Bilderordner = $ordner;
                        }
                }
        }
}

$elemente = scandir($Bilderordner);
foreach($elemente as $e){
        if($e == "." or $e == ".."){ continue; }
        if(is_dir($Bilderordner.$e)){ 
        $html .= '<a href="index.php?album='.urlencode($webordner.$e.'/').'">'.$e.'</a>';
        }else{
                $sitz = getimagesize($Bilderordner.$e);
                if($sitz[2] == 2 or $sitz[2] == 3){
                        $html .= '<div style="display:inline-block;margin:7px;">
                        <img src="'.$webordner.$e.'" '.$sitz[3].' alt="'.$e.'"></div>'; 
                }
        }
}
# Header:
echo "<html>\n<header>\n<title>Galerie</title>\n</header>\n<body>\n";
echo '<br/><a href="http://'. $_SERVER['SERVER_ADDR'].'/" style="color: blue; font-size: 4.2em; text-decoration: none; padding: 1em; text-shadow: 1px 2px 5px #0055ff;">Home</a><br/><br/><br/><hr><br/>';
echo $html;
echo "\n<!-- Quelle: https://github.com/ursinn/Bilder-Galerie -->\n<body>\n<html>\n";
?>
