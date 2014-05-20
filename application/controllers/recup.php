<?php

class Recup extends CI_Controller
{
	private $default_title;
	
	public function __construct()
	{
		//	Obligatory
		parent::__construct();
		
		//	This code will be executed each time this controller will be called
		$this->default_title = 'NRJ Reloaded';
		
	}
	
	public function index()
	{
		$this->accueil();
	}
		
	public function accueil()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the main page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			//redirect('index/connection');
			redirect('index/connection');
		}
		else
		{
			if(null !== $this->session->userdata('journal_recup'))
			{
				$this->load->helper('form');
				$this->load->view('recup/index');
			}
			else
			{
				$this->load->view('recup/asknewentry');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}
	
	public function newrecup()
	{
		// loads the header
		$this->load->view('theme/header');

		// if the user isn't connected, loads the main page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			//redirect('index/connection');
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
				$this->load->view('recup/new',$data);
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
			if(null !== ($_POST['title']))
			{
				// let's get the post data
				$character_img = $this->input->post('Personnages');
				$title = utf8_encode($this->input->post('title'));
				$title = str_replace('<','&lt;',$title);
				$lastWill = utf8_encode($this->input->post('lastWill'));
				$lastWill = str_replace('<','&lt;',$lastWill);
				$theEnd = intval($this->input->post('theEnd'));

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
					$idDiary = $this->dMdl->newDiaryRecup($this->session->userdata('id'),$charId,$title,$theEnd,$lastWill);
					$this->session->set_userdata('journal_recup',$idDiary);
					// redirects to the main journal page
					redirect('recup/addentry');
				}
				else
				{
					$data['error'] = "Vous ne pouvez pas créer de nouveaux journal tant que vous n'avez pas terminé le précédent.";
					$this->load->view('theme/error',$data);
				}

			}
			else
			{
				redirect('recup/newrecup');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// add or edit entries for a specified diary
	public function addentry()
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
			if(null !== ($this->session->userdata('journal_recup')))
			{
				// verify if the diary belongs to user
				$this->load->model('diary','dMdl');
				$id = intval($this->session->userdata('journal_recup'));
				$diaryUserTF = $this->dMdl->isDiaryToUser($id, $this->session->userdata['id']);

				if($diaryUserTF == true)
				{
					$this->load->helper('form');
					$data['diary'] = $this->dMdl->getDiary($id);
					$data['entries'] = $this->dMdl->getDayEntriesByDiary($id);
					$this->load->view('recup/newentry',$data);
				}
				else
				{
					redirect('recup/index');
				}
			}
			else
			{
				$data['error'] = "Aucun journal spécifié.";
				$this->load->view('theme/error',$data);
			}

		}
		
		// loads the footer
		$this->load->view('theme/footer');
	 }

	 // add new entry to a diary
	public function registerentry()
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
			if(null !== ($this->session->userdata('journal_recup')))
			{
				// let's get the post data
				$idDiary = $this->session->userdata('journal_recup');
				$text = utf8_encode($this->input->post('text'));
				$text = str_replace('<','&lt;',$text);
				$day = intval($this->input->post('day'));
				$this->load->model('diary','dMdl');
				$this->dMdl->addEntry($idDiary, $text, $day);
				$this->load->view('recup/asknewentry');
			}
			else
			{
				redirect('recup/index');
			}
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// end
	public function end()
	{
		$this->load->view('theme/header');
		$idDiary = $this->session->userdata('journal_recup');
		if($idDiary != null)
		{
			$this->session->unset_userdata('journal_recup');
			$this->load->model('diary','dMdl');
			$this->dMdl->finishDiaryRecup($idDiary);
			redirect('journal/v'.'/'.$idDiary);
		}
		else
		{
			$data['error'] = "Aucun journal spécifié.";
			$this->load->view('theme/error');
		}
		$this->load->view('theme/footer');
	}
	
}