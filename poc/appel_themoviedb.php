<?php
#DOC API Liste de films
#http://docs.themoviedb.apiary.io/#reference/account/accountidlists
#https://www.themoviedb.org/talk/53187d7d92514177ab0011a5
#http://stackoverflow.com/questions/18280194/using-themoviedb-to-display-image-poster-with-php
#https://www.themoviedb.org/talk/5662df14c3a3682be9003e24
#https://www.themoviedb.org/documentation/api
#http://api.themoviedb.org/3/search/movie?api_key=ce89af9303e3c87e7f54146ff9078245&query=the%20flash


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
