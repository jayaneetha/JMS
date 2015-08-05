<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {
        $email = $this->input->post('email_address');
        $pass = $this->input->post('password');
        $remember = $this->input->post('remember');
        $ip = $this->input->server('REMOTE_ADDR');

        $pass = sha1($pass);

        $user = $this->user_model->get_pass($email);

        if (!is_null($user)) {
//            $pass = hash("md5", $pass);
            if ($user->password === $pass) {
                $this->load->view('home');
                $this->user_model->loginLogSave($user->id, $ip);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function register() {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|is_unique[user.email_address]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');
        $this->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
        $this->form_validation->set_rules('security_question', 'security_question', 'required');
        $this->form_validation->set_rules('security_answer', 'security_answer', 'required');
        
        $data = array();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $this->user_model->saveUser($data);
            $this->load->view('formsuccess');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>