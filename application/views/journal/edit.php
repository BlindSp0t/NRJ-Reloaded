<h1 class="datas">/neron/data/edit/</h1>
<article>
	<div class="entry">
		<h3> Partager le journal </h3>
		<p>Copiez-collez l'url suivante dans vos résumés de fin de partie sur Mush pour partager votre journal avec vos compagnons de route.</p>
		<input type="text" value="http://nrj-reloaded.fr/ship/v/<?php echo $diary->the_end; ?>" size="35" />
		<br /><br />

	<?php
		echo "<h3> Modifier le journal ".$diary->title."</h3>";
		// get required values
		$lw = $diary->last_will;
		$theEnd = $diary->the_end;
		if ($theEnd == null) $theEnd = "";

		// hidden fields necessary for insert/edit
		$hidden = array('id' => $diary->id);

		// open form to edit diary
		echo form_open('journal/edit','',$hidden);
				
		// building form with elements from controller
		$att = array('type'=>'text','id'=>'title','size'=>35, 'name'=>'title', 'value'=>$diary->title);
		echo 'Titre : '.form_input($att);
		echo '<br /><br />';
		$att = array('type'=>'number', 'id'=>'the_end','name'=>'the_end','maxvalue'=>99999,'value'=>$theEnd);
		echo '<div class="input number required"><label>Code theEnd : </label>'.form_input($att)."</div><br />";
		echo '<br />';
		$att = array('id'=>'lastWill','rows'=>15,'cols'=>60,'name'=>'lastWill','value'=>$lw);
		echo '<div class="input textarea required"><label>Vos derniers mots ? </label><br />';
		echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red</span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
		echo '<br />'.form_textarea($att)."</div><br />";
		echo '<br />';
		$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Modifier');
		echo '<div class="submit">'.form_input($att).'</div>';
		
		echo form_close();
	?>
	</div>
	<br />
	<h3> Supprimer le journal </h3>
	<a title="supprimer ce journal" href="#" onclick='verifDel(<?php echo $diary->id; ?>);'>> neron: $burn(diary);<?php echo img('fire.png',"supprimer ce journal"); ?></a>
	<br />
	<h3> Cacher/Afficher le journal </h3>
	<?php
		if($diary->visible == true)
		{
			$link_show = '<a title="rendre le journal invisible" href="'.base_url('journal/hide'.'/'.$diary->id).'">> neron: \$hide(diary);'.img('invisible.png',"rendre le journal invisible").'</a>';
		}
		else
		{
			$link_show = '<a title="rendre le journal visible" href="'.base_url('journal/show'.'/'.$diary->id).'">> neron: \$show(diary);'.img('visible.png',"rendre le journal visible").'</a>';
		}
		echo $link_show;
	?>
</article>

<script type="text/javascript">
	function wrapTag(tag) {
	  var textarea = document.getElementById('lastWill');
	  wrapText(textarea, tag , tag);
	}
	
	function wrapText(element, pre_text, post_text) {
		if (element.setSelectionRange) {
			var start = element.selectionStart;
			var end = element.selectionEnd;
			element.value = element.value.substr(0, start) + pre_text + element.value.substr(start, end - start) + post_text + element.value.substr(end, element.value.length);
			setSelectionRange(element, start + pre_text.length, end + pre_text.length);
		}
		else if (document.selection) {
			element.focus();
			var range = document.selection.createRange();
			if (range.parentElement() != element)
				return;
			var len = range.text.length;
			range.text = pre_text + range.text + post_text;
			range.moveEnd('character', -post_text.length);
			range.moveStart('character', -len);
			range.select();
		}
		else {
			element.value += pre_text + post_text;
		}
	}
	function verifDel(id)
	{
		var test = confirm("Êtes-vous sûr de vouloir supprimer ce journal ? Ceci est définitif.");
		if(test) document.location.href = "<?php echo base_url('journal/delete'); ?>" + "/" + id;

	}
</script>