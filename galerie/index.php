<?php

$Bilderordner = "ORNDER";//Ordner in dem sich die Bilder befinden
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
	$html .= '<a href="index.php?album='.urlencode($Bilderordner.$e.'/').'">'.$e.'</a>';
	}else{
		$sitz = getimagesize($Bilderordner.$e);
		if($sitz[2] == 2 or $sitz[2] == 3){
			$html .= '<div style="display:inline-block;margin:7px;">
			<img src="'.$Bilderordner.$e.'" '.$sitz[3].' alt="'.$e.'"></div>'; 
		}
	}
}
echo '<a href="index.php">Home</a><hr>';
echo $html;
?>