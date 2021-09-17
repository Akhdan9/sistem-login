<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index(){
        
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        
        if($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/v_menu', $data);
            $this->load->view('template/footer');

        } else {
            $this->db->insert('menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Success add menu</div>');
            redirect('menu');
        }
    }

    public function deleteMenu($id)
    {
        $this->db->delete('menu', ['id_menu' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu has been deleted
        </div>');
        redirect('menu');
    }

   


}