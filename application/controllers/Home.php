<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['products'] = json_decode($this->db->get('/products'),TRUE);
        $data['slide'] = $this->load->view('slide.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
}

