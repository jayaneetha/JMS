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

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|is_unique[user.email_address]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');

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
                $error = array('error' => "Password is incorrect!");
                $this->load->view('login',$error);
            }
        } else {
            $error = array('error' => "E-mail is wrong!");
            $this->load->view('login',$error);
        }
    }

    public function register() {

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

        // Image Uploading
        $config['upload_path'] = './assests/img/profile_images/';
        $config['allowed_types'] = 'jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('register_author', $error);
        } else {
            $imgdata = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $imgdata);
        }
        // Image Uploading

        $password = sha1($this->input->post('password'));

        $data = array(
            'email_address' => $this->input->post('email_address'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'title' => $this->input->post('title'),
            'gender' => $this->input->post('gender'),
            'password' => $password,
            'mobile_no' => $this->input->post('mobile_no'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            'postal_code' => $this->input->post('postal_code'),
            'country' => $this->input->post('country'),
            'role' => $this->input->post('role'),
            'profile_picture_URL' => $imgdata['full_path'],
            'security_question' => $this->input->post('security_question'),
            'security_answer' => $this->input->post('security_answer')
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_author');
        } else {
            $this->user_model->saveUser($data);
//            $this->load->view('formsuccess');
        }
    }

    public function view_login_log() {
        $log_data = $this->model->loginLogRetriv();
        $login_data = array(
            'log_data' => $log_data
        );
        $this->load->view('view_log', $login_data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>