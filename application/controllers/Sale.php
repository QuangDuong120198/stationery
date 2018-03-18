<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($page = 1)
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['page'] = get_class($this);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        $data['cur_page'] = (!$page || (int)$page<=1) ? 1 : (int)$page;
        $this->load->view('sale_view.php',$data);
    }
    public function get_sale_products()
    {
        
    }
}

