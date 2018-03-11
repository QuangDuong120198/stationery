<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    protected $db;
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','file'));
        define('DEFAULT_URL','https://newdatabase-e8f02.firebaseio.com');
        $this->db = new \Firebase\FirebaseLib(DEFAULT_URL);
    }
}
