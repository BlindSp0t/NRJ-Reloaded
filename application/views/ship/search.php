<h1 class="datas">/neron/data/search/</h1>
<article>
	<h3> Rechercher par Palmarès.</h3>
	<p>Entrez le numéro d'identifiant theEnd pour retrouver une partie publique. </p>
	<div class="entry">
	<?php		

		// open form 
		echo form_open('ship/search');
				
		// building form with elements from controller
		$att = array('type'=>'number', 'id'=>'the_end','name'=>'the_end','maxvalue'=>99999, 'required'=>'required');
		echo '<div class="input number required"><label>Code theEnd : </label>'.form_input($att).'</div>';
		$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Afficher');
		echo '<div class="submit">'.form_input($att).'</div>';
		
		echo form_close();
	?>
	</div>
</article>