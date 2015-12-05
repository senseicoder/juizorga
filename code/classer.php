<?php

require __DIR__ . '/conf.inc.php';
require __DIR__ . '/libs/listeFichiers.inc.php';

$aFiles = json_decode(file_get_contents(PATH_DATA . 'fichiers.json'), TRUE);

if( ! isset($_GET['file'])) die('pas de paramètres');
$sFile = $_GET['file'];
if( ! isset($aFiles[$sFile])) die('fichier non trouvé');
$aDatafile = $aFiles[$sFile];

if(isset($_POST['cmd_newserie'])) {
	$sSerie = $_POST['newserie_nom'];
	$aOeuvres[$sSerie] = array('titles' => array($sSerie), 'who' => array('n'=>NULL, 'c'=>NULL));
	file_put_contents(PATH_DATA . 'oeuvres.json', json_encode($aOeuvres));
}

if(isset($_POST['film_chercher'])) {
	$sFilmChercher = $_POST['film_chercher'];
}
else {
	$sFilmChercher = preg_replace('/[^a-z0-9]+/Ui', ' ', strtolower($aDatafile['basename']));
}

if(isset($_POST['cmd_selectfilm'])) {
	$sUrl = 'http://api.themoviedb.org/3/search/movie/?api_key=%s';
	$sSearch = urlencode($sFilmChercher);
	$sUrl = sprintf($sUrl, THEMOVIEDB_APIKEY, $sSearch);
	$aFilms = json_decode(file_get_contents($sUrl));


	$idFilm = $_POST['filmref'];
	$aFiles[$sFile]['oeuvre'] = 
}


?><form action="?file=<?=urlencode($sFile)?>" method="post">
<h1><?=$aDatafile['basename']?></h1>
<ul>
<li><?=$aDatafile['size']?></li>
<li><?=$aDatafile['realpath']?></li>
<li><?=$aDatafile['mimetype']?></li>
</ul>
<fieldset><legend>Créer série</legend>
	Nom <input name="newserie_nom" type="text"/><input type="submit" value="Créer" name="cmd_newserie"/>
</fieldset>

<?php
/*$sUrl = 'http://api.themoviedb.org/3/configuration?api_key=%s';
$sUrl = sprintf($sUrl, THEMOVIEDB_APIKEY);
$aConf = json_decode(file_get_contents($sUrl));*/

$sUrl = 'http://api.themoviedb.org/3/search/movie?api_key=%s&query=%s';
$sSearch = urlencode($sFilmChercher);
$sUrl = sprintf($sUrl, THEMOVIEDB_APIKEY, $sSearch);
$aFilms = json_decode(file_get_contents($sUrl));
?>
<fieldset><legend>Film à chercher</legend>
	Chercher <input name="film_chercher" type="text" value="<?=htmlentities($sFilmChercher)?>"/><input type="submit" value="Chercher" name="cmd_chercher"/><br/>
	<br/>
	<?foreach($aFilms->results as $idFilm => $aFilm):?><input name="filmref" value="<?=$aFilm['id']?>" type="radio"/><?=$aFilm->original_title?> - <?=$aFilm->release_date?> - <?=$aFilm->overview?><br/><?endforeach;?>
	<input type="submit" value="Sélectionner" name="cmd_selectfilm"/>
</fieldset>
</form>
<?php
file_put_contents(PATH_DATA . 'fichiers.json', json_encode($aFiles));