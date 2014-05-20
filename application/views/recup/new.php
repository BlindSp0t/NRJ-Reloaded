<h1 class="datas">/neron/data/new/</h1>
<article>
	<div class="entry">
	<p>
		<?php 
			
			echo form_open('recup/create');
				
			// building form with elements from controller
			
			$att = "";
			foreach ($characters as $key => $value)
			{
				$nom = explode('.',$value['img']);
				$nom = $nom[0]."_nrj.png";
				$att[$nom] = $value['name'];
			}
			$js = 'id="Personnages" onchange="VerifListe();"';
			echo '<div class="input select required">Sélectionnez votre personnage : '.form_dropdown('Personnages',$att,'',$js).'</div><br /><br />';
			$att = array('type'=>'text','id'=>'title','size'=>35, 'name'=>'title');
			echo '<div class="input text">Titre du journal : '.form_input($att).'</div><br />';
			$att = array('id'=>'theEnd','name'=>'theEnd','type'=>'number','size'=>6,'max'=>999999, 'required'=>'required');
			echo '<div class="input number required"><label>Code theEnd : </label>'.form_input($att)."</div><br />";
			echo '<div class="input textarea required"><label>Vos derniers mots ? </label><br />';
			echo '<button type="button" onclick="wrapTag('."'**'".');"><span class="light">light</span></button><button type="button" onclick="wrapTag('."'//'".');"><span class="red">red</span></button><button type="button" onclick="wrapTag('."'--'".');"><s>strike</s></button>';
			$att = array('id'=>'lastWill','rows'=>25,'cols'=>60,'name'=>'lastWill');
			echo '<br />'.form_textarea($att)."<br /></div>";
			$att = array('type'=>'submit', 'class'=>'submit', 'value'=>'Créer');
			echo '<div class="submit">'.form_input($att).'</div>';
			
			echo form_close();
		?>
	</p>
	</div>
	<div class="role">
		<img id="imagePerso" src='<?php echo base_url(); ?>assets/img/kim_jin_su_nrj.png'></img><img src="<?php echo img_url('surgrille.gif'); ?>" class="grille" alt="" />
	</div>
</article>
<script type="text/javascript">
function VerifListe()
{
   var ObjListe = document.getElementById('Personnages');
   var SelIndex = ObjListe.selectedIndex;
   var SelValue = ObjListe.options[ObjListe.selectedIndex].value;
   var SelText = ObjListe.options[ObjListe.selectedIndex].text;
   document.getElementById("imagePerso").src = "../assets/img/" + SelValue;
}

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