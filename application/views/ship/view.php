
<h1 class="datas">/neron/data/ship/</h1>
<article>
	<div id="equipage-consulter">
	    <div style="clear:right;"></div>
	    <?php echo "<h3>Vaisseau N°".$theEnd."</h3>"; ?>
	    <div class="jour-content">
	    	
		<?php
			foreach($diaries as $key=>$value)
			{
				echo '<div class="role">'.charac_img($value['img']).'<img src="'.img_url('surgrille.gif').'" class="grille" alt="" /></div>';
				$lw[$key] = $value['last_will'];
				$user[$key]['name'] = $value['username'];
				$user[$key]['id'] = $value['user_id'];
				$user[$key]['diary_name'] = $value['title'];
				$user[$key]['diary_id'] = $value['id'];
				$user[$key]['lw'] = $value['last_will'];
				$user[$key]['img'] = $value['img'];
				$user[$key]['charname'] = $value['charname'];
				if($entries != false)
				{
					foreach($entries as $key1=>$value1)
					{
						if($value1 != false)
						{
							foreach($value1 as $key2=>$value2)
							{
								if($value['id'] == $value2['diary_id'])
								{
									$entries[$key1][$key2]['username'] = $value['username'];
									$entries[$key1][$key2]['img'] = $value['img'];
									$entries[$key1][$key2]['charname'] = $value['charname'];
								}
							}
						}
					}
				}
			}
			$first_day = 100;
			$days = array();
		?>
		<div style="clear:both"></div>
		<br />
		<span class="red">Cliquez sur le nom des personnages pour afficher leur journal</span>
		<br />
		<br /><br />
		<div class="systeme_days">
			<div class="days">
				<?php
					if($entries != false)
					{
						foreach($entries as $key1=>$value1)
						{
							if($value1 != false)
							{
								foreach($value1 as $key=>$value)
								{
									$test = false;
									$key3 = 0;
									foreach ($days as $key2 => $value2)
									{
										if ($value['day'] == $value2) 
										{
											$test = true;
										}
										$key3++;
									}
									if(!$test) $days[$key3] = $value['day'];
								}
							}
						}
						asort($days);
						foreach($days as $key=>$value)
						{
							echo '<span class="day_0 day user" id="day_'.$value.'" onclick="change_day('.$value.');">Jour '.$value.'</span>';
							if($value < $first_day) $first_day = $value;
						}
					}

					else
					{
						echo '<span class="day_0 day user" id="day_0" onclick="change_day(0);">Jour 0</span>';
					}
					// if needed, show last words window
					if($lw != "")
					{
						echo '<span class="day_0 day user" id="day_lastWill" onclick="change_day('."'lastWill'".');">Derniers Mots</span>';
					}
					if($theEnd != null)
					{
						echo '<span class="day_0 day user" id="day_infos" onclick="change_day('."'infos'".');">Infos</span>';
					}
				?>
			</div>
			<!-- Ensemble des onglets -->
			<?php
				if($entries != false)
				{
					$i = 1;
					foreach($days as $key => $value)
					{	
						echo '<div class="content_days">';
						echo '	<div class="content_day" id="content_day_'.$value.'">';
						foreach($entries as $key2 => $value2)
						{
							if($value2 != false)
							{
								foreach($value2 as $key3 => $value3)
								{
									if($value == $value3['day'])
									{
										echo '<fieldset><legend class="clasp"><a id="clasp_'.$i.'" href="javascript:lunchboxOpen('.$i.');">'.charac_min($value3['img']).' '.$value3['charname'].'</a></legend><div id="lunch_'.$i.'" class="lunchbox"><p class="datas">'.nl2br($this->dMdl->formatText($value3['text'])).'</p></div><a id="link_'.$i.'" href="javascript:lunchboxOpen('.$i.');">Dérouler</a></fieldset>';
										$i++;
									}
								}
							}
						}
						echo '	</div>';
						echo '</div>';
					}
				}
				if($lw != "")
				{
					echo '<div class="content_days">';
					echo '	<div class="content_day" id="content_day_lastWill">';
					foreach ($user as $key => $value)
					{
						if($value['lw'] != "")
						{
							echo '		<fieldset><legend class="clasp"><a id="clasp_'.$i.'" href="javascript:lunchboxOpen('.$i.');">'.charac_min($value['img']).' '.$value['charname'].'</a></legend><div id="lunch_'.$i.'" class="lunchbox"><p class="datas">'.nl2br($this->dMdl->formatText($value['lw'])).'</p></div><a id="link_'.$i.'" href="javascript:lunchboxOpen('.$i.');">Dérouler</a></fieldset>';
							$i++;
						}
					}

					echo '	</div>';
					echo '</div>';	
				}
				if($theEnd != null)
				{
					echo '<div class="content_days">';
					echo '	<div class="content_day" id="content_day_infos">';
					echo '		<p><a target="_blank" href="http://www.mush.vg/theEnd/'.$theEnd.'">Voir le palmarès du vaisseau.</a></p>';
					echo "		<p>Personnes ayant participé à ce vaisseau :</p>";
					foreach ($user as $key => $value)
					{
						echo '<a href="'.base_url('users/id'.'/'.$value['id']).'">'.charac_min($value['img']).' '.$value['name'].'</a> - <a href="'.base_url('journal/v'.'/'.$value['diary_id']).'">'.$value['diary_name'].'</a><br />';
					}
					echo '	</div>';
					echo '</div>';
				}
			?>
		</div>
		<div class="days">
				<?php
					if($entries != false)
					{
						foreach($entries as $key1=>$value1)
						{
							if($value1 != false)
							{
								foreach($value1 as $key=>$value)
								{
									$test = false;
									$key3 = 0;
									foreach ($days as $key2 => $value2)
									{
										if ($value['day'] == $value2) 
										{
											$test = true;
										}
										$key3++;
									}
									if(!$test) $days[$key3] = $value['day'];
								}
							}
						}
						asort($days);
						foreach($days as $key=>$value)
						{
							echo '<span class="day_2 daybottom user" id="day_'.$value.'_2" onclick="change_day('.$value.');">Jour '.$value.'</span>';
							if($value < $first_day) $first_day = $value;
						}
					}

					else
					{
						echo '<span class="day_2 daybottom user" id="day_0_2" onclick="change_day(0);">Jour 0</span>';
					}
					// if needed, show last words window
					if($lw != "")
					{
						echo '<span class="day_2 daybottom user" id="day_lastWill_2" onclick="change_day('."'lastWill'".');">Derniers Mots</span>';
					}
					if($theEnd != null)
					{
						echo '<span class="day_2 daybottom user" id="day_infos_2" onclick="change_day('."'infos'".');">Infos</span>';
					}
				?>
			</div>
	</div>
</article>
<script type="text/javascript">
//<!--
		var anc_day = <?php echo $first_day; ?>;
		change_day(anc_day);
//-->

	function lunchboxOpen(lunchID) {
		document.getElementById('lunch_' + lunchID).style.display = "block";
		document.getElementById('clasp_' + lunchID).href = "javascript:lunchboxClose('" + lunchID + "');";
		document.getElementById('link_' + lunchID).innerHTML="<a href=\"javascript:lunchboxClose('" + lunchID + "');\">Cacher</a>";
	}
	function lunchboxClose(lunchID) {
		document.getElementById('lunch_' + lunchID).style.display = "none";
		document.getElementById('clasp_' + lunchID).href = "javascript:lunchboxOpen('" + lunchID + "');";
		document.getElementById('link_' + lunchID).innerHTML="<a href=\"javascript:lunchboxOpen('" + lunchID + "');\">Dérouler</a>";
	} 
</script>