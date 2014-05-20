<?php

class Pages extends CI_Controller
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
		$this->p();
	}
		
	public function p($nom = "")
	{
		// loads the header
		$this->load->view('theme/header');

		if($nom != "")
		{
			$nom = "pages/".$nom;
			$this->load->view($nom);
		}
		else
		{
			$data['error'] = "Page non trouvée";
			$this->load->view('theme/error',$data);
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}

	public function infos()
	{
		$this->p('infos');
	}

	public function man()
	{
		$this->p('man');
	}

	public function faq()
	{
		// loads the header
		$this->load->view('theme/header');

		$this->load->view('pages/faq');
		
		// loads the footer
		$this->load->view('theme/footer');
	}
	
	
}