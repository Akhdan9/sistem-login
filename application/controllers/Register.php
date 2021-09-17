<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct(){
        
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index(){

        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered !'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        if($this->form_validation->run() == false){
            $data['title'] = 'Register User';
            $this->load->view('template/auth_header' , $data);
            $this->load->view('auth/register');
            $this->load->view('template/auth_footer');
            
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_role' => 2,
                'is_active' => 1,
                'date_create' => time()
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your account has been created. Please Activate your account in email !</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type){
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'example@gmail.com',
            'smtp_pass' => 'password',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->load->library('email', $config);
        // put your email here
        $this->email->from('example@gmail.com', 'Your name'); 
        $this->email->to($this->input->post('email'));

        if($type == 'verify'){

            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="'. base_url() . 
            'register/verify?email=' . $this->input->post('email') . 
            '&token=' . urlencode($token) .'">Activate</a>');
        } else if($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to Reset your password : <a href="' . base_url() .
            'register/resetpassword?email=' . $this->input->post('email') .
            '&token=' . urlencode($token) . '">Reset password</a>');
        }

        if($this->email->send()){
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify(){

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user){
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if($user_token){
                 $this->db->set('is_active', 1);
                 $this->db->where('email', $email);
                 $this->db->update('user');

                 $this->db->delete('user_token', ['email' => $email]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'. $email .' has been activated!
                Please Login.</div>');
                redirect('auth');
            } else  {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong token.</div>');
                redirect('auth');
            }

        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed ! Wrong email.</div>');
            redirect('auth');
        }

    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/forgot-password', $data);
            $this->load->view('template/auth_footer', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Please check your email to reset password</div>');
                redirect('register/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email is not registered or activated</div>');
                redirect('register/forgotpassword');
            }
        }
    }

    public function resetPassword(){
        $email = $this->input->get('email');
        $token  = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token]);
            $this->changePassword();
            
            if($user_token){
                $this->session->set_userdata('reset_email', $email);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                   Wrong token</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset password failed! wrong email</div>');
            redirect('auth');
        }
    }

    public function changePassword(){

        // if(!$this->session->userdata('reset_email')){
        //     redirect('auth');
        // }

        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->form_validation->run() == false){
            $data['title'] = 'Change Password';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/change-password', $data);
            $this->load->view('template/auth_footer', $data);

        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    password has been changed. Please Login again !</div>');
            redirect('auth');
        }
    }

    

    
}