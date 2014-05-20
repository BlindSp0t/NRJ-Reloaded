<article>
	<h3>Rechercher par utilisateur</h3>
	<p>Entrez le pseudonyme Twinoïd dont vous voulez la liste des parties publiques. </p>
	<div class="entry">
<?php
	

	// open form 
	echo form_open('users/index');
			
	// building form with elements from controller
	$att = array('type'=>'text', 'id'=>'name','name'=>'name','size'=>20);
	echo "<div class='input text required'><label>Nom de l'utilisateur : ".form_input($att).'</div>';
	$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Afficher');
	echo '<div class="submit">'.form_input($att).'</div>';
	
	echo form_close();
?>
	</div>
</article>