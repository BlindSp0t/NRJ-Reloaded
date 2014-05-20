<h1 class="datas">/neron/root/statistics/</h1>
<article>
	<div>
		<h3>Statistiques</h3>
		<p>Il y a actuellement <span class="light"><?php echo $nbUser->nb_users; ?></span> utilisateurs enregistrés. Parmis eux, <span class="light"><?php echo $activeUsers->nb_user; ?></span> ont écrit au moins 1 journal.<br />
		
		Ils ont créés <span class="light"><?php echo $nbDiaries->nb_diaries; ?></span> journaux (dont <span class="red"><?php echo $nbFinishedDiaries->nb_finished_diaries; ?></span> publics).<br />
		Il y a <span class="light"><?php echo $nbEntries->nb_entries; ?></span> entrées pour ces journaux.<br /><br />

		Cela fait donc <span class="light"><?php echo round($nbDiaries->nb_diaries/$nbUser->nb_users,2); ?></span> journaux par utilisateur, et une moyenne de <span class="light"><?php echo round($nbEntries->nb_entries/$nbDiaries->nb_diaries,2); ?></span> entrées par journal.<br />

		L'utilisateur le plus actif est <span class="light"><a href="<?php echo base_url('users/accueil/'.$mostActiveUser->name); ?>"><?php echo $mostActiveUser->name; ?></a></span> avec pas moins de <span class="red"><?php echo $mostActiveUser->nb_diaries; ?></span> journaux à son actif ! Impressionnant.<br /><br />

		<span class="light"><?php echo $nbShipsDiary->nb_ship; ?></span> boites noires ont été retrouvées, et celle contenant le plus de journaux est la 
		n°<span class="light"><a href="<?php echo base_url('ship/v/'.$shipMostDiaries->the_end); ?>"><?php echo $shipMostDiaries->the_end; ?></a></span> avec <span class="red"><?php echo $shipMostDiaries->nb_diaries; ?></span> journaux.<br />
		Nos données nous informent également que le vaisseau le plus long est le n°<span class="light"><a href="<?php echo base_url('ship/v/'.$longestShip->the_end); ?>"><?php echo $longestShip->the_end; ?></a></span> 
		avec des enregistrements allant jusqu'au jour <span class="red"><?php echo $longestShip->day; ?></span>. Après ça, les données sont endommagées...<br />

		<h3>Personnages</h3>
		<p>Voici le classement des personnages par nombre de journaux leur étant consacrés :</p>
		<?php
			foreach($characters as $key=>$value)
			{
				echo charac_min($value['img']). " ".$value['name']." - ".$value['nb_diary']." <span class='dark'>journaux</span><br />";
			}
		?>
	</div>
</article>