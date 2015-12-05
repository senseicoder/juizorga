<?php

define('PATH_DESTINATION_BASE', '/home/nas/Videos/Regarder/');

function PourQui(array $aOeuvre)
{
	if($aOeuvre['who']['c']) {
		if($aOeuvre['who']['n']) {
			return 'Ensemble';
		}
		else {
			return 'Cedric';
		}
	}
	elseif($aOeuvre['who']['n']) {
		return 'Nathalie';
	}
	else return 'Trier';
}

function CalculDestination(array $aOeuvres, array $aFileData)
{
	if( ! isset($aFileData['oeuvre'])) return '';
	else {
		$aOeuvre = $aOeuvres[$aFileData['oeuvre']];
		return sprintf('%s/%s/%s/', PATH_DESTINATION_BASE, PourQui($aOeuvre), $aFileData['oeuvre']);
	}
}

foreach($aFiles as $sFilePath => &$aFileData) {
	$sDestination = CalculDestination($aOeuvres, $aFileData);
	$aFileData['destination'] = $sDestination;
}