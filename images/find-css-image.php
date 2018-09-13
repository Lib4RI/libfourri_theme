<?php

// Issue:
// - Editing a Durpal content node/page with 'Full HTML' editing mode has problems sometimes with *relative* site paths
//   resp. relative URL addresses for images and CSS files. Also the 'Preview mode' may suffer with problem.
// Work-around:
// - This is an *auxiliary* PHP page/tool to find the image that belongs to a given CSS class.

$txtError = "CSS class needed: ?cl=className";

$cssClass = @trim(rawurldecode($_GET['cl']));
if ( !empty($cssClass) && strlen($cssClass) < 50 && !strchr($cssClass,"/") ) {

	$modPath = dirname($_SERVER['SCRIPT_FILENAME']) . "/";	// = "https://www.dora.lib4ri.ch/eawag/sites/all/themes/libfourri_theme/css/";
	$cssFile = "../css/styles.css";		// assuming the css folder in in the same level as the folder this file here is contained.

	$imgPath = "";
	$imgExt = "";
	
	if ( !( $cssRow = file_get_contents( $modPath.$cssFile ) ) ) {
		$txtError = "File '" . basename($cssFile) . "' not found";
	} else {
		if ( substr($cssClass,0,1) != "." && substr($cssClass,0,1) != "#" ) {
			if ( substr($cssClass,0,1) != " " ) { $cssClass = ".".rtrim($cssClass); }
			else { $cssClass = trim($cssClass); }
		}

		$cssAry = explode( "/"."*", $cssRow );		// get rid of / * comments * /
		foreach( $cssAry as $idx => $row ) {
			if ( $tmp = strchr($row,"*"."/") ) { $cssAry[$idx] = substr($tmp,2); }
		}
		
		$cssAry = explode( "\n", implode( "", $cssAry ) );
		foreach( $cssAry as $cssRow ) {
			$cssRow = trim($cssRow);
			if ( empty($cssRow) || substr($cssRow,0,2) == "//" ) {
				continue;
			}
			if ( empty($imgExt) ) {
				if ( strchr($cssRow,$cssClass) ) { $imgExt = "any"; }
				continue;
			}
			if ( $imgPath = strchr($cssRow,"url") ) {
				$imgPath = str_replace(": url", ":url", $cssRow );
				$imgPath = str_replace("url (", "url(", $imgPath );
				if ( $imgPath = strchr($imgPath,":url(") ) {
					$imgPath = substr(strchr(strtr($imgPath,"\"","'"),"'"),1);
					$imgPath = trim( strtok(strtok($imgPath,"'")."?","?") );
					if ( $imgExt = strtolower(strrchr($imgPath,".")) ) {
						if ( strchr( ".png.gif.jpg.jpeg.", $imgExt."." ) ) { break; }
					}
					$imgExt = "any";
				}
			}
		}

		if ( empty($imgExt) ) {
			$txtError = "class '" . substr($cssClass,1) . "' not found";
		} elseif ( @!file_exists($modPath.$imgPath) ) {
			$txtError = "file '{$imgPath}' not found";
		} else {
			$imgAry = getimagesize($modPath.$imgPath);
			$imgMime = $imgAry['mime'];
			if ( $imgMime == "image/png" || $imgMime == "image/gif" || $imgMime == "image/jpg" || $imgMime == "image/jpeg" ) {
				header( "Content-type: " . $imgMime );
				readfile($modPath.$imgPath);
				exit;
			}
			$txtError = "Image '{$imgPath}' not accepted";
		}
	}
}


// show an error image:
header( "Content-type: image/png" );
$im = imagecreate(640,120);
imagecolorallocate($im, 31, 159, 191);		// background color
imagestring($im, 8, 20, 25,  "*** Lib4RI image placeholder ***", imagecolorallocate($im, 0, 15, 127) );
$tColor = imagecolorallocate($im, 143, 15, 0);
imagestring($im, 8, 20, 55,  "ERROR:", $tColor);
imagestring($im, 8, 20, 70,  $txtError, $tColor);
imagepng($im);
imagedestroy($im);

?>
