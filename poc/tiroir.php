<fieldset><legend>Sélectionner série</legend>
	<?foreach($aOeuvres as $sOeuvre => $aData):?><input name="newserie_nom" value="<?=$sOeuvre?>" type="radio"/><?=$sOeuvre?>&nbsp;&nbsp;<?endforeach;?>
	<input type="submit" value="Sélectionner" name="cmd_selectserie"/>
</fieldset>
