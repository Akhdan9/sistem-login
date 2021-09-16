<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roleaccess extends CI_Controller
{


    public function index($id_role)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('role', ['id_role' => $id_role])->row_array();

        $data['menu'] = $this->db->get('menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/v_roleaccess', $data);
        $this->load->view('template/footer');
    }
}
