<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function get_user($username) {
        $this->db->select('users.*, puskesmas.id as puskesmas_id, puskesmas.nama_puskesmas');
        $this->db->from('users');
        $this->db->join('puskesmas', 'puskesmas.user_id = users.id', 'left');
        $this->db->where('users.username', $username);
        return $this->db->get()->row_array();
    }
}
