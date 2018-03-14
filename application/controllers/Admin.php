<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $this->load->view('admin_view.php',$data);
    }
}
