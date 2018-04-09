<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    private function get_products_ajax($sale = FALSE)
    {
        $db = json_decode($this->db->get('/'),TRUE);
        $data['constants'] = $db['constants'];
        $data['raw_all_products'] = $db['products'];
        $data['page_name'] = ''; // don't delete this!!
        $data['discount'] = array_filter($data['raw_all_products'], function($item){
            return $item['discount'] > 0 && $item['status'];
        });
        if(!$sale){
            $data['nodiscount'] = array_filter($data['raw_all_products'], function($item){
                return $item['discount'] == 0 && $item['status'];
            });
            $data['out'] = array_filter($data['raw_all_products'], function($item){
                return !$item['status'];
            });
        }else{
            $data['out'] = array_filter($data['raw_all_products'], function($item){
                return $item['discount'] > 0 && !$item['status'];
            });
        }
        $data['category_id'] = ""; // don't delete this!!
        $data['all_products'] = !$sale ? array_merge($data['discount'], $data['nodiscount'], $data['out']) : array_merge($data['discount'], $data['out']);
        if(get_cookie('sort',TRUE)){
            uasort($data['raw_all_products'], function($a, $b){
                return $a['price'] - $b['price'];
            });
            $data['all_products'] = $data['raw_all_products'];
        }
        return $data;
    }
    private function display($page = 1, $sale = FALSE){
        $db = json_decode($this->db->get('/'),TRUE);
        $data['constants'] = $db['constants'];
        $category = array();
        $other = array();
        foreach($db['category'] as $key=>$value){
            if($key=='other'){
                $other[$key] = $value;
            }else{
                $category[$key] = $value;
            }
        }
        asort($category);
        $data['category'] = array_merge($category,$other);
        $data['slide'] = $this->load->view('slide.php',$data,TRUE);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        $data['browser'] = $this->load->view('browser.php',NULL,TRUE);
        //---------------------------
        $data['best_seller'] = $db['order'];
        $data['raw_all_products'] = $db['products'];
        uasort($data['best_seller'], function($a, $b){
            return $b['calledTimes'] - $a['calledTimes'];
        });
        $data['top_best_seller'] = array_slice($data['best_seller'],0,5);
        $data['top'] = array();
        foreach($data['top_best_seller'] as $key=>$value){
            array_push($data['top'], $data['raw_all_products'][$key]);
        }
        //-------- FILTER -----------
        $data['discount'] = array_filter($data['raw_all_products'], function($item){
            return $item['discount'] > 0 && $item['status'];
        });
        if(!$sale){
            $data['nodiscount'] = array_filter($data['raw_all_products'], function($item){
                return $item['discount'] == 0 && $item['status'];
            });
            $data['out'] = array_filter($data['raw_all_products'], function($item){
                return !$item['status'];
            });
        }else{
            $data['out'] = array_filter($data['raw_all_products'], function($item){
                return $item['discount'] > 0 && !$item['status'];
            });
        }
        $data['all_products'] = !$sale ? array_merge($data['discount'], $data['nodiscount'], $data['out']) : array_merge($data['discount'], $data['out']);
        if(get_cookie('sort',TRUE)){
            uasort($data['raw_all_products'],function($a, $b){
                return $a['price'] - $b['price'];
            });
            $data['all_products'] = $data['raw_all_products'];
        }
        return $data;
    }
    public function index($page = 1)
    {
        $data = $this->display($page);
        $data['product_type'] = "Sản phẩm";
        $data['category_id'] = "";
        $data['title'] = "Văn phòng phẩm Xuân Thủy";
        $data['page_name'] = "Products";
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['pages'] = (int)ceil(count($data['all_products'])/12);
        $data['cur_page'] = ((int)$page < 1 || !$page) ? 1 : (int)$page;
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            }elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['ajax_url'] = base_url()."home/get_all_products_ajax/";
        $data['ajax_redirect'] = base_url()."home/index/";
        $data['best_seller'] = $this->load->view('best_seller.php',$data,TRUE);
        $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
        $data['display_products'] = $this->load->view('display_products.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
    public function sale($page = 1)
    {
        $data = $this->display($page, TRUE);
        $data['title'] = 'Sản phẩm khuyến mại';
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['product_type'] = "Sản phẩm khuyến mại";
        $data['category_id'] = ""; // don't delete this!!
        $data['best_seller'] = ""; // don't delete this!!
        $data['page_name'] = "Sale";
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['pages'] = (int)ceil(count($data['all_products'])/12);
        $data['cur_page'] = ((int)$page < 1 || !$page) ? 1 : (int)$page;
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            }elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['ajax_url'] = base_url()."home/get_sale_products_ajax/";
        $data['ajax_redirect'] = base_url()."home/sale/";
        $data['best_seller'] = ""; // don't delete this!!
        $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
        $data['display_products'] = $this->load->view('display_products.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
    public function category($category_id = '', $page = 1)
    {
        $data = $this->display($page);
        $data['product_type'] = $data['category'][$category_id];
        $data['title'] = $data['product_type'];
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['page_name'] = "Products";
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['filtered_all_products'] = array();
        foreach($data['all_products'] as $row){
            if($row['type']['id']==$category_id){
                array_push($data['filtered_all_products'],$row);
            }
        }
        $data['pages'] = (int)ceil(count($data['filtered_all_products'])/12);
        $data['cur_page'] = ((int)$page < 1 || !$page) ? 1 : (int)$page;
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            }elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['best_seller'] = "";
        $data['products'] = array_slice($data['filtered_all_products'], 12*($data['cur_page']-1), 12);
        $data['ajax_url'] = base_url()."home/get_products_by_category_ajax/".$category_id."/";
        $data['ajax_redirect'] = base_url()."home/category/".$category_id."/";
        $data['category_id'] = $category_id;
        $data['display_products'] = $this->load->view('display_products.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
    public function search()
    {
        $data = $this->display();
        $data['title'] = "Kết quả tìm kiếm";
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['page_name'] = "search";
        $data['product_type'] = "Kết quả tìm kiếm cho \"". strtolower($this->input->get("keyword",TRUE) ? $this->input->get("keyword",TRUE) : "")."\"";
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $keyword = strtolower($this->input->get("keyword",TRUE) ? $this->input->get("keyword",TRUE) : "");
        $data['keyword'] = $keyword;
        $keyword = utf8_to_ascii($keyword);
        $data['results'] = array();
        foreach($data['all_products'] as $row)
        {
            if(strpos($row['search_name'],$keyword)!==FALSE)
            {
                array_push($data['results'],$row);
            }
        }
        $data['pages'] = (int)ceil(count($data['results'])/12);
        $data['cur_page'] = ((int)$this->input->get("page",TRUE) < 1 || !$this->input->get("page",TRUE)) ? 1 : (int)$this->input->get("page",TRUE);
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            }elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['best_seller'] = ""; // don't delete this!!
        $data['category_id'] = ""; // don't delete this!!
        $data['products'] = array_slice($data['results'],12*($data['cur_page']-1),12);
        $data['ajax_url'] = base_url()."home/";
        $data['ajax_redirect'] = base_url()."home/";
        $data['display_products'] = $this->load->view('display_products.php',$data,TRUE);
        $this->load->view('home_view.php',$data);
    }
    public function pay()
    {
        $db = json_decode($this->db->get("/"),TRUE);
        $data['page_name'] = 'pay';
        $data['title'] = 'Thanh toán';
        $data['constants'] = $db['constants'];
        $data['category'] = $db['category'];
        $data['headtag'] = $this->load->view("headtag.php",$data,TRUE);
        $data['banner_menu'] = $this->load->view("banner_menu.php",$data,TRUE);
        $data['cart'] = $this->load->view('cart.php',NULL,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        $this->load->view("pay_view.php",$data);
    }
    /* ---- AJAX ---- */
    public function get_all_products_ajax()
    {
        $data = $this->get_products_ajax();
        $data['pages'] = (int)ceil(count($data['all_products'])/12);
        $data['cur_page'] = ((int)$this->input->get('to_page',TRUE) < 1 || !$this->input->get('to_page',TRUE)) ? 1 : (int)$this->input->get('to_page',TRUE);
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            }elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            }else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
        $data['ajax_url'] = base_url()."home/get_all_products_ajax/";
        $data['ajax_redirect'] = base_url()."home/index/";
        $json['products_view'] = $this->load->view('display_products.php',$data,TRUE);
        echo json_encode($json);
    }
    public function get_products_by_category_ajax()
    {
        $data = $this->get_products_ajax();
        $data['category_id'] = $this->input->get("category_id",TRUE);
        $data['filtered_all_products'] = array();
        foreach($data['all_products'] as $row){
            if($row['type']['id']==$data['category_id']){
                array_push($data['filtered_all_products'],$row);
            }
        }
        $data['pages'] = (int)ceil(count($data['filtered_all_products'])/12);
        $data['cur_page'] = ((int)$this->input->get('to_page',TRUE) < 1 || !$this->input->get('to_page',TRUE)) ? 1 : (int)$this->input->get('to_page',TRUE);
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            } elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            } else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['products'] = array_slice($data['filtered_all_products'], 12*($data['cur_page']-1), 12);
        $data['ajax_url'] = base_url()."home/get_products_by_category_ajax/";
        $data['ajax_redirect'] = base_url()."home/category/".$this->input->get("category_id")."/";
        $json['products_view'] = $this->load->view('display_products.php',$data,TRUE);
        echo json_encode($json);
    }
    public function get_sale_products_ajax()
    {
        $data = $this->get_products_ajax();
        $data['category_id'] = "";
        $data['filtered_all_products'] = array_filter($data['all_products'], function($item){
            return $item['discount'] > 0;
        });
        $data['pages'] = (int)ceil(count($data['filtered_all_products'])/12);
        $data['cur_page'] = ((int)$this->input->get('to_page',TRUE) < 1 || !$this->input->get('to_page',TRUE)) ? 1 : (int)$this->input->get('to_page',TRUE);
        $data['display_page'] = array();
        if($data['pages']>5){
            if($data['cur_page']<4){
                $data['display_page'] = array(1,2,3,4,5);
            } elseif($data['cur_page']<$data['pages']-2){
                $data['display_page'] = array($data['cur_page']-2, $data['cur_page']-1, $data['cur_page'], $data['cur_page']+1, $data['cur_page']+2);
            } else{
                $data['display_page'] = array($data['pages']-4, $data['pages']-3, $data['pages']-2, $data['pages']-1, $data['pages']);
            }
        }else{
            for($i=1 ; $i <= $data['pages'] ; $i++){
                array_push($data['display_page'],$i);
            }
        }
        $data['products'] = array_slice($data['filtered_all_products'], 12*($data['cur_page']-1), 12);
        $data['ajax_url'] = base_url()."home/get_sale_products_ajax/";
        $data['ajax_redirect'] = base_url()."home/sale/";
        $json['products_view'] = $this->load->view('display_products.php',$data,TRUE);
        echo json_encode($json);
    }
    public function pay_ajax()
    {
        if($this->input->post("bill",TRUE))
        {
            $bill = json_decode($this->input->post("bill",TRUE));
            $this->db->set("/bills/".$bill->id, $bill);
        }
    }
}
