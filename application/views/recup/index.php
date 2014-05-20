<h1 class="datas">/neron/root/old_logs/</h1>
<article>
	<div id="home">
		<h3>Récupération d'anciens journaux</h3>
		<p>Vous pouvez utiliser cette section pour récupérer vos anciens journaux NRJ.<br />
		
		Vous devez n'avoir aucun journal en cours pour pouvoir récupérer des journaux.<br />
		Pour récupérer vos anciens journaux, suivez la procédure en cliquant sur le bouton ci-dessous:<br />

		<span class="red">/!\ ATTENTION ! N'utilisez pas cette partie pour créer de nouveaux journaux! /!\</span></p>
		<?php
			// open form 
			echo form_open(base_url('recup/newrecup'));
					
			$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Récupération');
			echo '<div class="submit">'.form_input($att).'</div>';
			
			echo form_close();
		?>
	</div>
</article>