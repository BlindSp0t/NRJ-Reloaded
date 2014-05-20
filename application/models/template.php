<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Model
{
	public function hash_mdp($mdp)
	{
		return strtoupper(hash('whirlpool', $mdp));
	}
	
	public function get_characters()
	{
		$sql = "SELECT `id`,`name`,`img`
				FROM	`character`
				;";
		$query = $this->db->query($sql);
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();
		
		return 0;
		/*$data = array(
					"id" => array(1,2,3,4,5,6),
					"name" => array("Kim Jin Su","Janice Kent","Zhong Chun","Pamela Rose","Gioele Rinaldo","Terrence Archer"),
					"img" => array("kim_jin_su.jpg","janice_kent.jpg","zhong_chun.jpg","paola_rinaldo.jpg","gioele_rinaldo.jpg","terrence_archer.jpg")
					);
		return $data;*/
	}
	
	/*public function connection($code, $mdp)
	{
		$sql = "SELECT	*
				FROM	`user`
				WHERE	`code_user` = ?
				AND		`password_user` = ?
				;";
					
		// Values will be automatically escaped
		$data = array($code, $mdp);
		
		//	Launch the request
		$query = $this->db->query($sql, $data);

		//	Get number of results
		$nb_resultat = $query->num_rows();
		
		//	Free the memory (highly recommanded before launching another request)
		$query->free_result();
		
		//  Send the result
		if($nb_resultat != 1)
		{
			return false;
		}
		
		return true;
	}*/
}
/* End of file template.php */
/* Location: ./application/models/template.php */