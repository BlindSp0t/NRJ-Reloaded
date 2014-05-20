<h1>/neron/user/data/</h1>
<article>
	<h2>Les mémoires de <?php echo $this->session->userdata('name'); ?></h2>
	<h4>
		Votre dernier journal en cours</h4>
		<?php
			if($last_diary == false)
			{
				echo "Vous n'avez pas de journal en cours.<br />";
				echo "<a href='".base_url('journal/newdiary')."'><span class='red'>[</span>Créer un nouveau journal ?<span class='red'>]</span></a>";
			}
			else
			{
				foreach($last_diary as $key => $value)
				{
					if($value['title'] != "")
					{
						echo "<a href=".base_url('journal/v/')."/".$value['id'].">".$value['title']."</a> - ".charac_min($value['img']); 
					}
					else 
					{
						echo "<a href=".base_url('journal/v/')."/".$value['id'].">Sans titre</a> - ".charac_min($value['img']);
					}
				}
				echo " - <span class='red'>[</span><a href=".base_url('journal/entry/')."/".$value['id'].">Continuer</a><span class='red'>]</span> <span class='red'>[</span><a href=".base_url('journal/end/')."/".$value['id'].">Terminer</a><span class='red'>]</span>";
				echo '<p>Vous devez terminer ce journal avant de pouvoir en commencer un nouveau.</p>';
			}
		?>
	<h3>
		Vos précédents journaux</h3>
		<?php
			if($diaries == false)
			{
				echo "Vous n'avez terminé aucun journal à ce jour.";
			}
			else
			{
				$i = 0;
				$diaryEdit = null;
				$diaryFinished = null;
				foreach($diaries as $key => $value)
				{
					$i++;
					if($value['the_end'] == null || !is_numeric($value['the_end']) || ($value['the_end'] < 10000 || $value['the_end'] > 999999))
					{
						$diaryEdit[$i] = $value;
					}
					else
					{
						$diaryFinished[$i] = $value;
					}
				}

				echo "<h4>Journaux non publics</h4>";
				if($diaryEdit == null)
				{
					echo "Vous n'avez aucun journal non public.";
				}
				else
				{
					foreach ($diaryEdit as $key=>$value)
					{
						if($value['title'] == "" || $value['title'] == null)
						{
							$value['title'] = "Sans titre";
						}
						if($value['visible'] == true)
						{
							//$link_show = '<a title="rendre le journal invisible" href="'.base_url('journal/hide'.'/'.$value['id']).'">'.img('invisible.png',"rendre le journal invisible").'</a>';
						}
						else
						{
							//$link_show = '<a title="rendre le journal visible" href="'.base_url('journal/show'.'/'.$value['id']).'">'.img('visible.png',"rendre le journal visible").'</a>';
							$value['title'] = img('invisible.png',"journal invisible").'<s>'.$value['title'].'</s>';
						}
						?>
						<?php echo $i; ?>. <a class="red" href="<?php echo base_url('journal/v/').'/'.$value['id']; ?>"><?php echo $value['title']; ?></a>
						 - <?php echo charac_min($value['img']); ?> - 
						<em>(<?php echo date('d/m/Y', strtotime($value['dt_end'])); ?>)</em><br /><a href="<?php echo base_url('journal/e/'); ?>/<?php echo $value['id']; ?>">
						<?php echo img('pa_eng.png'); ?> Edit <?php echo img('pa_eng.png'); ?></a><br />
						<br /><br />
						
						<?php /*<?php echo $link_show; ?><a title="supprimer ce journal" href="#" onclick='verifDel(<?php echo $value['id']; ?>);'><?php echo img('fire.png',"supprimer ce journal"); ?></a> */
						$i--;
					}
				}
				echo "<br /><h4>Journaux publics</h4>";
				if($diaryFinished == null)
				{
					echo "Vous n'avez aucun journal non public.";
				}
				else
				{
					foreach($diaryFinished as $key => $value)
					{
						if($value['title'] == "" || $value['title'] == null)
						{
							$value['title'] = "Sans titre";
						}
						if($value['visible'] == true)
						{
							//$link_show = '<a title="rendre le journal invisible" href="'.base_url('journal/hide'.'/'.$value['id']).'">'.img('invisible.png',"rendre le journal invisible").'</a>';
						}
						else
						{
							//$link_show = '<a title="rendre le journal visible" href="'.base_url('journal/show'.'/'.$value['id']).'">'.img('visible.png',"rendre le journal visible").'</a>';
							$value['title'] = img('invisible.png',"journal invisible").'<s>'.$value['title'].'</s>';
						}
						?>
						<?php echo $i; ?>. <a class="red" href="<?php echo base_url('journal/v/').'/'.$value['id']; ?>"><?php echo $value['title']; ?></a>
						 - <?php echo charac_min($value['img']); ?> - 
						<em>(<?php echo date('d/m/Y', strtotime($value['dt_end'])); ?>)</em><br /><a href="<?php echo base_url('journal/e/'); ?>/<?php echo $value['id']; ?>">
						<?php echo img('pa_eng.png'); ?> Edit <?php echo img('pa_eng.png'); ?></a><br />
						><a href="<?php echo base_url('ship/v/'.$value['the_end']); ?>">Consulter le journal public</a><br />
						><a href="http://mush.vg/theEnd/<?php echo$value['the_end']; ?>" style='text-decoration:none;background-color:#003F1F'>id\$theEnd\<?php echo $value['the_end']; ?></a>
						<br /><br />
						
						<?php /*<?php echo $link_show; ?><a title="supprimer ce journal" href="#" onclick='verifDel(<?php echo $value['id']; ?>);'><?php echo img('fire.png',"supprimer ce journal"); ?></a> */
						$i--;
					}
				}
			}
		?>
		<script type="text/javascript">
			function verifDel(id)
			{
				var test = confirm("Êtes-vous sûr de vouloir supprimer ce journal ? Ceci est définitif.");
				if(test) document.location.href = "<?php echo base_url('journal/delete'); ?>" + "/" + id;

			}
		</script>
	<p id="test"></p>
</article>