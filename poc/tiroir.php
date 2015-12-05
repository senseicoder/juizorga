<?php

function NormalizePattern($s)
{
	$aResult = array();
	$s = strtolower($s);
	$accu = '';
	for($i=0; $i<strlen($s); $i++) {
		$c = $s[$i];
		if(($c>='a' && $c<='z') || ($c>='0' && $c<='9')) $accu .= $c;
		else {
			if( ! empty($accu)) $aResult[] = $accu;
			$accu = '';
		}
	}
	if( ! empty($accu)) $aResult[] = $accu;

	return implode('.', $aResult);
}

foreach($aSeries as &$sSerie) {
	$sSerie = NormalizePattern($sSerie);
}

function RelierSerie(array $aSeries, array &$aFichiers, SplFileInfo $oFile)
{
	$sNom = NormalizePattern($oFile->getFileName());
	foreach($aSeries as $sSerie) {
		if(strpos($sNom, $sSerie) !== FALSE) {
			$aFichiers[$sSerie][] = $oFile->getFileName();
		}
	}
}
