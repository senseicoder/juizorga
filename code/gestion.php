<?php

require __DIR__ . '/conf.inc.php';
require __DIR__ . '/libs/listeFichiers.inc.php';

$aFiles = json_decode(file_get_contents(PATH_DATA . 'fichiers.json'), TRUE);

echo "<h1>A déplacer</h1><table border=1>";
foreach($aFiles as $sFilePath => $aFileData) if(isset($aFileData['destination'])) {
	printf('<tr><td><input type="checkbox" name="actions[%s]"/></td><td>%s</td><td>%s</td><td>%s</td></tr>',
		$sFilePath,
		$aFileData['basename'],
		Oeuvres($aFileData),
		Champ($aFileData, 'destination')
		);
}
echo '</table><input type="submit" name="cmd" value="valider"/>';

echo "<h1>A classer</h1><table border=1>";
foreach($aFiles as $sFilePath => $aFileData) if( ! isset($aFileData['oeuvre'])) {
	printf('<tr><td><input type="checkbox" name="actions[%s]"/></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
		$sFilePath,
		$aFileData['basename'],
		Oeuvres($aFileData),
		''
		);
}
echo '</table><input type="submit" name="cmd" value="valider"/>';

function Oeuvres(array $a)
{
	if(isset($a['oeuvre'])) return $a['oeuvre'];
	elseif(isset($a['oeuvres'])) return implode(' / ', $a['oeuvres']);
	else return '-';
}

function Champ(array $a, $chp)
{
	if(isset($a[$chp])) return $a[$chp];
	else return '-';
}

#echo "<h1>Debug</h1>"; var_dump($aFiles);