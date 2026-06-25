<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan_model extends CI_Model {
    public function get_kecamatan() {
        $this->db->order_by('nama_kecamatan', 'ASC');
        return $this->db->get('kecamatan')->result_array();
    }
    
    public function get_kelurahan() {
        $this->db->select('kelurahan.*, kecamatan.nama_kecamatan');
        $this->db->from('kelurahan');
        $this->db->join('kecamatan', 'kecamatan.id = kelurahan.id_kecamatan');
        $this->db->order_by('kecamatan.nama_kecamatan', 'ASC');
        $this->db->order_by('kelurahan.nama_kelurahan', 'ASC');
        return $this->db->get()->result_array();
    }

    public function insert_kecamatan($data) {
        return $this->db->insert('kecamatan', $data);
    }
    
    public function update_kecamatan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kecamatan', $data);
    }
    
    public function delete_kecamatan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kecamatan');
    }

    public function insert_kelurahan($data) {
        return $this->db->insert('kelurahan', $data);
    }
    
    public function update_kelurahan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kelurahan', $data);
    }
    
    public function delete_kelurahan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kelurahan');
    }
}
