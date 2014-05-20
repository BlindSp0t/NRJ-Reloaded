<h1 class="datas">/neron/entry/new/</h1>
<article>
	<h3>Nouvelle entrée pour le journal <?php echo $diary->title; ?></h3>
	<div class="entry">
	<?php
	 	echo "<h3>jour ".$day.'</h3>';

	 	// is this a new entry
		if($entry == false)
		{
			// hidden fields necessary for insert/edit
			$hidden = array('diary_id' => $diary->id);

			// building the form
			echo form_open('journal/addentry','',$hidden);
			echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red<//span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
			$att = array('id'=>'text','rows'=>25,'cols'=>60,'name'=>'text');
			echo '<div class="input textarea required">'.form_textarea($att)."</div><br />";
			$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Enregistrer');
			echo '<div class="submit">'.form_input($att).'</div>';
			
			echo form_close();
		}
		// or an old one that needs editing ?
		else
		{
			// hidden fields necessary for insert/edit
			$hidden = array('diary_id'=>$diary->id);
			// building the form
			echo form_open('journal/editentry','',$hidden);
			echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red</span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
			$att = array('id'=>'text','rows'=>25,'cols'=>60,'name'=>'text','value'=>$entry->text);
			echo '<div class="input textarea required">'.form_textarea($att)."</div><br />";
			$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Enregistrer');
			echo '<div class="submit">'.form_input($att).'</div>';
			
			echo form_close();
		}
	?>
	</div>
</article>

<script type="text/javascript">
	function wrapTag(tag) {
	  var textarea = document.getElementById('text');
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