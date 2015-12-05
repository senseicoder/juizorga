<?php

$sKey = THEMOVIEDB_APIKEY;

$sUrl = 'http://api.themoviedb.org/3/configuration?api_key=%s';
$sUrl = sprintf($sUrl, $sKey);
$aConf = json_decode(file_get_contents($sUrl));

echo "<pre>";
var_dump($aConf);

$sUrl = 'http://api.themoviedb.org/3/search/movie?api_key=%s&query=%s';
$sSearch = urlencode('the flash');
$sUrl = sprintf($sUrl, $sKey, $sSearch);
$aFilms = json_decode(file_get_contents($sUrl));

echo "<pre>";
var_dump($aFilms);

printf('<img src="%s%s%s"/>', $aConf->images->base_url, $aConf->images->poster_sizes[2], $aFilms->results[2]->poster_path);
