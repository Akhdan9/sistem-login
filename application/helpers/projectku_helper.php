<?php 

function is_logged_in()
{
    $ok = get_instance();
    if(!$ok->session->userdata('email')){
        redirect('auth');
    } else {
        $id_role = $ok->session->userdata('id_role');
        $menu = $ok->uri->segment(1);

        $queryMenu = $ok->db->get_where('menu', ['menu' => $menu])->row_array();
        $id_menu = $queryMenu['id_menu'];

        $userAccess = $ok->db->get_where('access_menu', [
            'id_role' => $id_role, 
            'id_menu' => $id_menu]);

            if($userAccess->num_rows() < 1) {
                redirect('auth/blocked');
            }
    }
}

function check_access($id_role, $id_menu)
{
    $ok = get_instance();

    $ok->db->where('id_role', $id_role);
    $ok->db->where('id_menu', $id_menu);
    $result = $ok->db->get('access_menu');

    if($result->num_rows() > 0){
        return "checked='checked'";
    }
}
