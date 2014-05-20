<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary extends CI_Model
{
	// return all infos on a specific diary
	public function getDiary($id)
	{
		$sql = "	SELECT *
				FROM	`diary`
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

	// return id of a random diary
	public function getRandomDiary()
	{
		$sql = "	SELECT `id`
					FROM `diary`
					WHERE `finished` = TRUE
					AND `visible` = TRUE
					AND (`the_end` BETWEEN 10000 AND 999999)
					ORDER BY RAND()
					LIMIT 1
				;";
		$query = $this->db->query($sql);

		return $query->row();
	}
	
	// return last entry of a specific diary
	public function getLastEntry($id, $diary_start_date)
	{
		$sql = "	SELECT *
				FROM `entry`
				WHERE diary_id = ?
				AND `day` = (SELECT DATEDIFF(NOW(), ?) + 1)
				;";
		
		$data = array($id, $diary_start_date, $id);
		
		$query = $this->db->query($sql,$data);
		
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->row();
		}
		$query->free_result();
		return false;
	}

	// returns day of a specific entry
	public function getDayEntry($id)
	{
		$sql = "	SELECT `day`
					FROM `entry`
					WHERE `id` = ?;";
		$data = array($id);
		
		$query = $this->db->query($sql,$data);
		
		$nb_results = $query->num_rows();
		
		if($nb_results > 0)
		{
			return $query->row()->day;
		}
		$query->free_result();
		return false;
	}

	// returns the number of days between now() and a previous date
	public function numberDays($date)
	{
		$sql = "SELECT DATEDIFF(NOW(), ?) as date;";
		$data = array($date);
		$query = $this->db->query($sql,$data);
		$day = $query->row()->date +1;
		return $day;
	}

	// get last X diaries
	public function getLastXDiaries($nb)
	{
		$sql = "SELECT `diary`.`id` as `id`,`dt_end`,`the_end`,`last_will`,`title`,`character`.`id` as `char_id`,`img`,`user`.`name` as `name`, COUNT(`entry`.`id`) as `nb_entry`, MAX(`entry`.`day`) as `max_day`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id`
				INNER JOIN `user` ON `diary`.`user_id` = `user`.`id`
				LEFT JOIN `entry` ON `diary`.`id` = `entry`.`diary_id`
				WHERE (`the_end` BETWEEN 10000 AND 999999)
				AND `finished` = TRUE
				AND `visible` = TRUE
				GROUP BY `diary`.`id`
				ORDER BY `dt_end` DESC
				LIMIT ?
				;";
		$data = array($nb);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}

		$query->free_result();

		return false;
	}

	// return all my finished diaries
	public function getMyFinishedDiaries($id)
	{
		$sql = "	SELECT `diary`.`id` as `id`,`dt_end`,`the_end`,`last_will`,`title`,`finished`,`visible`,`character`.`id` as `char_id`,`img`,`name`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id`
				WHERE `user_id` = ?
				AND `finished` = TRUE
				ORDER BY `dt_end` DESC
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}

		$query->free_result();

		return false;
	}

	// return all diaries for a specific user
	public function getDiariesByUser($id)
	{
		$sql = "	SELECT `diary`.`id` as `id`, `the_end`,`dt_end`,`last_will`,`title`,`finished`,`visible`,`character`.`id` as `char_id`,`img`,`name`, COUNT(`entry`.`id`) as `nb_entry`, MAX(`entry`.`day`) as `max_day`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id`
				LEFT JOIN `entry` ON `diary`.`id` = `entry`.`diary_id`
				WHERE `user_id` = ?
				AND `finished` = TRUE
				AND `visible` = TRUE
				AND (`the_end` BETWEEN 10000 AND 999999)
				GROUP BY `diary`.`id`
				ORDER BY `dt_end` DESC
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}

		$query->free_result();

		return false;
	}

	// return TRUE if diary belongs to user, FALSE otherwise
	public function isDiaryToUser($idDiary, $idUser)
	{
		$sql = "	SELECT *
				FROM `diary`
				WHERE `user_id` = ?
				AND `id` = ?
				;";
		$data = array($idUser, $idDiary);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		$query->free_result();

		if($nb_results > 0)
		{
			return true;
		}

		return false;
	}
	
	// return all diaries from a specific ship (TheEnd)
	public function getDiariesByShip($theEnd)
	{
		$sql = "	SELECT `diary`.`id` as `id`, `the_end`,`last_will`,`title`,`finished`,`character`.`id` as `char_id`,`img`,`character`.`name` as `charname`, `user`.`id` as `user_id`, `user`.`name` as `username`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id` INNER JOIN `user`
				ON `diary`.`user_id` = `user`.`id`
				WHERE `the_end` = ?
				AND `finished` = TRUE
				AND `visible` = TRUE
				ORDER BY `dt_end` DESC
				;";
		$data = array($theEnd);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();
		
		return false;
	}

	// return all diaries for a specific character
	public function getDiariesByCharacter($id)
	{
		$sql = "	SELECT `diary`.`id` as `id`, `the_end`,`last_will`,`dt_end`,`title`,`finished`,`character`.`id` as `char_id`,`img`,`character`.`name` as `charname`, `user`.`id` as `user_id`, `user`.`name` as `username`, COUNT(`entry`.`id`) as `nb_entry`, MAX(`entry`.`day`) as `max_day`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id` INNER JOIN `user`
				ON `diary`.`user_id` = `user`.`id`
				LEFT JOIN `entry` ON `diary`.`id` = `entry`.`diary_id`
				WHERE (`the_end` BETWEEN 10000 AND 999999)
				AND `finished` = TRUE
				AND `visible` = TRUE
				AND `character`.`id` = ?
				GROUP BY `diary`.`id`
				ORDER BY `dt_end` DESC
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows(); // get nb of results
		
		// in case of mistake
		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();
		
		return false;
	}

	// return last open diary for a specific user
	public function getLastOpenDiary($id)
	{
		$sql = "	SELECT `diary`.`id` as `id`, `the_end`,`last_will`,`title`,`finished`,`character`.`id` as `char_id`,`img`,`name`
				FROM `diary` INNER JOIN `character`
				ON `diary`.`character_id` = `character`.`id`
				WHERE `user_id` = ?
				AND `finished` = FALSE
				AND `dt_start` = (SELECT MAX(`dt_start`)
									FROM `diary`
									WHERE `user_id` = ?
									AND `finished` = FALSE)
				;";
		$data = array($id,$id);
		$query = $this->db->query($sql, $data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();

		return false;
	}
	
	// create new diary
	public function newDiary($userId, $charId, $title, $day)
	{
		$sql = "	INSERT INTO `diary` (`dt_start`,`title`,`character_id`,`user_id`)
				VALUES(NOW() - INTERVAL ? DAY,?,?,?);";
		
		$data = array($day, $title, $charId, $userId);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}

	// check if an entry exists for a specific day in a diary
	public function doesEntryExists($id, $day)
	{
		$sql = "	SELECT *
					FROM `entry`
					WHERE `diary_id` = ?
					AND `day` = ?
					;";
		$data = array($id, $day);

		$query = $this->db->query($sql,$data);

		$count = $query->num_rows();
		if($count > 0)
		{
			return true;
		}
		return false;
	}
	
	// create new entry
	public function addEntry($diaryId, $text, $day)
	{
		$sql = "	INSERT INTO `entry` (`dt_entry`, `day`, `text`, `diary_id`)
				VALUES (NOW(),?,?,?);";
				
		$data = array($day, $text, $diaryId);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}
	
	// update entry
	public function updateEntry($id, $text)
	{
		$sql = "	UPDATE `entry` 
				SET `text` = ?
				WHERE `id` = ?";
				
		$data = array($text, $id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}
	
	// finish diary
	public function finishDiary($id, $lastWill, $theEnd)
	{
		$sql = "	UPDATE `diary`
				SET `last_will` = ?, `the_end` = ?, `dt_end` = NOW(), `finished` = TRUE
				WHERE `id` = ?;";
		
		$data = array($lastWill, $theEnd, $id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}

	// return TRUE if diary is finished, FALSE otherwise
	public function isDiaryFinished($id)
	{
		$sql = "	SELECT *
				FROM `diary`
				WHERE `id` = ?
				AND `finished` = TRUE
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		$query->free_result();

		if($nb_results > 0)
		{
			return true;
		}

		return false;
	}

	// return TRUE if diary is finished, FALSE otherwise
	public function isDiaryViewable($id)
	{
		$sql = "	SELECT *
				FROM `diary`
				WHERE `id` = ?
				AND `finished` = TRUE
				AND `visible` = TRUE
				AND (`the_end` BETWEEN 10000 AND 999999)
				;";
		$data = array($id);
		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		$query->free_result();

		if($nb_results > 0)
		{
			return true;
		}

		return false;
	}

	// make finished diary visible
	public function showDiary($id)
	{
		$sql = "	UPDATE `diary`
				SET `visible` = TRUE
				WHERE `id` = ?;";
		
		$data = array($id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}

	// make finished diary invisible
	public function hideDiary($id)
	{
		$sql = "	UPDATE `diary`
				SET `visible`= FALSE
				WHERE `id` = ?;";
		
		$data = array($id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}

	// delete diary
	public function deleteDiary($id)
	{
		$sql1 = "	DELETE 
					FROM `entry`
					WHERE `diary_id` = ?
				;";
		$sql2 =	"	DELETE
					FROM `diary`
					WHERE `id` = ?
				;";
		$data = array($id);
		
		$this->db->trans_start();
		$this->db->query($sql1,$data);
		$this->db->query($sql2,$data);
		$this->db->trans_complete(); 
		
		return true;
	}

	// get all entries for a specific diary
	public function getEntriesByDiary($id)
	{
		$sql = "	SELECT *
				FROM `entry`
				WHERE `diary_id` = ?
				ORDER BY `day` ASC
				;";
		$data = array($id);
		$query = $this->db->query($sql, $data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();

		return false;
	}

	// edit a diary
	public function updateDiary($id, $last_words, $theEnd, $title)
	{
		$sql = "	UPDATE `diary`
				SET `last_will` = ?, `the_end` = ?, `title` = ?
				WHERE `id` = ?;";
		
		$data = array($last_words, $theEnd, $title, $id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}


	// format text
	public function formatText($text)
	{
		//  bold
		$text = preg_replace('#\*\*(.*)\*\*#Us', '<span class="light" style="display:inline;">$1</span>', $text);
		//  italic
		$text = preg_replace('#\/\/(.*)\/\/#Us', '<span class="red" style="display:inline;">$1</span>', $text);
		//  barre
		$text = preg_replace('#\-\-(.*)\-\-#Us', '<s>$1</s>', $text);
		return $text;
	}

	//
	//
	//   SYSTEME RECUPERATION
	//
	//

	// create new diary recup
	public function newDiaryRecup($userId, $charId, $title, $theEnd, $lastWill)
	{
		$sql = "	INSERT INTO `diary` (`dt_start`,`title`,`character_id`,`user_id`, `the_end`, `last_will`, `finished`)
				VALUES(NOW(),?,?,?,?,?,TRUE);";
		
		$data = array($title, $charId, $userId, $theEnd, $lastWill);
		
		$query = $this->db->query($sql, $data);
		
		return $this->db->insert_id();
	}

	// finish diary
	public function finishDiaryRecup($id)
	{
		$sql = "	UPDATE `diary`
				SET  `dt_end` = NOW(), `finished` = TRUE
				WHERE `id` = ?;";
		
		$data = array($id);
		
		$query = $this->db->query($sql, $data);
		
		return $query;
	}

	// get id of entries by diary
	public function getDayEntriesByDiary($id)
	{
		$sql = "	SELECT `day`
					FROM `entry`
					WHERE `diary_id` = ?;";

		$data = array($id);

		$query = $this->db->query($sql,$data);

		$nb_results = $query->num_rows();

		if($nb_results > 0)
		{
			return $query->result_array();
		}
		$query->free_result();

		return false;
	}
}
/* End of file diary.php */
/* Location: ./application/models/diary.php */