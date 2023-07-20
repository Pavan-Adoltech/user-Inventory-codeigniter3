<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
{
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('login');
    } else {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row();

        if ($user) {
            
            if ($this->input->post('password') === $user->password) {
                $user_data = array(
                    'user_id' => $user->user_id,
                    'email' => $email,
                    'password' => $password
                );
                $this->session->set_userdata('logged_in', $user_data);
                $user_id = $this->session->userdata('logged_in')['user_id'];

                redirect('main/product');
            } else {
                $data['error'] = 'Invalid password';
                $this->load->view('login', $data);
            }
        } else {
            $data['error'] = 'User does not exist';
            $this->load->view('login', $data);
        }
    }
}

public function register()
{
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('age', 'Age', 'required');
    $this->form_validation->set_rules('gender', 'Gender', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('register');
    } else {
        $data = array(
            'name' => $this->input->post('name'),
            'age' => $this->input->post('age'),
            'gender' => $this->input->post('gender'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();

        $user_data = array(
            'user_id' => $user_id,
            'email' => $data['email'],
            'password' => $data['password']
        );
        $this->session->set_userdata('logged_in', $user_data);

        $this->load->view('register', array('success' => 'Registration successful!'));
    }
}
          
    public function product()
    {
          if (!$this->session->userdata('logged_in')) {
             redirect('main'); 
           }
           $user_id = $this->session->userdata('logged_in')['user_id'];


           $viewData = [];
           $search = $this->input->get('search');
           $where = [];

            if ($search) {
           $where['product_name LIKE'] = '%' . $search . '%';
           }

           $viewData['products'] = $this->db->where($where)->get('products')->result();

         $this->load->view('inc/header');
         $this->load->view('home', $viewData);
         $this->load->view('inc/footer');
    }


    public function add_item()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('main');
        }
        $user_id = $this->session->userdata('logged_in')['user_id'];

        $viewData = [];
        $this->load->library('form_validation');

        $user_id = $this->session->userdata('logged_in')['user_id']; 


        $this->form_validation->set_rules('product_name', 'Product Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('product_price', 'Product Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run()) {
            $upload = $this->do_upload();

            if (isset($upload['error'])) {
                $viewData['error'] = $upload['error'];
            } else {
                $insertData = [
                    'user_id' => $user_id,
                    'product_name' => $this->input->post('product_name'),
                    'product_price' => $this->input->post('product_price'),
                    'description' => $this->input->post('description'),
                    'image' => $upload['data'],
                    'quantity' => $this->input->post('quantity')
                ];
                $this->db->insert('products', $insertData);
            }
        }
        $this->load->view('inc/header');
        $this->load->view('add_item', $viewData);
        $this->load->view('inc/footer');
    }



    public function update_item()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('main');
        }
        $user_id = $this->session->userdata('logged_in')['user_id'];

        $viewData = [];
        $this->load->library('form_validation');

        $this->form_validation->set_rules('product_id', 'Product ID', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('product_price', 'Product Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run()) {
            $id = $this->input->post('product_id');
            $upload = $this->do_upload();

            if (isset($upload['error'])) {
                $viewData['error'] = $upload['error'];
            } else {
                $updateData = [
                    'product_name' => $this->input->post('product_name'),
                    'product_price' => $this->input->post('product_price'),
                    'description' => $this->input->post('description'),
                    'quantity' => $this->input->post('quantity')
                ];

                if (!empty($upload['data'])) {
                    $updateData['image'] = $upload['data'];
                }

                $this->db->where('product_id', $id)->update('products', $updateData);
            }
        }
        $this->load->view('inc/header');
        $this->load->view('update_item', $viewData);
        $this->load->view('inc/footer');
    }

    public function delete_item()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('main');
        }
        $user_id = $this->session->userdata('logged_in')['user_id'];


        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_id', 'Product ID', 'required');

        if ($this->form_validation->run()) {
            $id = $this->input->post('product_id');
            $this->db->where('product_id', $id)->delete('products');
        }
        $this->load->view('inc/header');
        $this->load->view('delete_item');
        $this->load->view('inc/footer');
        
    }


    private function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; 
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            return ['error' => $this->upload->display_errors()];
        } else {
            $data = $this->upload->data();
            return ['data' => $data['file_name']];
        }
    }


    public function add_to_sales()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('main');
        }
    
        $user_id = $this->session->userdata('logged_in')['user_id'];
    
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
    
        $product = $this->db->get_where('products', ['product_id' => $product_id])->row();
    
        if (!$product) {
            $data['error'] = 'Product not found';
            redirect('main/product');
        }
      
        $data = array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product->product_price,
            'net_amount' => $quantity * $product->product_price,
            'order_id'=>0,
        );
    
        $this->db->insert('sale_items', $data);

        $item_id = $this->db->insert_id();
        $this->session->set_userdata('current_item_id', $item_id);
    
        redirect('main/sales');
    }


