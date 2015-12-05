<?php

function NormalizePattern($s)
{
	$aResult = array();
	$s = strtolower($s);
	$accu = '';
	for($i=0; $i<strlen($s); $i++) {
		$c = $s[$i];
		if(($c>='a' && $c<='z') || ($c>='0' && $c<='9')) {
			$accu .= $c;
		}
		else {
			if( ! empty($accu)) $aResult[] = $accu;
			$accu = '';
		}
	}
	if( ! empty($accu)) $aResult[] = $accu;
	$aFiles = json_decode(file_get_contents(PATH_DATA . 'fichiers.json'), TRUE);

	return implode('.', $aResult);
}

function RechercherOeuvre(array $aOeuvres, $sFilename)
{
	$aResult = array();
	$sNom = NormalizePattern($sFilename);
	foreach($aOeuvres as $sOeuvre => $aData) {
		foreach($aData['titles'] as $sTitle) {
			if(strpos($sNom, $sTitle) !== FALSE) {
				$aResult[$sOeuvre] = 1;
			}
		}
	}

	return array_keys($aResult);
}

foreach($aFiles as $sFilePath => &$aFileData) {
	#if fichier vidéo
	$aOeuvresTrouvees = RechercherOeuvre($aOeuvres, $aFileData['basename']);
	if(count($aOeuvresTrouvees) == 1) {
		$aFileData['oeuvre'] = $aOeuvresTrouvees[0];
	}
	else {
		$aFileData['oeuvres'] = $aOeuvresTrouvees;
	}
	$aFileData['nature'] = NATURE_OEUVREVIDEO;
}