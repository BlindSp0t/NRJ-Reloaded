<h1 class="datas">/neron/login/username_password/</h1>
<article>
		<div class="entry">
		<?php	
			// open form 
			echo form_open($auth);
					
			// building form with elements from controller
			//echo img('connec.png');
			$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Me connecter');
			echo '<div class="submit">'.form_input($att).'</div>';
			
			echo form_close();
		?>
		</div>
</article>