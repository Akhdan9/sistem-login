<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model {
    public function getSubMenu()
    {
        $query = "SELECT `sub_menu`.*, `menu`.`menu`
                    FROM `sub_menu` JOIN `menu`
                    ON `sub_menu`.`id_menu` = `menu`.`id_menu`";
        
        return $this->db->query($query)->result_array();
    }
}
