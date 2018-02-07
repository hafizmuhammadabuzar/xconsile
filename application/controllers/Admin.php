<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
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

        date_default_timezone_set('Asia/Dubai');
    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/admin_login');
        $this->load->view('admin/footer');
    }

    public function login_check()
    {
        if ($this->session->userdata('username') == FALSE) {
            $this->session->set_userdata('error', 'You are not Logged In, Please Login First !');
            redirect('admin');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/admin_login');
            $this->load->view('admin/footer');
        }

        if ($_POST['password'] == 'admin') {
            $this->session->set_userdata('username', $_POST['username']);
            redirect('admin/dashboard');
        }
        else {
            $this->session->set_userdata('error', 'Incorrect Username or Password');
            redirect('admin');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_username');
        $this->session->sess_destroy();
        redirect('admin');
    }

    public function dashboard()
    {
        $this->login_check();

        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    function view_users()
    {
        $this->login_check();

        $result['users'] = $this->Home_model->getAllRecords('users', 'id, username, email, dob, gender, status', '', 'username ASC');

        $this->load->view('admin/header');
        $this->load->view('admin/view_users', $result);
        $this->load->view('admin/footer');
    }

    function view_user_receipts($user_id)
    {
        $this->login_check();

        $result['receipts'] = $this->Home_model->getAllRecords('receipts', '', ['user_id' => $user_id], 'id DESC');
        $graph = $this->Home_model->getAllRecords('receipts', "sum(amount) as total_amount, date, created_at", ['user_id' => $user_id], 'STR_TO_DATE(date,"%d/%m/%Y") ASC', 'date');

        $this->load->view('admin/header');
        $this->load->view('admin/view_receipts', $result);
        $this->load->view('admin/footer');
    }
    
    function receipt_detail($id)
    {
        $this->login_check();

        $result['receipt'] = $this->Home_model->getRecord('receipts', ['id' => $id]);

        $this->load->view('admin/header');
        $this->load->view('admin/receipt-detail', $result);
        $this->load->view('admin/footer');
    }

    public function push_form()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/push_notification');
        $this->load->view('admin/footer');
    }

    public function product_notification()
    {

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('msg', 'Message', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/push_notification');
            $this->load->view('admin/footer');
        }
        else {
            $title = $_POST['title'];
            $msg = $_POST['msg'];

            if (isset($_POST['send_to_android']) && isset($_POST['send_to_ios'])) {
                $result_android = $this->android_push($title, $msg);
                $result_ios = $this->ios_notification($title, $msg);
            }
            else if (isset($_POST['send_to_android'])) {
                $result_android = $this->android_push($title, $msg);
            }
            else if ($_POST['send_to_ios']) {
                $result_ios = $this->ios_notification($title, $msg);
            }
            else {
                $result_android = $this->android_push($title, $msg);
                $result_ios = $this->ios_notification($title, $msg);
            }

            if (isset($result_ios) || isset($result_android)) {
                $this->session->set_userdata('error', 'Successfully Sent !');
                redirect('push_form');
            }
        }
    }

    public function ind_push_form()
    {

        $result['users'] = $this->Api_model->getAllLoggedInUsers();

        $this->load->view('admin_header');
        $this->load->view('ind_push_notification', $result);
        $this->load->view('admin_footer');
    }

    public function ind_product_notification()
    {

        $result_ios = $this->ios_notification($_POST['title'], $_POST['msg'], $_POST['email']);
        $result_android = $this->android_push($_POST['title'], $_POST['msg'], $_POST['email']);

        if (isset($result_ios) || isset($result_android)) {
            $this->session->set_userdata('error', 'Successfully Sent !');

            $result['users'] = $this->Api_model->getAllLoggedInUsers();

            $this->load->view('admin_header');
            $this->load->view('ind_push_notification', $result);
            $this->load->view('admin_footer');
        }
    }

    public function ios_notification($noti_title, $msg, $email = '')
    {

        if (!empty($email)) {
            $tokens = $this->Api_model->getiOSTokens($email);
            foreach ($tokens as $tk) {
                $player_ids[] = $tk['player_id'];
            }

            $devices = ['include_player_ids' => $player_ids, ];
        }
        else {
            $devices = ['included_segments' => array('All')];
        }

        $title = array(
            "en" => $noti_title
        );
        $content = array(
            "en" => $msg
        );

        $fields = array(
            'app_id' => "3f639b9a-f9cd-4c81-8bc9-80ff744ec0c4",
            'contents' => $content,
            'heading' => $title,
            'data' => ['title' => $noti_title, 'body' => $msg],
            'ios_badgeType' => 'SetTo',
            'ios_badgeCount' => 1
        );
        $fields = array_merge($fields, $devices);

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ZThlM2Q3YzYtZjAyYy00YWU0LWE3NWEtMWRlZmU4NTE0ZGIw'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function android_push($title, $body, $email = '')
    {

        $email = (!empty($email)) ? $email : '';

        $tokens = $this->Api_model->getTokens($email);

        foreach ($tokens as $tk) {
            $ids[] = $tk['token'];
        }

        $chunks = array_chunk($ids, 1000);

        foreach ($chunks as $chk) {

            define('API_ACCESS_KEY', 'AIzaSyAq208nQaq4tYa5ODrfbyiINwxfKO0qrwg');
            $registrationIds = $ids;

            $msg['notification'] = array(
                'title' => $title,
                'message' => $body
            );

            $fields = array(
                'registration_ids' => $registrationIds,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        }
    }


}
