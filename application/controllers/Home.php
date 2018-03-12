<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($page=1)
    {
        $data['constants'] = json_decode($this->db->get('/constants'),TRUE);
        $data['slide'] = $this->load->view('slide.php',$data,TRUE);
        $data['page'] = get_class($this);
        $data['cart'] = $this->load->view('cart.php',$data,TRUE);
        $data['headtag'] = $this->load->view('headtag.php',$data,TRUE);
        $data['banner_menu'] = $this->load->view('banner_menu.php',$data,TRUE);
        $data['footer'] = $this->load->view('footer.php',$data,TRUE);
        /*-- pagination --*/
        $date['items_per_page'] = 12;
        $data['all_products'] = json_decode($this->db->get('/products'),TRUE);
        $data['pages'] = count($data['all_products']);
        $data['cur_page'] = ((int)$page < 1 || (int)$page > $data['pages']) ? 1 : (int)$page;
        $data['products'] = array_slice($data['all_products'], 12*($data['cur_page']-1), 12);
        /*
        foreach(glob(FCPATH.'product-image'.DIRECTORY_SEPARATOR.'*.png') as $row)
        {
            if(is_file($row))
            {
                unlink($row);
            }
        }
        foreach($data['products'] as $row)
        {
            file_put_contents(FCPATH.'product-image'.DIRECTORY_SEPARATOR.$row['id'].'.png', base64_decode($row['image']));
        }
        */
        $this->load->view('home_view.php',$data);
    }
    public function page()
    {
        
    }
    public function product_detail()
    {
        if($this->input->post('product_id'));
        {
            echo $this->db->get('/products/'.$this->input->post('product_id'));
        }
    }
    public function getfile()
    {
        
    }
}
