<section id="menu">
	<article>
        		<h1>/neron/users/</h1>
		<ul>
		<?php 
			$i = 0;
			echo "<li><a href='".base_url('index')."'>".$i.". [BOOT] Démarrage/Accueil</a></li>";
			$i++;
			if($this->session->userdata('id') == null)
			{
				echo "<li><a href='https://twinoid.com/oauth/auth?response_type=code&client_id=112&redirect_uri=http://www.nrj-reloaded.fr/index.php/index/ident&state=true&access_type=online'>".$i.". [LOG] Login as ROOT</a></li>";
				$i++;
			}
			else
			{
				echo '<li><a href="'.base_url('index/deco').'">'.$i.'. [LOG] Shutdown</a></li>';
				$i++;
			}
		?>
		</ul>
	</article>
	<article>
		<h1>/neron/logs/</h1>
		<ul>
		<?php
			if($this->session->userdata('id') == false)
			{
				echo '<li><span class="dark">Veuillez vous authentifier</span></li>';
			}
			else
			{
				echo "<li><a href='".base_url('journal')."'>".$i.". [DATA] Mes Journaux</a></li>";
				$i++;
				if($this->session->userdata('currentDiary') != false)
				{
					echo "<li><a href='".base_url('journal/v/'.$this->session->userdata('currentDiary'))."'>".$i.". [READ] Journal en cours</a></li>";
					$i++;
					echo "<li><a href='".base_url('journal/entry/'.$this->session->userdata('currentDiary'))."'>".$i.". [EDIT] Continuer</a></li>";
					$i++;
					echo "<li><a href='".base_url('journal/end/'.$this->session->userdata('currentDiary'))."'>".$i.". [END] Terminer le journal</a></li>";
					$i++;
				}
				else
				{
					echo "<li><a href='".base_url('journal/newdiary')."'>".$i.". [NEW] Nouveau Journal</a></li>";
					$i++;
				}
				echo "<li><a href='".base_url('recup/index')."'>".$i.". [GET] Récupération</a></li>";
				$i++;
			}
		?>
		</ul>
	</article>
	<article>
		<h1>/neron/data/</h1>
		<ul>
			<?php
				echo "<li><a href=".base_url('search').">".$i.". [FIND] Archives spatiales</a></li>";
				$i++;
				echo "<li><a href=".base_url('search/last').">".$i.". [LAST] Derniers journaux</a></li>";
				$i++;
				echo "<li><a href=".base_url('journal/random').">$. [p[=è] ".$i." ^,,~}[HAX!]</a></li>";
				$i++;
				echo "<li><a href=".base_url('stats').">".$i.". [STAT] Statistiques</a></li>";
				$i++;
			?>
		</ul>
	</article>
	<article>
		<h1>/neron/docs/</h1>
		<ul>
		<?php
			echo '<li><a href="'.base_url('pages/infos').'">'.$i.'. [SAY] Présentation</a></li>';
			$i++;
			echo '<li><a href="'.base_url('pages/man').'">'.$i.'. [MAN] Manuel /n/r/j</a></li>';
			$i++;
			echo '<li><a href="'.base_url('pages/faq').'">'.$i.'. [FAQ] Détails /n/r/j</a></li>';
			$i++;
			echo '<li><a target="_blank" href="http://mush.vg/tid/forum#!view/67061|thread/23072220">'.$i.'. [WEB] Fan-forum</a></li>';
			$i++;
			echo '<li><a target="_blank" href="http://webchat.quakenet.org/?channels=mush">'.$i.'. [SPK] Chat #Mush</a></li>';
			$i++;
			echo '<li><a target="_blank" href="http://en.nrj-reloaded.fr/">'.$i.'. [EN] English version</a></li>';
			$i++;
		?>
		</ul>
	</article>
	<!-- some ugly spacing to put the footer down so the body background doesnt fuck up the design -->
    	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    	<!--<div class="pub">
        	<a href="http://mush.vg/g/nrj-hits-stories-only"><img src="<?php echo img_url('pub_morpion.gif'); ?>" style="width:175px;height:250px;" class="casting-pub" alt="" /></a>    </div>-->
</section>