public function delete_sale_item()
{
    if (!$this->session->userdata('logged_in')) {
        redirect('main');
    }
    $item_id = $this->input->post('item_id');

    $this->db->where('sale_item_id', $item_id);
    $this->db->delete('sale_items'); 

    $response['success'] = true;
    $response['message'] = 'Sale item deleted successfully';
}


public function sales()
{
    if (!$this->session->userdata('logged_in')) {
        redirect('main');
    }

    $user_id = $this->session->userdata('logged_in')['user_id'];

    $data['sale_items'] = $this->db->where('user_id', $user_id)->where('order_id', 0)->get('ci_sale_items')->result(); // Update the table name to "ci_sale_items"

    $this->load->view('inc/header');
    $this->load->view('sales', $data);
    $this->load->view('inc/footer');
}



public function sale_list()
{
    if (!$this->session->userdata('logged_in')) {
        redirect('main');
    }

    $user_id = $this->session->userdata('logged_in')['user_id'];
    $item_id = $this->session->userdata('current_item_id');

    $latestSale = $this->db->where('user_id', $user_id)->order_by('sale_id', 'desc')->limit(1)->get('ci_sales_list')->row();

    $hasSubmittedSaleItems = $this->session->userdata('current_item_id') !== null;

    if ($hasSubmittedSaleItems && (!$latestSale || $latestSale->sale_id !== null)) {
        $sale_id = $latestSale ? $latestSale->sale_id + 1 : 1;
    } else {
        $sale_id = $latestSale ? $latestSale->sale_id : null;
    }

    $totalAmount = $this->db->select_sum('net_amount')->where('order_id', 0)->get('ci_sale_items')->row()->net_amount;

    $totalAmount = $totalAmount ? $totalAmount : 0;

    $data = array(
        'totalAmount' => $totalAmount,
        'user_id' => $user_id,
    );

    if ($sale_id !== null && (!$latestSale || $latestSale->sale_id !== $sale_id)) {
        $data['sale_id'] = $sale_id;
        $this->db->insert('sales_list', $data); 
        $sale_id = $this->db->insert_id();
    } elseif ($sale_id !== null && $latestSale) {
        $sale_id = $latestSale->sale_id;
    } else {
        $sale_id = null;
    }

    if ($sale_id) {
        $this->db->where('order_id', 0)->update('ci_sale_items', ['order_id' => $sale_id]);

        $data['sale_items'] = $this->db->where('order_id', $sale_id)->get('ci_sale_items')->result();
        $data['sale_id'] = $sale_id;
        $data['salesList'] = $this->db->where('user_id', $user_id)->get('ci_sales_list')->result();
    } else {
        $data['sale_id'] = null;
        $data['sale_items'] = [];
        $data['salesList'] = [];
    }

    $this->session->unset_userdata('current_item_id');

    $this->load->view('inc/header');
    $this->load->view('sale_list', $data);
    $this->load->view('inc/footer');
}


public function view_details($sale_id = null)
{
    if (!$this->session->userdata('logged_in')) {
        redirect('main');
    }

    $user_id = $this->session->userdata('logged_in')['user_id'];

    $sale = $this->db
        ->select('sales_list.sale_id, sales_list.totalAmount, sale_items.product_id, ci_sale_items.quantity, sale_items.price, sale_items.net_amount')
        ->join('sale_items', 'sales_list.sale_id = sale_items.order_id')
        ->where('sales_list.user_id', $user_id)
        ->where('sales_list.sale_id', $sale_id)
        ->get('sales_list')
        ->result();

    if (!$sale) {
        $sale = array();
    }

    $data['sale'] = $sale;

    $saleItems = $this->db
        ->where('order_id', $sale_id)
        ->where('user_id', $user_id)
        ->get('ci_sale_items')
        ->result();

    $this->load->view('inc/header');
    $this->load->view('sale_details', $data);
    $this->load->view('inc/footer');
}

public function logout()
{
    if (!$this->session->userdata('logged_in')) {
        redirect('main');
    }

    $this->session->unset_userdata('logged_in');
    redirect('main');
}

}


