<h1 class="datas">/neron/data/new/</h1>
<article>
	<div class="entry">
	<p>
		<?php 
			
			echo form_open('journal/create');
				
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
			$opt = array(0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>10,10=>11,11=>12,12=>13,13=>14,14=>15);
			echo '<div class="input select required">Sélectionnez le jour de départ du journal : '.form_dropdown('day',$opt,'','id="day"').'</div><br />';
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
</script> 