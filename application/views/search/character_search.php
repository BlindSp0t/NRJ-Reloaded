<article>
	<h3>Rechercher par personnage</h3>
	<p>Sélectionnez un personnage pour voir les journaux lui étant dédiés : </p>
	<div class="entry">
<?php
	

	// open form 
	echo form_open('search/character');
			
	// building form with elements from controller
	$att = "";
	foreach ($characters as $key => $value)
	{
		$att[$value['id']] = $value['name'];
	}
	echo '<div class="input select required">Sélectionnez votre personnage : '.form_dropdown('Personnages',$att,'').'</div><br /><br />';
	$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Afficher');
	echo '<div class="submit">'.form_input($att).'</div>';
	
	echo form_close();
?>
	</div>
</article>