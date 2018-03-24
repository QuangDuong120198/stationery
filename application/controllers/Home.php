<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($page = 1)
    {
        $db = json_decode($this->db->get('/'),TRUE);
        $data['constants'] = $db['constants'];
        $data['category'] = $db['category'];
        $data['slide'] = $this->load->view('slide.php',$data,TRUE);
        $data['page'] = get_class($this);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        //------------------------------------------------------
        $best_seller = $db['order'];
        $raw_all_products = $db['products'];
        uasort($best_seller, function($a, $b){
            return $b['calledTimes'] - $a['calledTimes'];
        });
        $top_best_seller = array_slice($best_seller,0,5);
        $data['top'] = array();
        foreach($top_best_seller as $key=>$value){
            array_push($data['top'], $raw_all_products[$key]);
        }
        //-------- FILTER -----------
        $discount = array_filter($raw_all_products, function($item){
            return $item['discount'] > 0 && $item['status'];
        });
        $nodiscount = array_filter($raw_all_products, function($item){
            return $item['discount'] == 0 && $item['status'];
        });
        $out = array_filter($raw_all_products, function($item){
            return !$item['status'];
        });
        if(get_cookie('sort',TRUE))
        {
            uasort($discount,function($a, $b){
                return $a['price'] - $b['price'];
            });
            uasort($nodiscount,function($a, $b){
                return $a['price'] - $b['price'];
            });
            uasort($out,function($a,$b){
                return $a['price'] - $b['price'];
            });
        }
        $all_products = array_merge($discount, $nodiscount, $out);
        $data['pages'] = (int)ceil(count($raw_all_products)/12);
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
            for($i=1 ; $i <= $data['pages'] ; $i++)
            {
                array_push($data['display_page'],$i);
            }
        }
        $data['products'] = array_slice($all_products, 12*($data['cur_page']-1), 12);
        $data['display_products'] = $this->load->view('products.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
    public function get_products()
    {
        if($this->input->get('to_page',TRUE))
        {
            $db = json_decode($this->db->get('/'),TRUE);
            $raw_all_products = $db['products'];
            $discount = array_filter($raw_all_products, function($item){
                return $item['discount'] > 0 && $item['status'];
            });
            $nodiscount = array_filter($raw_all_products, function($item){
                return $item['discount'] == 0 && $item['status'];
            });
            $out = array_filter($raw_all_products, function($item){
                return !$item['status'];
            });
            if(get_cookie('sort',TRUE))
            {
                uasort($discount, function($a, $b){
                    return $a['price'] - $b['price'];
                });
                uasort($nodiscount, function($a, $b){
                    return $a['price'] - $b['price'];
                });
                uasort($out, function($a, $b){
                    return $a['price'] - $b['price'];
                });
            }
            $all_products = array_merge($discount, $nodiscount, $out);
            $data['pages'] = (int)ceil(count($all_products)/12);
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
                for($i=1 ; $i <= $data['pages'] ; $i++)
                {
                    array_push($data['display_page'],$i);
                }
            }
            $data['products'] = array_slice($all_products, 12*($data['cur_page']-1), 12);
            $json['products_view'] = $this->load->view('products.php',$data,TRUE);
            echo json_encode($json);
        }
    }
    public function category($id = ''){
        
    }
}
