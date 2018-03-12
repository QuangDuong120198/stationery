<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Introduce extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['page'] = get_class($this);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        $this->load->view('introduce_view.php',$data);
    }
}
