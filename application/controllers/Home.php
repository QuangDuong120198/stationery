<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($page = 1)
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['category'] = json_decode($this->db->get('/category'),TRUE);
        $data['slide'] = $this->load->view('slide.php',$data,TRUE);
        $data['page'] = get_class($this);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        /* -- PAGINATION -- */
        $data['all_products'] = json_decode($this->db->get('/products'),TRUE);
        $data['pages'] = (int)ceil(count($data['all_products'])/12);
        $data['cur_page'] = ((int)$page < 1 || !$page) ? 1 : (int)$page;
        $data['display_page'] = array();
        if($data['pages']>5)
        {
            if($data['cur_page']<4)
            {
                $data['display_page'] = array(1,2,3,4,5);
            }
            elseif($data['cur_page']<$data['pages']-2)
            {
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }
            else
            {
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }
        else
        {
            $data['display_page'] = array(1,2,3,4,5);
        }
        $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
        $this->load->view('home_view.php',$data);
    }
    public function get_products()
    {
        if($this->input->get('to_page',TRUE))
        {
            $data['all_products'] = json_decode($this->db->get('/products'),TRUE);
            $data['pages'] = (int)ceil(count($data['all_products'])/12);
            $data['cur_page'] = ((int)$this->input->get('to_page',TRUE) < 1 || !$this->input->get('to_page',TRUE)) ? 1 : (int)$this->input->get('to_page',TRUE);
            $data['display_page'] = array();
            if($data['pages']>5)
            {
                if($data['cur_page']<4)
                {
                    $data['display_page'] = array(1,2,3,4,5);
                }
                elseif($data['cur_page']<$data['pages']-2)
                {
                    $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
                }
                else
                {
                    $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
                }
            }
            else
            {
                $data['display_page'] = array(1,2,3,4,5);
            }
            $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
            $json['products_view'] = $this->load->view('products.php',$data,TRUE);
            echo json_encode($json);
        }
    }
}
