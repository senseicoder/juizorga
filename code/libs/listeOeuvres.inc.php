<?php

class CListeOeuvres implements Iterator
{
	const FILENAME = PATH_DATA . '/liste.oeuvres.json';
	protected $_aFichiers = array();

	function __construct()
	{
		$this->_aFichiers = $this->Load();
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

	function Add($sTitle)
	{
		if( ! isset($this->_aFichiers[$sClef])) {
			$this->_aFichiers[$sTitle] = array('titles' = array($sTitle));
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