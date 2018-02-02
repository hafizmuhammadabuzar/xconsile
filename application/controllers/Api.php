<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Home_model');
        $this->load->library('form_validation');

        define('success', 'Success');
        define('error', 'Error');
        
	date_default_timezone_set('Asia/Dubai');
    }

    public function signup() {

        $user_id = trim($this->input->get_post('userId'));
        $username = trim($this->input->get_post('username'));
        $email = trim($this->input->get_post('email'));
        $password = trim($this->input->get_post('password'));
        $token = $this->input->get_post('deviceToken');

        if (empty($username) || empty($email) || empty($password)) {
            $result['status'] = error;
            $result['msg'] = 'Required fields must not be empty';
        } 
        else {
            $enc_token = md5($email . time());
            $user_data = array(
                'username' => $username,
                'email' => $email,
                'password' => sha1($password),
                'gender' => ucfirst($this->input->get_post('gender')),
                'dob' => $this->input->get_post('dob'),
                'remember_token' => $enc_token,
            );
            
            $check = $this->Home_model->getRecord('users', ['email' => $email]);
            $username_check = $this->Home_model->getRecord('users', ['username' => $username]);

            if ($check) {
                if(isset($user_id) && !empty($user_id)){
                    $this->Home_model->updateRecord('users', ['id' => $user_id], $user_data);
                
                    $result['status'] = success;
                    $result['msg'] = 'Profile Successfully Updated';
                } else{
                    $result['status'] = error;
                    $result['msg'] = 'Email already exists';
                }

                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            }
            else if($username_check){
                $result['status'] = error;
                $result['msg'] = 'Username already exists';

                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            }
            
//            if( !empty($_FILES['picture']['name']) ){
//
//                $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
//                $image_name = uniqid() . '.' . $ext;
//                move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/' . $image_name);
//            }

            $res = $this->Home_model->saveRecord('users', $user_data);

            if ($res) {
                $result['status'] = success;
                
                $msg = 'Dear User, <br><br>
                        Confirm your email address to complete your activate your account. Its easy &#45 just click on the button below.</p>
                        <a href="' . base_url() . 'account/verification/?status=' . $enc_token . '">Click Here</a><br><br>
                        </body>
                        </html>';

                $this->send_email($email, $username, 'XConsile Account Verification', $msg);

                $result['msg'] = 'Successfully signed up, Please check your email for verification';
            } else {
                $result['status'] = error;
                $result['msg'] = 'Some error Occurred';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function user_verify() {
        $token = $_GET['status'];

        if (empty($token)) {
            echo 'Invalid Request';
        } else {
            $check = $this->Home_model->getRecord('users', array('remember_token' => $token));
            if ($check) {
                $enc_token = md5(time());
                $this->Home_model->updateRecord('users', ['remember_token' => $token], array('status' => 1, 'remember_token' => $enc_token));
                die('Account Successfully Verified');
//                $this->load->view('reset_password', ['msg' => 'Account Successfully Verified']);
            } else {
                die('Some error occurred');
//                $this->load->view('reset_password', ['msg' => 'Some Error Occurred']);
            }
        }
    }

    public function login() {

        $email = trim($this->input->get_post('email'));
        $password = trim($this->input->get_post('password'));

        if (empty($email) || empty($password)) {
            $result['status'] = error;
            $result['msg'] = 'Required fields must not be empty';
        } else {
            $login_data = array(
                'email' => $email,
                'password' => sha1($password)
            );
            $res = $this->Home_model->getRecord('users', $login_data);
            if ($res) {
                if ($res->status == 0) {
                    $result['status'] = 'pending';
                    $result['msg'] = 'Not verified';
                }
                else if ($res->status == 2) {
                    $result['status'] = error;
                    $result['msg'] = 'Inactive account, Please contact with Administrator';
                } else {
                    $result['status'] = success;
                    $result['msg'] = 'User Found';
                    $result['profile']['userId'] = $res->id;
                    $result['profile']['username'] = $res->username;
                    $result['profile']['email'] = $res->email;
                    $result['profile']['gender'] = $res->gender;
                    $result['profile']['dob'] = $res->dob;
                }
            } else {
                $result['status'] = error;
                $result['msg'] = 'Invalid Username OR Password';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function logout() {

        $token = $this->input->get_post('deviceToken');
        if (empty($token)) {
            $result['status'] = success;
            $result['msg'] = 'Successfully logged out';
        } else {
            $res = $this->Home_model->updateRecord('tokens', ['token' => "$token"], ['user_email' => '']);
            
            $result['status'] = success;
            $result['msg'] = 'Successfully logged out';
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function forgot_password() {

        $email = trim($this->input->get_post('email'));
        if (empty($email)) {
            $result['status'] = error;
            $result['msg'] = 'Email required';
        } else {
            $check = $this->Home_model->getRecord('users', ['email' => $email]);
            if ($check) {
                if ($check->status == 0) {
                    $result['status'] = 'pending';
                    $result['msg'] = 'Not verified';
                } else {
                    $msg = 'Please click the given link to Reset Password<br>
                            <a href="' . base_url() . 'password/reset/?status=' . $check->remember_token . '" targer="blank">Click Here</a><br/><br/>If this email does not display correctly, please copy and paste the following link in your address bar: ' . base_url() . 'password/reset/?status=' . $check->remember_token;

                    $this->send_email($email, $check->username, 'XConsile Password Reset', $msg);

                    $result['status'] = success;
                    $result['msg'] = 'Email Sent';
                }
            } else {
                $result['status'] = error;
                $result['msg'] = 'Email not found';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result); exit();
    }

    public function reset() {

        $this->form_validation->set_rules('new_pass', 'Password', 'required');
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_rules('new_pass_conf', 'Password Confirmation', 'required|matches[new_pass]');

        if (!$this->form_validation->run() == FALSE) {
            $token = $this->input->post('token');
            $password = sha1($this->input->post('new_pass'));
            if ($this->Home_model->resetPassword($password, $token)) {
                $result['status'] = success;
                $result['msg'] = 'Password Updated';
            } else {
                $result['status'] = error;
                $result['msg'] = 'Invalid request';
            }
        }

        echo json_encode($result); exit();
    }

    public function reset_password() {

        if (!isset($_POST['reset_btn'])) {
            $token = $_GET['status'];
            if (empty($token)) {
                $this->load->view('reset_password', ['msg' => 'Invalid Request']);
            } else {
                $check = $this->Home_model->getRecord('users', ['remember_token' => "$token"]);
                if ($check) {
                    $this->session->set_userdata('token', $token);
                    $this->load->view('reset_password');
                } else {
                    $this->load->view('reset_password', ['msg' => 'Link Expired']);
                }
            }
        } else {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('reset_password');
            } else {
                if ($this->session->userdata('token') == TRUE) {
                    $data = ['password' => sha1($this->input->post('password')), 'remember_token' => md5(time())];
                    $res = $this->Home_model->updateRecord('users', ['remember_token' => $this->session->userdata('token')], $data);
                    if ($res == 0 || $res == 1) {
                        $this->session->unset_userdata('token');
                        session_destroy();
                        $this->load->view('reset_password', ['msg' => 'Password Successfully Reset']);
                    } else {
                        $this->load->view('reset_password', ['msg' => 'Link Expired']);
                    }
                } else {
                    $this->load->view('reset_password', ['msg' => 'Invalid Request']);
                }
            }
        }
    }
    
    public function addReceipt() {

        $receipt_id = trim($this->input->get_post('receiptId'));
        $user_id = trim($this->input->get_post('userId'));
        $title = trim($this->input->get_post('title'));
        $code = trim($this->input->get_post('code'));
        $date = trim($this->input->get_post('date'));
        $location = $this->input->get_post('location');
        $amount = $this->input->get_post('transactionAmount');

        if (empty($user_id) || empty($title) || empty($code) || empty($date) || empty($location) || empty($amount)) {
            $result['status'] = error;
            $result['msg'] = 'Required fields must not be empty';
        } 
        else {
            if( !empty($_FILES['image']['name']) ){
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image_name = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_name);
            }
            
            $receipt_data = array(
                'user_id' => $user_id,
                'title' => $title,
                'code' => $code,
                'date' => $date,
                'location' => $location,
                'amount' => $amount,
                'image' => (isset($image_name)) ? $image_name : '',
                'created_at' => date('Y-m-d H:i:s')
            );
            
            if(!empty($receipt_id)){
                if(isset($image_name) && empty($image_name)){
                    unset($receipt_data['image']);
                }else{
                    $old_image = $this->Home_model->getRecord('receipts', ['id' => $receipt_id, 'user_id' => $user_id]);
                    if($old_image->image && file_exists('uploads/'.$old_image->image)){
                        unlink('uploads/'.$old_image->image);
                    }
                }
                unset($receipt_data['created_at']);
                $res = $this->Home_model->updateRecord('receipts', ['id' => $receipt_id, 'user_id' => $user_id], $receipt_data);
            } else {
                $res = $this->Home_model->saveRecord('receipts', $receipt_data);
            }

            if ($res) {
                $result['status'] = success;
                $result['msg'] = 'Successfully Saved';
            } else {
                $result['status'] = error;
                $result['msg'] = 'Some error Occurred';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result); exit();
    }
    
    public function deleteReceipt() {

        $user_id = trim($this->input->get_post('userId'));
        $receipt_id = trim($this->input->get_post('receiptId'));

        if (empty($user_id) || empty($receipt_id)) {
            $result['status'] = error;
            $result['msg'] = 'Required fields must not be empty';
        } 
        else {
            $check = $this->Home_model->getRecord('receipts', ['id' => $receipt_id, 'user_id' => $user_id]);

            if ($check) {
                unlink('uploads/'.$check->image);
                
                $res = $this->Home_model->deleteRecord('receipts', ['id' => $receipt_id, 'user_id' => $user_id]);
                
                if($res == 1){
                    $result['status'] = success;
                    $result['msg'] = 'Successfully Deleted';
                }
                else{
                    $result['status'] = error;
                    $result['msg'] = 'Could not be deleted';
                }
            } else {
                $result['status'] = error;
                $result['msg'] = 'Record not found';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result); exit();
    }
    
    public function getReceipts() {
        
        $user_id = trim($this->input->get_post('userId'));

        if (empty($user_id)) {
            $result['status'] = error;
            $result['msg'] = 'Required fields must not be empty';
        } 
        else {
            $receipts = $this->Home_model->getAllRecords('receipts', "id as receipt_id, title, code, date, location, amount, CONCAT('".base_url()."uploads/', image) as image", ['user_id' => $user_id], 'STR_TO_DATE(date,"%d/%m/%Y") DESC, id DESC');
            
            $graph = $this->Home_model->getAllRecords('receipts', "sum(amount) as total_amount, date, created_at", ['user_id' => $user_id], 'STR_TO_DATE(date,"%d/%m/%Y") ASC', 'date');

            if ($receipts) {
                $result['status'] = success;
                $result['msg'] = 'All Receipts';
                $result['graph'] = $graph;
                $result['receipts'] = $receipts;
            } else {
                $result['status'] = error;
                $result['msg'] = 'Record not found';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result); exit();
    }
    
    protected function send_email($to, $f_name='', $subject, $msg) {

        $headers = 'From: do-not-reply@xconsile.com' . "\r\n" .
                'Reply-To: do-not-reply@xcosile.com'."\r\n" .
                'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $msg, $headers);
    }

    public function save_token() {

        $token = $this->input->get_post('deviceToken');

        if (empty($token)) {
            $result['status'] = 'Error';
            $result['msg'] = 'Token required';
        } else {
            $fields = array(
                'app_id' => "3f639b9a-f9cd-4c81-8bc9-80ff744ec0c4",
                'identifier' => $token,
                'language' => "en",
                'timezone' => "-28800",
                'game_version' => "1.0",
                'device_os' => "",
                'device_type' => "0",
                'device_model' => "iPhone",
                'test_type' => 2
            );

            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($response);
            $check = $this->Home_model->getRecord('tokens', ['token' => $token]);
            if ($check) {
                $this->Home_model->updateRecord('tokens', ['token' => "$token"], ['token' => "$token", 'player_id' => "$response->id"]);

                $result['status'] = 'Success';
                $result['msg'] = 'Successfully Updated';
            } else {
                $date = date('Y-m-d H:i:s');
                $res = $this->Home_model->saveRecord('tokens', ['token' => "$token", 'player_id' => $response->id, 'created_date' => $date]);
                if ($res) {
                    $result['status'] = 'Success';
                    $result['msg'] = 'Successfully Saved';
                } else {
                    $result['status'] = 'Error';
                    $result['msg'] = 'Could not be saved';
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function save_android_token() {

        $token = $this->input->get_post('token');
        $device_id = $this->input->get_post('device_id');

        if (empty($token) && empty($device_id)) {
            $result['status'] = 'Error';
            $result['msg'] = 'Token & Deveice Id Required';
        } else if (empty($token)) {
            $result['status'] = 'Error';
            $result['msg'] = 'Token Required';
        } else if (empty($device_id)) {
            $result['status'] = 'Error';
            $result['msg'] = 'Device Id Required';
        } else {
            $token_data = array(
                'token' => $token,
                'device_id' => $device_id,
                'created_date' => date('Y-m-d H:i:s')
            );

            $check = $this->Home_model->getRecord('tokens', ['device_id' => "$device_id"]);
            if ($check) {
                $this->Home_model->updateRecord('tokens', ['device_id' => "$device_id"], ['token' => $token]);
                $result['status'] = 'Success';
                $result['msg'] = 'Successfully Updated';
            } else {
                $res = $this->Home_model->saveRecord('tokens', $token_data);
                if ($res) {
                    $result['status'] = 'Success';
                    $result['msg'] = 'Successfully Saved';
                } else {
                    $result['status'] = 'Error';
                    $result['msg'] = 'Could not be saved';
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function test_android_push() {

        $noti_title = 'Dear Fridge App User';
        $body = 'Welcome to Fridge App';
        
        $ids[] = 'APA91bFp1ClfAmOTZPpf7gCgvNKmw__Xtb6BB7_MoPiXj4FrGC7e61b5mndCzS8YVsRUPeK2U0XYEHSnAKBDdArnoXazyMDQZ5SeJTWuETpJ6Fx6tbGJschE17J4APw48DVaBa_8zBZD';

        define('API_ACCESS_KEY', 'AIzaSyAq208nQaq4tYa5ODrfbyiINwxfKO0qrwg');
        $registrationIds = $ids;

        $msg['notification'] = array
            (
            'title' => $noti_title,
            'message' => $body
        );

        $fields = array
            (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
            (
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
        echo $result;
    }    
    
    public function test_save_token() {

        $fields = array(
            'app_id' => "3f639b9a-f9cd-4c81-8bc9-80ff744ec0c4",
            'identifier' => '6915f407fd4846da9191ed9e6ed6f45399dcdd1deea509dac95f3945637c12e0',
            'language' => "en",
            'timezone' => "-28800",
            'game_version' => "1.0",
            'device_os' => "",
            'device_type' => "0",
            'device_model' => "iPhone",
            'test_type' => 2
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    public function test_ios_notification() {

        $noti_title = 'Test Fridge2';
        $msg = 'Fridge App2';
        
        $title = array(
            "en" => $noti_title
        );
        $content = array(
            "en" => $msg
        );

//        'include_ios_tokens' => ['17215c186b0511ee097000fb5170d5b3f4f60ef7f5fe5201348f9aa5f6f83608'],
        $fields = array(
            'app_id' => "3f639b9a-f9cd-4c81-8bc9-80ff744ec0c4",
            'include_player_ids' => ["2ca66db4-397c-426a-b096-808a29bc1ee8"],
            'contents' => $content,
            'heading' => $title,
            'data' => ['title' => $noti_title, 'body' => $msg],
            'ios_badgeType' => 'SetTo',
            'ios_badgeCount' => 1
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ZThlM2Q3YzYtZjAyYy00YWU0LWE3NWEtMWRlZmU4NTE0ZGIw'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
    
}
