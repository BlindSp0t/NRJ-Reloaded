<h1 class="datas">/neron/logs/character/</h1>
<article>
<h3>Les journaux concernant <?php echo charac_min($character->img).' '.$character->name; ?></h3>

	<?php
		if($diaries == false)
		{
			echo "Il n'y a aucun journal terminé à ce jour.";
		}
		else
		{
			$i = 0;
			foreach($diaries as $key => $value)
			{
				$i++;
			}
			foreach($diaries as $key => $value)
			{
				if($value['title'] != "")
				{
					echo $i.". <a class='red' href=".base_url('journal/v/')."/".$value['id'].">".$value['title']."</a> par ".$value['username']." "." <em>(".date('d/m/Y', strtotime($value['dt_end'])).")</em> ><a href='http://mush.vg/theEnd/".$value['the_end']."' style='text-decoration:none;background-color:#003F1F'>id\$theEnd\\".$value['the_end']."</a><br />Journal constitué de ".$value['nb_entry']." entrées terminé au jour ".$value['max_day'].".<br />><a href='".base_url('ship/v/'.$value['the_end'])."'>Consulter le journal public</a><br /><br />"; 
				}
				else 
				{
					echo $i.". <a class='red' href=".base_url('journal/v/')."/".$value['id'].">".$value['username']." "." <em>(".date('d/m/Y', strtotime($value['dt_end'])).")</em> ><a href='http://mush.vg/theEnd/".$value['the_end']."' style='text-decoration:none;background-color:#003F1F'>id\$theEnd\\".$value['the_end']."</a><br />Journal constitué de ".$value['nb_entry']." entrées terminé au jour ".$value['max_day'].".<br />><a href='".base_url('ship/v/'.$value['the_end'])."'>Consulter le journal public</a><br /><br />"; 
				}
				$i--;
			}
		}
	?>

</article>