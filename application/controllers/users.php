<?php

class Users extends CI_Controller
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
	
	public function accueil($name = "")
	{
		// loads the header
		$this->load->view('theme/header');

		// get the user's name
		if(isset($_POST['name'])) $name = $this->input->post('name');

		// No connection check because everyone can access this part.
		if($name != "")
		{
			// Load the user model
			$this->load->model('user','uMdl');
			// user's id
			$data['user'] = $this->uMdl->getUserByName($name);
			if($data['user'] != false)
			{
				// Load the diary model
				$this->load->model('diary','dMdl');
				// we get all the users diaries
				$data['diaries'] = $this->dMdl->getDiariesByUser($data['user']->id);

				// then load the view
				$this->load->view('user/main',$data);
			}
			else
			{
				$data['error'] = "Cet utilisateur n'existe pas.";
				$this->load->view('theme/error',$data);
			}
		}
		else
		{
			// loads the form helper
			$this->load->helper('form');

			// loads the page
			$this->load->view('user/search');
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// lookup the user by id
	public function id($id = -1)
	{
		$id = intval($id);
		// No connection check because everyone can access this part.
		if($id != -1 && $id != 0)
		{
			// Load the user model
			$this->load->model('user','uMdl');
			// user's id
			$data['user'] = $this->uMdl->getUserById($id);
			if($data['user'] != false)
			{
				$this->accueil($data['user']->name);
			}
			else
			{
				$this->accueil(0);
			}
		}
		else
		{
			$this->accueil(0);
		}
	}
}