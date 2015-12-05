<?php

#DOC API Liste de films
#http://docs.themoviedb.apiary.io/#reference/account/accountidlists
#https://www.themoviedb.org/talk/53187d7d92514177ab0011a5
#http://stackoverflow.com/questions/18280194/using-themoviedb-to-display-image-poster-with-php
#https://www.themoviedb.org/talk/5662df14c3a3682be9003e24
#https://www.themoviedb.org/documentation/api
#http://api.themoviedb.org/3/search/movie?api_key=ce89af9303e3c87e7f54146ff9078245&query=the%20flash

require __DIR__ . '/conf.inc.php';
require __DIR__ . '/libs/listeFichiers.inc.php';

$aOeuvres = array(
	'modern.family' => array(
		'titles' => array('modern.family'),
		'who' => array('n'=>1, 'c'=>1),
	),
	'the.flash' => array(
		'titles' => array('the.flash', 'the.flash.2014'),
		'who' => array('n'=>0, 'c'=>1),
	),
	'wolf.s.rain' => array(
		'titles' => array('wolf.s.rain'),
		'who' => array('n'=>NULL, 'c'=>1),
	),
);

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

function RechercherOeuvre(array $aOeuvres, $sFilename)
{
	$aResult = array();
	$sNom = NormalizePattern($sFilename);
	foreach($aOeuvres as $sSerie => $aDataSerie) {
		foreach($aDataSerie['titles'] as $sTitle) {
			if(strpos($sNom, $sTitle) !== FALSE) {
				$aResult[$sSerie] = 1;
			}
		}
	}

	return array_keys($aResult);
}

$oList = new CListeFichiers();

foreach ($oList as $key => $current) {
	var_dump($current);
	if( ! isset($current['classement'])) {
		printf('<h1>%s</h1><ul>', $key);
		printf('<li>%s</li>', $current['file']['getSize']);
		printf('<li>%s</li>', $current['file']['mime']);
		printf('<li>%s</li>', implode(', ', RechercherOeuvre($aOeuvres, $current['file']['getBasename'])));
		echo "</ul>";
		die;
	}
}