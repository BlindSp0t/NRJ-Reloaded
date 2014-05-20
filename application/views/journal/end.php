<h1 class="datas">/neron/data/terminate/</h1>
<article>
	<h3>Terminer le journal</h3>
	<div class="entry">
	<?php 
		// hidden fields necessary for insert/edit
		$hidden = array('id' => $id);

		// building the form
		echo form_open('journal/finish','',$hidden);
		
		$att = array('id'=>'theEnd','name'=>'theEnd','type'=>'number','size'=>6,'max'=>999999);
		echo '<div class="input number required"><label>Code theEnd : </label>'.form_input($att)."</div><br />";
		echo '<div class="input textarea required"><label>Vos derniers mots ? </label><br />';
		echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red</span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
		$att = array('id'=>'lastWill','rows'=>25,'cols'=>60,'name'=>'lastWill');
		echo '<br />'.form_textarea($att)."<br /></div>";
		$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Terminer');
		echo '<div class="submit">'.form_input($att).'</div>';
		echo "<br /><p>Attention, terminer un journal est définitif. Vous ne pourrez ni modifier, ni ajouter d'entrées une fois un journal terminé.</p>";
		echo form_close();
	?>
	</div>
	<br />
	<h3>Partager le journal</h3>
	<div class="entry">
		<p>Vous pouvez partager votre journal avec vos partenaires de jeux au moment de la validation de votre mort en copiant l'adresse ci-dessous :</p>
		<?php
		$att = array('id'=>'code','type'=>'text','value'=>'http://www.nrj-reloaded.fr/journal/v/'.$id, 'size'=>60);
		echo '<div class="input text required">'.form_input($att).'</div>';
		?>
	</div>
</article>

<script type="text/javascript">
	function wrapTag(tag) {
	  var textarea = document.getElementById('lastWill');
	  wrapText(textarea, tag, tag);
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
</script>