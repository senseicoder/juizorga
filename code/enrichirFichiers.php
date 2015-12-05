<?php

require __DIR__ . '/conf.inc.php';

define('NATURE_OEUVREVIDEO', 'oeuvrevideo');

$aFiles = json_decode(file_get_contents(PATH_DATA . 'fichiers.json'), TRUE);

foreach(glob(__DIR__ . '/enrichir/*.php') as $sInclude) {
	require $sInclude;
}

file_put_contents(PATH_DATA . 'fichiers.json', json_encode($aFiles));