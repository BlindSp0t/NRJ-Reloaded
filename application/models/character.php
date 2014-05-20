<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Character extends CI_Model
{
	// return all infos on characters
	public function getCharacters()
	{
		$sql = "SELECT `id`,`name`,`img`
				FROM	`character`
				WHERE `name` != 'Mush'
				;";
		$query = $this->db->query($sql);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();
		
		return 0;
	}
	
	// return infos on a specific character
	public function getCharacter($id)
	{
		$sql = "SELECT *
				FROM `character`
				WHERE `id` = ?
				;";
		
		$data = array($id);
		
		$query = $this->db->query($sql,$data);
		
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->row();
		}
		$query->free_result();
		return false;
	}
	
	// return id of a character by img url
	public function getIdByImg($img)
	{
		$sql = 'SELECT *
				FROM `character`
				WHERE `img` = ?
				;';
		$data = array($img);

		$query = $this->db->query($sql, $data);

		return $query->row();
	}
	
}
/* End of file character.php */
/* Location: ./application/models/character.php */