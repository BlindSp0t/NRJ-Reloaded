<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Token extends CI_Model
{

	//* class instanciation
 	public function TwinLib($client_id,$client_secret,$redirect_uri)
    {
 
 
        $this->appId = $client_id;
        $this->appKey = $client_secret;
        $this->appUrl = $redirect_uri;
 
        $this->state = "constructed";
 
        return true;
     
     
    }
 
    //* Méthode retournant l'url de demande d'autorisation
 
    public function authURL($scope = "",$accessType = "online",$state = "true")
    {
        if($scope == "")
            $url = "https://twinoid.com/oauth/auth?response_type=code&client_id=$this->appId&redirect_uri=".htmlspecialchars($this->appUrl)."&state=$state&access_type=$accessType";
        else
            $url = "https://twinoid.com/oauth/auth?response_type=code&client_id=$this->appId&redirect_uri=".htmlspecialchars($this->appUrl)."&scope=$scope&state=$state&access_type=$accessType";
 
        return $url;
    }
 
    //* Méthode pour récupérer le Token;
 
    public function getToken($code)
    {
        $url = "https://twinoid.com/oauth/token";
 
        $ctx = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => "client_id=$this->appId&client_secret=$this->appKey&redirect_uri=$this->appUrl&code=$code&grant_type=authorization_code"
        )
        );
 
        $context = stream_context_create($ctx);
        $json = file_get_contents($url,false,$context);
        $json = json_decode($json);
        
        $this->token=$json->access_token;
 
        $this->stat = "gotToken";
 
        return $this->token;
 
    }
 
    //* Méthode pour récupérer le contenu du flux "me" ( sous forme d'Array )
 
    public function getMe($fields = "id,name")
    {
        $url = "http://twinoid.com/graph/me?fields=$fields&access_token=$this->token";
 
        $json = file_get_contents($url);
 
        $json = json_decode($json);
        
        $url2 = "https://twinoid.com/graph/user/".$json->id."?access_token=$this->token";

        $json2 = file_get_contents($url2);

        $json2 = json_decode($json2);
        return $json2;
    }
 
 
    private $appUrl;
    private $appId;
    private $appKey;
    private $token;
    private $state;
     
    }
/* End of file token.php */
/* Location: ./application/models/token.php */