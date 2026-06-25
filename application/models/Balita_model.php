<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balita_model extends CI_Model {
    public function insert_balita($data) {
        $this->db->insert('balita', $data);
        return $this->db->insert_id();
    }
    
    public function insert_pengukuran($data) {
        return $this->db->insert('pengukuran_balita', $data);
    }
    
    public function get_all_balita_by_puskesmas($puskesmas_id, $id_kelurahan = null, $nama = null, $status_stunting = null) {
        $this->db->select('balita.*, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan, (SELECT MAX(tgl_pengukuran) FROM pengukuran_balita WHERE balita_id = balita.id) as tgl_pengukuran_terakhir, (SELECT status_stunting FROM pengukuran_balita WHERE balita_id = balita.id ORDER BY tgl_pengukuran DESC LIMIT 1) as status_stunting_terakhir');
        $this->db->from('balita');
        $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = balita.id_kecamatan', 'left');
        $this->db->where('balita.puskesmas_id', $puskesmas_id);
        
        if ($id_kelurahan) {
            $this->db->where('balita.id_kelurahan', $id_kelurahan);
        }
        
        if ($nama) {
            $this->db->like('balita.nama_lengkap', $nama, 'both');
        }

        if ($status_stunting) {
            $this->db->where("(SELECT status_stunting FROM pengukuran_balita WHERE balita_id = balita.id ORDER BY tgl_pengukuran DESC LIMIT 1) = " . $this->db->escape($status_stunting), NULL, FALSE);
        }
        
        $this->db->order_by('balita.id', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_kelurahan_by_puskesmas($puskesmas_id) {
        $this->db->select('DISTINCT(balita.id_kelurahan) as id, kelurahan.nama_kelurahan, kelurahan.id_kecamatan');
        $this->db->from('balita');
        $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->where('balita.puskesmas_id', $puskesmas_id);
        $this->db->where('balita.id_kelurahan IS NOT NULL');
        $this->db->order_by('kelurahan.nama_kelurahan', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_balita_by_id($id) {
        $this->db->select('balita.*, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan');
        $this->db->from('balita');
        $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = balita.id_kecamatan', 'left');
        $this->db->where('balita.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_pengukuran_by_balita($balita_id) {
        $this->db->where('balita_id', $balita_id);
        $this->db->order_by('tgl_pengukuran', 'DESC');
        return $this->db->get('pengukuran_balita')->result_array();
    }

    public function update_balita($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('balita', $data);
    }

    public function hapus_balita($id) {
        $this->db->delete('pengukuran_balita', ['balita_id' => $id]);
        return $this->db->delete('balita', ['id' => $id]);
    }
}
