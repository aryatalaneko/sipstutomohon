<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskesmas_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $this->load->model('Puskesmas_model');
    }

    public function index() {
        $data['puskesmas'] = $this->Puskesmas_model->get_all();
        $this->load->view('admin_puskesmas_index', $data);
    }

    public function create() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama_puskesmas = $this->input->post('nama_puskesmas');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        // Check if username exists
        $this->db->where('username', $username);
        if ($this->db->count_all_results('users') > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan!');
            redirect('puskesmas_admin');
        }

        $data_user = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'admin_puskesmas'
        ];

        $data_puskesmas = [
            'nama_puskesmas' => $nama_puskesmas,
            'no_telp' => $no_telp,
            'alamat' => $alamat,
            'lat' => $lat,
            'lng' => $lng
        ];

        if ($this->Puskesmas_model->insert($data_user, $data_puskesmas)) {
            $this->session->set_flashdata('success', 'Puskesmas berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan Puskesmas.');
        }

        redirect('puskesmas_admin');
    }

    public function update() {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama_puskesmas = $this->input->post('nama_puskesmas');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        // Check username conflict for other users
        $this->db->where('id', $id);
        $p = $this->db->get('puskesmas')->row_array();
        
        $this->db->where('username', $username);
        $this->db->where('id !=', $p['user_id']);
        if ($this->db->count_all_results('users') > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan oleh akun lain!');
            redirect('puskesmas_admin');
        }

        $data_user = ['username' => $username];
        if (!empty($password)) {
            $data_user['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $data_puskesmas = [
            'nama_puskesmas' => $nama_puskesmas,
            'no_telp' => $no_telp,
            'alamat' => $alamat,
            'lat' => $lat,
            'lng' => $lng
        ];

        if ($this->Puskesmas_model->update($id, $data_user, $data_puskesmas)) {
            $this->session->set_flashdata('success', 'Data Puskesmas berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }

        redirect('puskesmas_admin');
    }

    public function delete($id) {
        if ($this->Puskesmas_model->delete($id)) {
            $this->session->set_flashdata('success', 'Puskesmas berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus Puskesmas.');
        }
        redirect('puskesmas_admin');
    }
}
