<?php

class Search extends CI_Controller
{
	private $default_title;
	
	public function __construct()
	{
		//	Obligatory
		parent::__construct();
		
		//	This code will be executed each time this controller will be called
		$this->default_title = 'NRJ Reloaded - Users';
		
	}
	
	public function index()
	{
		$this->accueil();
	}
	
	public function accueil()
	{
		// loads the header
		$this->load->view('theme/header');

		
		// loads the form helper
		$this->load->helper('form');
		// loads character model
		$this->load->model('character','cMdl');
		// loads characters info
		$data['characters'] = $this->cMdl->getCharacters();

		// loads the page
		$this->load->view('ship/search');
		$this->load->view('user/search');
		$this->load->view('search/character_search',$data);
		$this->load->view('search/last_search');
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// shows 10 last diaries
	public function last()
	{
		$this->load->view('theme/header');
		
		// get last 10 diaries
		$this->load->model('diary','dMdl');
		$data['diaries'] = $this->dMdl->getLastXDiaries(10);

		// loads the view
		$this->load->view('search/last',$data);

		$this->load->view('theme/footer');
	}

	// shows diaries by character
	public function character()
	{
		$this->load->view('theme/header');

		$char_id = $this->input->post('Personnages',1);
		if($char_id != false)
		{
			$this->load->model('character','cMdl');
			$data['character'] = $this->cMdl->getCharacter($char_id);
			$this->load->model('diary','dMdl');
			$data['diaries'] = $this->dMdl->getDiariesByCharacter($char_id);
			$this->load->view('search/character',$data);
		}
		else
		{
			$data['error'] = "Vous n'avez sélectionné aucun personnage.";
			$this->load->view('theme/error',$data);
		}

		$this->load->view('theme/footer');
	}

}