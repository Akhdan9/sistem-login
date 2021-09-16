<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        
        parent::__construct();
        $this->load->library('form_validation');
        
    }


    public function index(){
        
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Login Page";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
            
        } else {
            //Jika validasi berhasil
            $this->_login();
        }

    }

    
    
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        
        //cek user
        if($user){
            // cek user aktif
            if($user['is_active'] == 1){
                // cek password
                if(password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'id_role' => $user['id_role']
                    ];
                    $this->session->set_userdata($data);
                   
                    if($user['id_role'] == 1){
                        redirect('admin');
                    } else{
                        redirect('user');
                    }
                    
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password</div>');
                    redirect('auth');
                }

                
            } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email has not been activated</div>');
            redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email not registered</div>');
            redirect('auth');
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');

        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
        You has been logout</div>');
        redirect('auth');
    }

    public function blocked(){
        $this->output->set_status_header('404');
        $this->load->view('err404');//loading in custom error view
    }


}
