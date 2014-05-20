function verifDel()
{
	alert();
}

function test(diary_id)
{
	alert('lol');
	var answer = confirm ("Êtes-vous sûr de vouloir supprimer ce journal ? Attention, ceci est définitif.")
	if (answer)
		window.location=<?php echo base_url('journal/delete'); ?> + "/" + diary_id;
}