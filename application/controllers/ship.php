<?php

class Ship extends CI_Controller
{
	private $default_title;
	
	public function __construct()
	{
		//	Obligatory
		parent::__construct();
		
		//	This code will be executed each time this controller will be called
		$this->default_title = 'NRJ Reloaded - Vaisseaux';
		
	}
	
	public function index()
	{
		$this->accueil();
	}
	
	// search for full ship
	public function accueil()
	{
		// loads the header
		$this->load->view('theme/header');

		// No connection check because everyone can access this part.
		// loads the form helper
		$this->load->helper('form');

		// loads the page
		$this->load->view('ship/search');
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	// useless function for search
	public function search()
	{
		if(isset($_POST['the_end']))
		{
			$id = intval($this->input->post('the_end'));
			redirect('ship/v'.'/'.$id);
		}
		else
		{
			$data['error'] = "Vous devez spécifier un code the_end";
			$this->load->view('theme/error',$data);
			$this->accueil();
		}
	}

	// view full ship by theEnd
	public function v($id = 0)
	{
		// loads the header
		$this->load->view('theme/header');

		// no connection, everybody can read a ship's diaries
		
		if(isset($id))
		{
			$id = intval($id);
		}
		else
		{
			$id = false;
		}

		// now that we have the ship ID, let's verify that it is correct
		if($id != false && $id != 0)
		{
			// Load the diary model
			$this->load->model('diary','dMdl');

			$data['diaries'] = $this->dMdl->getDiariesByShip($id);

			// if there is no diary, no need to proceed
			if($data['diaries'] == false)
			{
				$data['error'] = "Aucun journal n'a été créé pour ce vaisseau. Vérifiez le code theEnd.";
				$this->load->view('theme/error',$data);
			}
			else
			{
				// now, heavy duty, let's get all the entries for those diaries
				foreach($data['diaries'] as $key => $value)
				{
					$data['entries'][$key] = $this->dMdl->getEntriesByDiary($value['id']);
				}
				$data['theEnd'] = $id;
				// ok now we have everything, we can proceed
				$this->load->view('ship/view',$data);
			}
		}
		else
		{
			$data['error'] = "Vous devez spécifier un code theEnd pour pouvoir visualiser les journaux.";
			$this->load->view('theme/error',$data);
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}
}