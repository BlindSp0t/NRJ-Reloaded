<?php

class Stats extends CI_Controller
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

		// get the required data
		$this->load->model('statistics','sMdl');
		$data['nbUser'] = $this->sMdl->nbUsers();
		$data['nbDiaries'] = $this->sMdl->nbDiaries();
		$data['nbFinishedDiaries'] = $this->sMdl->nbFinishedDiaries();
		$data['nbEntries'] = $this->sMdl->nbEntries();
		$data['nbShipsDiary'] = $this->sMdl->nbShipsWithDiary();
		$data['shipMostDiaries'] = $this->sMdl->shipMostDiaries();
		$data['activeUsers'] = $this->sMdl->nbUsersActive();
		$data['mostActiveUser'] = $this->sMdl->getMostActiveUser();
		$data['longestShip'] = $this->sMdl->getLongestShip();
		$data['characters'] = $this->sMdl->getCharactersStats();
		$this->load->view('stats/main',$data);
				
		// loads the footer
		$this->load->view('theme/footer');
	}
	
}