
<?php
	$first_day = array(0);
	$lw = $diary->last_will;
	$theEnd = $diary->the_end;
?>
<h1 class="datas">/neron/data/display/</h1>
<article>
	<div id="equipage-consulter">
	    <div style="clear:right;"></div>
	    <?php 
	    	echo "<h3>- Partie N°<a href='".base_url('ship/v/'.$theEnd)."'>".$theEnd."</a><br />-- ".$diary->title." par ".$user->name.'<br />--- <a target="_blank" href="http://www.mush.vg/theEnd/'.$theEnd.'"><span class="red">[</span>Palmarès<span class="red">]</span></a></h3>';
	    ?>
	    <div class="jour-content">
	    	<div class="role">
	    		<?php echo charac_img($character->img).'<img src="'.img_url('surgrille.gif').'" class="grille" alt="" /><br />'.$character->name; ?>
		</div>
	<div class="systeme_days">
		<div class="days">
			<?php
				if($entries != false)
				{
					foreach($entries as $key=>$value)
					{
						$first_day[$key] = $value['day'];
						echo '<span class="day_0 day user" id="day_'.$value['day'].'" onclick="change_day('.$value['day'].');">Jour '.$value['day'].'</span>';
					}
					if(isset($day) && in_array($day, $first_day)) $first_day[0] = $day;
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
			?>
		</div>
		<!-- Ensemble des onglets -->
		<?php
			if($entries != false)
			{
				foreach($entries as $key=>$value)
				{
					echo '<div class="content_days">';
					echo '	<div class="content_day" id="content_day_'.$value['day'].'">';
					echo '		<p class="datas">'.nl2br($this->dMdl->formatText($value['text'])).'</p>';
					echo '	</div>';
					echo '</div>';
				}
			}
			else
			{
				echo '<div class="content_days">';
				echo '	<div class="content_day" id="content_day_0">';
				echo '		<p class="datas">Aucune entrée pour ce journal.</p>';
				echo '	</div>';
				echo '</div>';
			}
			// if neeeded, show last words
			if($lw != "")
			{
				echo '<div class="content_days">';
				echo '	<div class="content_day" id="content_day_lastWill">';
				echo '		<p class="datas">'.nl2br($this->dMdl->formatText($lw)).'</p>';
				echo '	</div>';
				echo '</div>';
			}
		?>
		<div class="days">
			<?php
				if($entries != false)
				{
					foreach($entries as $key=>$value)
					{
						$first_day[$key] = $value['day'];
						echo '<span class="day_2 daybottom user" id="day_'.$value['day'].'_2" onclick="change_day('.$value['day'].');">Jour '.$value['day'].'</span>';
					}
					if(isset($day) && in_array($day, $first_day)) $first_day[0] = $day;
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
			?>
		</div>
	</div>
</article>
<script type="text/javascript">
//<!--
		var anc_day = <?php echo $first_day[0]; ?>;
		change_day(anc_day);
//-->
</script>

