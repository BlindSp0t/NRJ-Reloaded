<h1 class="datas">/neron/entry/new/</h1>
<article>
	<h3>Nouvelle entrée pour le journal <?php echo $diary->title; ?></h3>
	<div class="entry">
	<?php
	 	echo "<h3>Ajouter une entrée</h3>";

		// building the form
		echo form_open('recup/registerentry');
		$opt = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24,25=>25,26=>26,27=>27,28=>28,29=>29,30=>30);
		if($entries != null)
		{
			foreach($entries as $key=>$value)
			{
				foreach($value as $key2 => $value2)
				{
					unset($opt[$value2]);
				}
			}
		}
		echo '<div class="input select required">Sélectionnez le jour de l\'entrée : '.form_dropdown('day',$opt,'','id="day"').'</div><br />';
		echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red<//span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
		$att = array('id'=>'text','rows'=>25,'cols'=>60,'name'=>'text');
		echo '<div class="input textarea required">'.form_textarea($att)."</div><br />";
		$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Enregistrer');
		echo '<div class="submit">'.form_input($att).'</div>';
		
		echo form_close();
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