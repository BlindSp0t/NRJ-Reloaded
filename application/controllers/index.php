<?php

class Index extends CI_Controller
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
			$this->load->view('index/main');
		}
		else
		{
			$this->load->view('index/index');
		}
		
		// loads the footer
		$this->load->view('theme/footer');
	}
	
	public function connection($lang = "fr_FR")
	{
		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null) 
		{
			$this->load->view('theme/header');
			/*$this->session->set_userdata('name',"Admin");
			$this->session->set_userdata('id',1);
			$this->session->set_userdata('twin_id',0);
			$this->accueil();*/
			$this->load->model('token','tMdl');
			$this->tMdl->TwinLib("112","UnMrFjqWXSsgPNjJ3wA73MJyinCSc9tj","http://www.nrj-reloaded.fr/index.php/index/ident");
			//$this->tMdl->TwinLib("103","FbKGX3J9t7J0HF16FCJlMgzO45M8D2VL","http://www.flowonline.fr/nrj/index.php/index/ident");
			$this->load->helper('form');
			$data['auth'] = $this->tMdl->authUrl("","online",$lang);
			$this->load->view('index/connection',$data);
			$this->load->view('theme/footer');
		}
		else
		{
			$this->accueil();
		}
	}

	// authentification
	public function ident()
	{

		$state = $this->input->get('state');
		// if the user isn't connected, loads the connexion page
		$sess = $this->session->userdata('name');
		if($sess == null || $state != "enEN") 
		{
			$code = $this->input->get('code');
			$error = $this->input->get('error');
			if($state == "fr_FR" || $state == "true")
			{
				if($code == "") // in case of login error
				{
					echo "<h2>Erreur</h2><br /><p>Erreur lors de la connexion. La raison est la suivante : <br />".$error;
				}
				else
				{
					// let's get our token
					$this->load->model('token','tMdl');
					$this->tMdl->TwinLib("appId","apiKey","apiURL");
					$this->tMdl->getToken($code);
					
					// now we can request user's infos
					$me = $this->tMdl->getMe("");
					$name = $me->name;
					$twinId = $me->id;
					$locale = $me->locale;

					// let's check the db for user existence
					$this->load->model('user','uMdl');
					$user = $this->uMdl->getUserByTwinId($twinId);

					if($user == false) // new user, yay !
					{
						$id = $this->uMdl->register($name,$locale,$twinId); // let's register him !
						$this->session->set_userdata('id', $id);
					}
					else
					{
						// check if user changed nickname
						if($name != $user->name)
						{
							// update username in db
							$this->uMdl->updateUserName($user->id, $name);
						}

						$this->session->set_userdata('id',$user->id);

						// get current diary if possible
						$this->load->model('diary','dMdl');
						$currentDiary = $this->dMdl->getLastOpenDiary($user->id);
						if($currentDiary != false) 
						{
							$idDiary = $currentDiary[0]['id'];
						}
						else $idDiary = false;
						$this->session->set_userdata('currentDiary', $idDiary);
					}

					// finish the session vars
					$this->session->set_userdata('name',$name);
					$this->session->set_userdata('twin_id', $twinId);

					// now that he's logged in, let's redirect the poor fellow to the index page
					$this->accueil();

				}
			}
			else
			{
				if($state == "enEN")
				{
					if($code == "") // in case of login error
					{
						echo "<h2>Error</h2><br /><p>Error while login. The reason is as follow : <br />".$error;
					}
					else
					{
						// let's get our token
						$this->load->model('token','tMdl');
						$this->tMdl->TwinLib("apiID","apiKey","apiURL");
						$this->tMdl->getToken($code);
						
						// now we can request user's infos
						$me = $this->tMdl->getMe("");
						$name = $me->name;
						$twinId = $me->id;
						$locale = $me->locale;

						// let's check the db for user existence
						$this->load->model('user_en','uMdl');
						$user = $this->uMdl->getUserByTwinId($twinId);

						if($user == false) // new user, yay !
						{
							$id = $this->uMdl->register($name,$locale,$twinId); // let's register him !
						}
						else
						{
							// check if user changed nickname
							if($name != $user->name)
							{
								// update username in db
								$this->uMdl->updateUserName($user->id, $name);
							}
							$id = $user->id;
						}

						// create a new connexion code
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    					$randomString = '';
    					for ($i = 0; $i < 20; $i++) {
        					$randomString .= $characters[rand(0, strlen($characters) - 1)];
    					}
    					// save it in DB
    					$this->uMdl->connection($id, $randomString);

    					// redirect to english site with randomString parameter to connect
    					redirect("http://en.nrj-reloaded.fr/index/ident/".$randomString);

					}
				}
			}
		}
		else
		{
			$this->accueil();
		}
	}
	
	public function deco()
	{
		$this->session->sess_destroy();
		
		redirect();
	}

	public function pageNotFound()
	{
		$this->output->set_status_header('404');
		$this->load->view('theme/header');
		$data['error'] = "Le système indique que le fichier recherché n'existe pas... ou plus ?";
		$this->load->view('theme/error',$data);
		$this->load->view('theme/footer');
	}
}