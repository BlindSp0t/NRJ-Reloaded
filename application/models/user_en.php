<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_en extends CI_Model
{
	// return all infos on a specific user by his id
	public function getUserById($id)
	{
		$sql = "SELECT *
				FROM	`nrjen_user`
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
				FROM	`nrjen_user`
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
				FROM	`nrjen_user`
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
		$sql = "INSERT INTO `nrjen_user` (`name`,`locale`,`twin_id`)
				VALUES(?,?,?);";
		
		$data = array($name, $locale, $twinId);
		
		$query = $this->db->query($sql, $data);
		
		return $this->db->insert_id();
	}

	// update username if changed on Twinoïd
	public function updateUserName($id, $name)
	{
		$sql = "UPDATE `nrjen_user` 
			SET `name` = ?
			WHERE `id` = ?";
		
		$data = array($name, $id);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}

	// create connection string
	public function connection($id, $string)
	{
		$sql = "INSERT INTO `nrjen_connection` (`user_id`,`string`,`date`)
				VALUES(?,?, CURRENT_TIMESTAMP());";
		
		$data = array($id, $string);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */