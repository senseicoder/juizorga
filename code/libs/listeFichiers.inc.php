<?php

class CListeFichiers implements Iterator
{
	const FILENAME = PATH_DATA . '/liste.fichiers.json';
	protected $_aFichiers = array();

	function __construct()
	{
		$this->_aFichiers = $this->Load();
	}

	function SplFileInfoToArray(SplFileInfo $oFile)
	{
		$a = array();
		foreach(array('getSize', 'getBasename', 'getExtension', 'getMTime') as $sField) {
			$a[$sField] = $oFile->$sField();
		}
		$finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à l'extension mimetype
		$a['mime'] = finfo_file($finfo, $oFile->getRealPath());
		finfo_close($finfo);
		return $a;
	}

	function Load()
	{
		$a = array();
		if(file_exists(self::FILENAME)) {
			$a = json_decode(file_get_contents(self::FILENAME), TRUE);
		}
		return $a;
	}

	function Save(array $aData)
	{
		file_put_contents(self::FILENAME, json_encode($aData));
	}

	function SaveData()
	{
		$this->Save($this->_aFichiers);
	}

	function Add(SplFileInfo $oFile)
	{
		$sClef = (string)$oFile;

		if( ! isset($this->_aFichiers[$sClef])) {
			$this->_aFichiers[$sClef] = array('file' => $this->SplFileInfoToArray($oFile));
			return 1;
		}
		else {
			return 0;
		}
	}

	function current ()
	{
		return current($this->_aFichiers);
	}

	function key ()
	{
		return key($this->_aFichiers);
	}

	function next() 
	{
		next($this->_aFichiers);
	}

	function rewind() 
	{
		reset($this->_aFichiers);
	}

	function valid()
	{
		return current($this->_aFichiers) !== FALSE;
	}
}