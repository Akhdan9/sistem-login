<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index(){

        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/v_admin', $data);
        $this->load->view('template/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('role')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/v_role', $data);
        $this->load->view('template/footer');
    }

    public function roleaccess($id_role)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('role', ['id_role' => $id_role])->row_array();
        $this->db->where('id_menu !=', 1);
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/v_roleaccess', $data);
        $this->load->view('template/footer');
    }

    public function change(){
        
        $id_menu = $this->input->post('id_menu');
        $id_role = $this->input->post('id_role');

        $data = [
            'id_role' => $id_role,
            'id_menu' => $id_menu
        ];

        $result = $this->db->get_where('access_menu', $data);
        if($result->num_rows() < 1) {
            $this->db->insert('access_menu', $data);
        } else {
            $this->db->delete('access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
        Access Changed</div>');
    }




}