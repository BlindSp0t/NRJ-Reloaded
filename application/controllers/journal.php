<?php

class Journal extends CI_Controller
{
	private $default_title;
	
	public function __construct()
	{
		//	Obligatory
		parent::__construct();
		
		//	This code will be executed each time this controller will be called
		$this->default_title = 'NRJ Reloaded - Mes Journaux';
		
	}
	
	public function index()
	{
		$this->accueil();
	}
	
	// all users diaries
	public function accueil()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			// First, we get all the users diaries
			$data['diaries'] = $this->dMdl->getMyFinishedDiaries($this->session->userdata('id'));
			// Then we get his last open diary
			$data['last_diary'] = $this->dMdl->getLastOpenDiary($this->session->userdata('id'));
			// change the userdata currentDiary var value
			if($data['last_diary'] != false) 
			{
				$idDiary = $data['last_diary'][0]['id'];
			}
			else $idDiary = false;
			$this->session->set_userdata('currentDiary', $idDiary);
			// Load the journal main page
			$this->load->helper('array');
			$this->load->view('journal/main',$data);
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// set up a new diary
	public function newDiary()
	{
		// loads the header
		$this->load->view('theme/header');
		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			$data['last_diary'] = $this->dMdl->getLastOpenDiary($this->session->userdata('id'));
			if($data['last_diary'] == false)
			{
				// loads character model
				$this->load->model('character','cMdl');
				// loads characters info
				$data['characters'] = $this->cMdl->getCharacters();
				// loads new journal view
				$this->load->helper('form');
				$this->load->view('journal/new',$data);
			}
			else
			{
				$data['error'] = "Vous devez terminer votre journal en cours avant d'en créer un nouveau.";
				$this->load->view('theme/error',$data);
			}
		}
		// loads the footer
		$this->load->view('theme/footer');
	}

	// create a new diary in DB
	public function create()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			if(isset($_POST['title']))
			{
				// let's get the post data
				$character_img = $this->input->post('Personnages');
				$title = utf8_encode($this->input->post('title'));
				$title = str_replace('<','&lt;',$title);
				$day = intval($this->input->post('day'));

				// we can't do things with the character's img url so let's get his id
				$this->load->model('character','cMdl');
				$character_img = str_replace("_nrj.png",".jpg",$character_img);
				$charId = $this->cMdl->getIdByImg($character_img);
				$charId = $charId->id;

				// now we can create a new diary
				$this->load->model('diary','dMdl');
				// let's first check that no open diary exists
				$test = $this->dMdl->getLastOpenDiary($this->session->userdata('id'));
				if($test == false) // if no existing diary for that user is open, we can create a new one.
				{
					$this->dMdl->newDiary($this->session->userdata('id'),$charId,$title,$day);

					// redirects to the main journal page
					redirect('journal/accueil');
				}
				else
				{
					$data['error'] = "Vous ne pouvez pas créer de nouveaux journal tant que vous n'avez pas terminé le précédent.";
					$this->load->view('theme/error',$data);
				}

			}
			else
			{
				redirect('journal/newDiary');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// enter The_End and Last_Will
	public function end($id = 0)
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify if the diary belongs to user
			$this->load->model('diary','dMdl');
			$id = intval($id);
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryUserTF == true)
			{
				$this->load->helper('form');
				$data['id'] = $id;
				$this->load->view('journal/end',$data);
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// finish diary
	public function finish()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify that we come from the right page
			if(isset($_POST['id']))
			{
				// let's get the post data
				$id = $this->input->post('id');
				$lastWill = utf8_encode($this->input->post('lastWill'));
				$lastWill = str_replace('<','&lt;',$lastWill);
				$theEnd = $this->input->post('theEnd');
				$this->load->model('diary','dMdl');
				$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);
				if($diaryUserTF)
				{
					// edit the diary so it's finished
					$this->dMdl->finishDiary($id, $lastWill, $theEnd);

					// set currentDiary userdata var to false
					$this->session->set_userdata('currentDiary', false); 
				}
				else
				{
					$data['error'] = "Ce journal ne vous appartient pas !";
					$this->load->view('theme/error',$data);
				}
				// redirects to the main journal page
				redirect('journal/accueil');
			}
			else
			{
				redirect('journal/accueil');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// add or edit entries for a specified diary
	public function entry($id)
	 {
	 	// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify if the diary belongs to user
			$this->load->model('diary','dMdl');
			$id = intval($id);
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryUserTF == true)
			{
				$this->load->helper('form');
				$data['diary'] = $this->dMdl->getDiary($id);
				$start_date = $data['diary']->dt_start;
				// let's get the last entry for that diary
				$data['entry'] = $this->dMdl->getLastEntry($id,$start_date);
				$data['day'] = $this->dMdl->numberDays($start_date);
				if($data['entry'] != false) $this->session->set_userdata('entry_id',$data['entry']->id);
				else $this->session->set_userdata('day',$data['day']);
				$this->load->view('journal/newentry',$data);
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	 }

	// add new entry to a diary
	public function addEntry()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify that we come from the right page
			if(isset($_POST['diary_id']))
			{
				// let's get the post data
				$idDiary = $this->input->post('diary_id');
				$text = utf8_encode($this->input->post('text'));
				$text = str_replace('<','&lt;',$text);
				$day = $this->session->userdata('day');
				$this->session->unset_userdata('day');
				// in case diary is already finished
				$this->load->model('diary','dMdl');
				$test = $this->dMdl->isDiaryFinished($idDiary);
				if(!$test)
				{
					// test if an entry already exists for this day
					$test = $this->dMdl->doesEntryExists($idDiary, $day);
					if(!$test)
					{
						$this->dMdl->addEntry($idDiary, $text, $day);
						// redirects to the main journal page
						redirect(base_url('journal/v/')."/".$idDiary."/".$day);
					}
					else
					{
						$data['error'] = "Il existe déjà une entrée pour ce jour.";
						$this->load->view('theme/error',$data);
					}
				}
				else
				{
					$data['error'] = "Vous ne pouvez pas ajouter une entrée car ce journal est déjà terminé.";
					$this->load->view('theme/error',$data);
				}
			}
			else
			{
				redirect('journal/accueil');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// edit existing entry
	public function editEntry()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify that we come from the right page
			if(isset($_POST['diary_id']))
			{
				// let's get the post data
				$id = $this->session->userdata('entry_id');
				$this->session->unset_userdata('entry_id');
				$text = utf8_encode($this->input->post('text'));
				$text = str_replace('<','&lt;',$text);
				$idDiary = $this->input->post('diary_id');

				// if diary not finished, 
				$this->load->model('diary','dMdl');
				$test = $this->dMdl->isDiaryFinished($idDiary);
				if(!$test)
				{
					$this->dMdl->updateEntry($id, $text);
					$day = $this->dMdl->getDayEntry($id);
					// redirects to the main journal page
					redirect(base_url('journal/v/')."/".$idDiary."/".$day);
				}
				else
				{
					$data['error'] = "Vous ne pouvez pas éditer une entrée car ce journal est déjà terminé.";
					$this->load->view('theme/error',$data);
				}
			}
			else
			{
				redirect('journal/accueil');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	
	// show a diary
	public function v($id = 0, $day = null)
	{
		// loads the header
		$this->load->view('theme/header');

		// no connection, everybody can read a diary
		
		// Load the diary model
		$this->load->model('diary','dMdl');
		$id = intval($id);
		// check if diary is finished and has theEnd
		$diaryFinishedTF = $this->dMdl->isDiaryViewable($id);
		// check if diary belongs to user in case it isnt finished because it's supposed to be private while it's not finished
		if(isset($this->session->userdata['id'])) $diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);
		else $diaryUserTF = false;

		if($diaryFinishedTF == true || $diaryUserTF == true)
		{
			// get diary
			$data['diary'] = $this->dMdl->getDiary($id);
			// get diary's user's infos
			$this->load->model('user', 'uMdl');
			$data['user'] = $this->uMdl->getUserById($data['diary']->user_id);
			// get character info 
			$this->load->model('character','cMdl');
			$data['character'] = $this->cMdl->getCharacter($data['diary']->character_id);
			// get entries for this diary
			$data['entries'] = $this->dMdl->getEntriesByDiary($data['diary']->id);
			if ($day != null) $data['day'] = $day;
			$this->load->view('journal/view',$data);
		}
		else
		{
			$data['error'] = "Ce journal(".$id.") n'existe pas, ou bien il n'est pas encore terminé.";
			$this->load->view('theme/error',$data);
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// edit diary (title, theEnd, last words)
	public function e($id)
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			$id = intval($id);
			// check if diary is finished
			$diaryFinishedTF = $this->dMdl->isDiaryFinished($id);
			// check if diary belongs to user in case it isnt finished because it's supposed to be private while it's not finished
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryFinishedTF == true && $diaryUserTF == true)
			{
				// get diary
				$data['diary'] = $this->dMdl->getDiary($id);
				$this->load->helper('form');
				$this->load->view('journal/edit',$data);
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// submit edits
	public function edit()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// verify that we come from the right page
			if(isset($_POST['id']))
			{
				// let's get the post data
				$id = $this->input->post('id');
				$lw = utf8_encode($this->input->post('lastWill'));
				$lw = str_replace('<','&lt;',$lw);
				$title = utf8_encode($this->input->post('title'));
				$title = str_replace('<','&lt;',$title);
				$theEnd = intval($this->input->post('the_end'));
				// if diary not finished, 
				$this->load->model('diary','dMdl');
				$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);
				if($diaryUserTF)
				{
					$test = $this->dMdl->isDiaryFinished($id);
					if($test)
					{
						$this->dMdl->updateDiary($id, $lw, $theEnd, $title);

						// redirects to the main journal page
						redirect(base_url('journal/v/')."/".$id);
					}
					else
					{
						$data['error'] = "Vous ne pouvez pas éditer ce journal car il n'est pas encore terminé.";
						$this->load->view('theme/error',$data);
					}
				}
				else
				{
					$data['error'] = "Vous ne pouvez pas éditer ce journal car il ne vous appartient pas.";
					$this->load->view('theme/error',$data);
				}
			}
			else
			{
				redirect('journal/accueil');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// show diary
	public function show($id = 0)
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			$id = intval($id);

			// check if diary belongs to user 
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryUserTF == true)
			{
				// show diary
				$this->dMdl->showDiary($id);
				redirect('journal/accueil');
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// hide diary
	public function hide($id = 0)
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			$id = intval($id);

			// check if diary belongs to user 
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryUserTF == true)
			{
				// hide diary
				$this->dMdl->hideDiary($id);
				redirect('journal/accueil');
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// delete diary
	public function delete($id = 0)
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			redirect('index/connection');
		}
		else
		{
			// Load the diary model
			$this->load->model('diary','dMdl');
			$id = intval($id);
			// check if diary belongs to user 
			$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

			if($diaryUserTF == true)
			{
				// delete diary
				$this->dMdl->deleteDiary($id);
				redirect('journal/accueil');
			}
			else
			{
				redirect('journal/accueil');
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// show random diary
	public function random()
	{
		$this->load->model('diary','dMdl');
		$random = $this->dMdl->getRandomDiary();
		$this->v($random->id);
	}

}