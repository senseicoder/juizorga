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

$aSeries = array('Modern.Family', 'The.Flash.2014', 'Wolf.s.Rain');

$oList = new CListeFichiers();

foreach ($oList as $key => $current) {
	var_dump($current);
	if( ! isset($current['classement'])) {
		printf('<h1>%s</h1><ul>', $key);
		printf('<li>%s</li>', $current['file']['getSize']);
		printf('<li>%s</li>', $current['file']['mime']);
		echo "</ul>";
		die;
	}
}