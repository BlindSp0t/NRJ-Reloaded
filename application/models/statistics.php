<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends CI_Model
{
	// get number of users
	public function nbUsers()
	{
		$sql = "SELECT COUNT(*) as `nb_users`
				FROM	`user`
				WHERE `name` != 'Admin'
				;";

		$query = $this->db->query($sql);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->row();
		}

		$query->free_result();
		
		return false;
	}
	
	// get number of overall diaries
	public function nbDiaries()
	{
		$sql = "SELECT COUNT(*) as `nb_diaries`
				FROM `diary`
				;";
		
		
		$query = $this->db->query($sql);
		
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->row();
		}

		$query->free_result();

		return false;
	}

	// get number of finished diaries
	public function nbFinishedDiaries()
	{
		$sql = "SELECT COUNT(*) as `nb_finished_diaries`
				FROM `diary`
				WHERE `finished` = TRUE
				AND `visible` = TRUE
				AND (`the_end` BETWEEN 10000 AND 999999)
				;";
		
		
		$query = $this->db->query($sql);
		
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->row();
		}

		$query->free_result();

		return false;
	}
	
	// get number of entries
	public function nbEntries()
	{
		$sql = 'SELECT COUNT(*) as `nb_entries`
				FROM `entry`
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get number of ships having a diary
	public function nbShipsWithDiary()
	{
		$sql = 'SELECT COUNT(*) as `nb_ship`
				FROM (	SELECT count(*) as `diaries`
						FROM `diary`
						WHERE `the_end` BETWEEN 10000 AND 999999
						GROUP BY `the_end`) as `diary_by_ship`
				WHERE `diaries` > 0
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get number of diaries for the biggest ship
	public function shipMostDiaries()
	{
		$sql = 'SELECT `the_end`, count(*) as `nb_diaries`
				FROM `diary`
				WHERE `the_end` BETWEEN 10000 AND 999999
				GROUP BY `the_end`
				HAVING count(*) >= ALL (SELECT count(*)
                    					FROM `diary`
										WHERE `the_end` BETWEEN 10000 AND 999999
                   						GROUP BY `the_end`)
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get number of users with at least one diary
	public function nbUsersActive()
	{
		$sql = 'SELECT COUNT(*) as `nb_user`
				FROM `user`
				WHERE `id` IN (SELECT `user_id`
								FROM `diary`
								GROUP BY `user_id`)
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get name and number of diaries for the most proficient user
	public function getMostActiveUser()
	{
		$sql = 'SELECT `name`, COUNT(*) as `nb_diaries`
				FROM `user` JOIN `diary` ON `user`.`id` = `diary`.`user_id`
				WHERE `finished` = TRUE
				GROUP BY `user_id`
				HAVING count(*) >= ALL (SELECT count(*)
										FROM `diary`
										WHERE `finished` = TRUE
										GROUP BY `user_id`)
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get longest ship
	public function getLongestShip()
	{
		$sql = 'SELECT `the_end`, MAX(`day`) as `day`
				FROM `diary` JOIN `entry` ON `diary`.`id` = `entry`.`diary_id`
				GROUP BY `the_end`
				HAVING MAX(`day`) >= ALL (	SELECT MAX(`day`)
											FROM `diary` JOIN `entry` ON `diary`.`id` = `entry`.`diary_id`
											WHERE `diary`.`finished` = TRUE
											GROUP BY `the_end`)
				;';

		$query = $this->db->query($sql);

		return $query->row();
	}

	// get characters stats
	public function getCharactersStats()
	{
		$sql = 'SELECT `character`.`name`,`character`.`img`, COUNT(`diary`.`id`) as `nb_diary`
				FROM `diary` JOIN `character` ON `diary`.`character_id` = `character`.`id`
				WHERE `diary`.`finished` = TRUE
				AND `visible` = TRUE
				AND (`the_end` BETWEEN 10000 AND 999999)
				GROUP BY `character_id`
				ORDER BY `nb_diary` DESC
				;';

		$query = $this->db->query($sql);

		return $query->result_array();
	}
}
/* End of file statistics.php */
/* Location: ./application/models/statistics.php */