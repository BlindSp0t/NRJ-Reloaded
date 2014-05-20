<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{
	// return all infos on a specific user by his id
	public function getUserById($id)
	{
		$sql = "SELECT *
				FROM	`user`
				WHERE `id` = ?
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->row();
		}
		$query->free_result();
		
		return false;
	}

	// return all infos on a specific user by his twinoid id
	public function getUserByTwinId($id)
	{
		$sql = "SELECT *
				FROM	`user`
				WHERE `twin_id` = ?
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->row();
		}
		$query->free_result();
		
		return false;
	}
	
	// return all infos on a specific user by his name
	public function getUserByName($name)
	{
		$sql = "SELECT *
				FROM	`user`
				WHERE `name` = ?
				;";
		$data = array($name);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->row();
		}
		$query->free_result();
		
		return false;
	}

	// register new user
	public function register($name, $locale, $twinId)
	{
		$sql = "INSERT INTO `user` (`name`,`locale`,`twin_id`)
				VALUES(?,?,?);";
		
		$data = array($name, $locale, $twinId);
		
		$query = $this->db->query($sql, $data);
		
		return $this->db->insert_id();
	}

	// update username if changed on Twinoïd
	public function updateUserName($id, $name)
	{
		$sql = "UPDATE `user` 
			SET `name` = ?
			WHERE `id` = ?";
		
		$data = array($name, $id);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */