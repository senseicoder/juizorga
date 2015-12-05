<?php

define('PATH_DATA', '/home/cedric/data/');
$aPathAnalyse = array(
	'/home/nas/Transmission/Downloads/',
	'/home/nas/Videos/Regarder/Ensemble/',
	'/home/nas/Videos/Regarder/Cedric/',
	'/home/nas/Videos/Regarder/Nana/',
);

/*$aOeuvres = array(
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
		'who' => array('n'=>NULL, 'c'=>NULL),
	),
	'naruto.shippuuden' => array(
		'titles' => array('naruto.shippuuden'),
		'who' => array('n'=>1, 'c'=>0),
	),
	'jekyll' => array(
		'titles' => array('jekyll'),
		'who' => array('n'=>0, 'c'=>1),
	),
	'once.upon.a.time' => array(
		'titles' => array('once.upon.a.time'),
		'who' => array('n'=>1, 'c'=>1),
	),
	'visiteur.du.futur' => array(
		'titles' => array('visiteur.du.futur'),
		'who' => array('n'=>1, 'c'=>1),
	),
	'elementary' => array(
		'titles' => array('elementary'),
		'who' => array('n'=>1, 'c'=>1),
	),
	'extant' => array(
		'titles' => array('extant'),
		'who' => array('n'=>1, 'c'=>1),
	),
);
file_put_contents(PATH_DATA . 'oeuvres.json', json_encode($aOeuvres));*/

$aOeuvres = json_decode(file_get_contents(PATH_DATA . 'oeuvres.json'), TRUE);

#echo "<pre>";
