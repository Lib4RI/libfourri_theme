<?php

// this is an *auxiliary* PHP page/tool to find the image that belongs to a given CSS class, since there seems to be
// no way to add a CSS file in a Durpal content node/page when we only can (want to) use the 'Full HTML' editing mode.

$txtError = "CSS class needed: ?cl=className";

$cssClass = @trim(($_GET['cl']));
if ( !empty($cssClass) && strlen($cssClass) < 50 && !strchr($cssClass,"/") ) {

	$modPath = dirname($_SERVER['SCRIPT_FILENAME']) . "/";	// = "https://www.dora.lib4ri.ch/eawag/sites/all/themes/libfourri_theme/css/";
	$cssFile = "../css/styles.css";		// assuming the css folder in in the same level as the folder this file here is contained.

	$imgPath = "";
	$imgType = "";
	
	if ( !( $cssAry = file( $modPath.$cssFile ) ) ) {
		echo $modPath.$cssFile;
		exit;
		$txtError = "File 'styles.css' not found";
	} else {
		foreach( $cssAry as $cssRow ) {
			$cssRow = trim($cssRow);
			if ( empty($cssRow) || substr($cssRow,0,2) == "/"."*" || substr($cssRow,0,2) == "//" ) {
				continue;		// quite vulnerable to look like this for comments, however should work the way comments are set currenty.
			}
			if ( strchr($cssRow,"/"."*") && strchr($cssRow,"*"."/") ) {		// to get rid of / * comments * /
				$cssRow = str_replace("*"."/","/>",$cssRow);
				$cssRow = str_replace("/"."*","<tag",$cssRow);
				$cssRow = strip_tags($cssRow);
			}
			if ( empty($imgType) ) {
				if ( strchr($cssRow,".".$cssClass) ) { $imgType = "any"; }
				continue;
			}
			if ( $imgPath = strchr($cssRow,"url") ) {
				$imgPath = strtr(substr($imgPath,3),"(\";')","     ");
				$imgPath = trim( array_shift(explode("//",$imgPath."//",2)) );
				$imgType = strtolower(substr(strrchr($imgPath,"."),1));
				break;
			}
		}

		if ( empty($imgType) ) {
			$txtError = "class '{$cssClass}' not found";
		} elseif ( @!is_file($modPath.$imgPath) ) {
			$txtError = "file '{$imgPath}' not found";
		} else {
			header( "Content-type: image/" . ( $imgType == "jpg" ? "jpeg" : $imgType ) );
			readfile($modPath.$imgPath);
			exit;
		}
	}
}


// show an error image:
header( "Content-type: image/png" );
$im = imagecreate(400,120);
imagecolorallocate($im, 31, 159, 191);		// background color
imagestring($im, 8, 50, 25,  "*** Lib4RI image placeholder ***", imagecolorallocate($im, 0, 15, 127) );
$tColor = imagecolorallocate($im, 143, 15, 0);
imagestring($im, 8, 20, 55,  "ERROR:", $tColor);
imagestring($im, 8, 20, 70,  $txtError, $tColor);
imagepng($im);
imagedestroy($im);

?>
