<?php

require __DIR__ . '/conf.inc.php';

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

$aList = array();
$oDirectory = new RecursiveDirectoryIterator($sPathAnalyse);
$oFilter = new MyRecursiveFilterIterator($oDirectory);
$oIterator = new RecursiveIteratorIterator($oFilter);
$finfo = finfo_open(FILEINFO_MIME_TYPE);
foreach($oIterator as $oFile) {
	$aList[(string)$oFile] = array(
		'filepath' => (string)$oFile, 
		'mimetype' => finfo_file($finfo, $oFile->getRealPath()),
		'size' => $oFile->getSize(),
		'basename' => $oFile->getBasename(), 
		'extension' => $oFile->getExtension(), 
		'mtime' => $oFile->getMTime(),
	);
}
finfo_close($finfo);
file_put_contents(PATH_DATA . 'fichiers.json', json_encode($aList));