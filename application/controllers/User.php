<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->model('Admin_model');
        $this->load->model('Home_model');
        $this->load->library('session');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        
        define('USER_ID', $this->session->userdata('user_id'));

        date_default_timezone_set('Asia/Dubai');
    }

    public function index()
    {
        redirect('');
    }

    public function login_check()
    {
        if ($this->session->userdata('username') == FALSE) {
            $this->session->set_userdata('error', 'You are not Logged In, Please Login First !');
            redirect('');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('');
    }

    public function dashboard()
    {
        $this->login_check();
        
        $graph = $this->Home_model->getAllRecords('receipts', "count(id) as total, sum(amount) as total_amount, date", ['user_id' => USER_ID], 'STR_TO_DATE(date, "%d/%m/%Y") ASC', 'date');
        
        $dates = array_map(function($value) {
            return $value['date'];
        }, $graph);
        $last_date = end($dates);
        $m = str_replace('/', ' ', substr($last_date, 3, 2));
        $array_date = array_fill(0, count($dates), $m);
        
        $amounts = array_map(function($value) {
            return $value['total_amount'];
        }, $graph);
        
        $total = array_map(function($value) {
            return $value['total'];
        }, $graph);
        
        $last = array_map(function($value, $month) {
            $vm = str_replace('/', ' ', substr($value['date'], 3, 2));
            if ($vm == $month) return $value['total_amount'];
        }, $graph, $array_date);
        
        $result['total_spent'] = array_sum($amounts);
        $result['last_month_spent'] = array_sum($last);
        $result['total_records'] = array_sum($total);
        
        $data['graph'] = json_encode($amounts);
        $data['dates'] = json_encode($dates);
        
        $this->load->view('user/header');
        $this->load->view('user/dashboard', $result);
        $this->load->view('user/footer', $data);
    }

    function view_receipts()
    {
        $this->login_check();

        $result['receipts'] = $this->Home_model->getAllRecords('receipts', '', ['user_id' => USER_ID], 'id DESC');

        $this->load->view('user/header');
        $this->load->view('user/receipts', $result);
        $this->load->view('user/footer');
    }

    function receipt_detail($id)
    {
        $this->login_check();

        $result['receipt'] = $this->Home_model->getRecord('receipts', ['id' => $id, 'user_id' => USER_ID]);

        $this->load->view('user/header');
        $this->load->view('user/receipt-detail', $result);
        $this->load->view('user/footer');
    }

}
