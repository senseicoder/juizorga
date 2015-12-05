<?php

require __DIR__ . '/conf.inc.php';
require __DIR__ . '/libs/listeFichiers.inc.php';

$oList = new CListeFichiers();

class MyRecursiveFilterIterator extends \RecursiveFilterIterator 
{
	public function accept() 
	{
		$filename = $this->current()->getFilename();
		if ($filename[0] === '.') {
			return FALSE;
		}
		return TRUE;
	}
}

foreach($aPathAnalyse as $sPath) {
	echo "<h1>analyse de $sPath</h1>";
	$oDirectory = new RecursiveDirectoryIterator($sPath);
	$oFilter = new MyRecursiveFilterIterator($oDirectory);
	$oIterator = new RecursiveIteratorIterator($oFilter);
	$ct = 0;
	foreach($oIterator as $oFile) {
		$ct += $oList->Add($oFile);
	}
}

echo "import: $ct<br>";
$oList->SaveData();