<h1 class="datas">/neron/root/journaux/</h1>
<article>
	<?php
		echo 	"<h3>Bonjour ".$this->session->userdata('name')."</h3><br />";
		echo 	"<p>Vous êtes bien connecté. Vous pouvez dorénavant commencer à écrire vos <a href='".base_url('journal/index')."'>journaux</a>.</p>";
		echo 	"<p>Je vous souhaite une bonne visite !</p>";
	?>
</article>