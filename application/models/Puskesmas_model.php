<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskesmas_model extends CI_Model {
    
    public function get_all() {
        $this->db->select('puskesmas.*, users.username');
        $this->db->from('puskesmas');
        $this->db->join('users', 'users.id = puskesmas.user_id');
        $this->db->order_by('puskesmas.nama_puskesmas', 'ASC');
        return $this->db->get()->result_array();
    }

    public function insert($data_user, $data_puskesmas) {
        $this->db->trans_start();
        
        $this->db->insert('users', $data_user);
        $user_id = $this->db->insert_id();

        $data_puskesmas['user_id'] = $user_id;
        $this->db->insert('puskesmas', $data_puskesmas);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update($puskesmas_id, $data_user, $data_puskesmas) {
        $this->db->trans_start();
        
        $this->db->where('id', $puskesmas_id);
        $p = $this->db->get('puskesmas')->row_array();
        
        if ($p) {
            $this->db->where('id', $p['user_id']);
            $this->db->update('users', $data_user);

            $this->db->where('id', $puskesmas_id);
            $this->db->update('puskesmas', $data_puskesmas);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete($puskesmas_id) {
        $this->db->where('id', $puskesmas_id);
        $p = $this->db->get('puskesmas')->row_array();
        
        if ($p) {
            $this->db->where('id', $p['user_id']);
            return $this->db->delete('users');
        }
        return false;
    }
}
