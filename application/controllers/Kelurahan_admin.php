<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $this->load->model('Kelurahan_model');
    }

    public function index() {
        $data['kecamatan'] = $this->Kelurahan_model->get_kecamatan();
        $data['kelurahan'] = $this->Kelurahan_model->get_kelurahan();
        $this->load->view('admin_kelurahan_index', $data);
    }

    /* CRUD KECAMATAN */
    public function create_kecamatan() {
        $data = ['nama_kecamatan' => $this->input->post('nama_kecamatan')];
        $this->Kelurahan_model->insert_kecamatan($data);
        $this->session->set_flashdata('success', 'Kecamatan berhasil ditambahkan.');
        redirect('kelurahan_admin');
    }
    
    public function update_kecamatan() {
        $id = $this->input->post('id');
        $data = ['nama_kecamatan' => $this->input->post('nama_kecamatan')];
        $this->Kelurahan_model->update_kecamatan($id, $data);
        $this->session->set_flashdata('success', 'Kecamatan berhasil diperbarui.');
        redirect('kelurahan_admin');
    }

    public function delete_kecamatan($id) {
        $this->Kelurahan_model->delete_kecamatan($id);
        $this->session->set_flashdata('success', 'Kecamatan berhasil dihapus. Semua kelurahan di bawahnya juga ikut terhapus.');
        redirect('kelurahan_admin');
    }

    /* CRUD KELURAHAN */
    public function create_kelurahan() {
        $data = [
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
            'lat' => $this->input->post('lat') ?: null,
            'lng' => $this->input->post('lng') ?: null,
        ];
        $this->Kelurahan_model->insert_kelurahan($data);
        $this->session->set_flashdata('success', 'Kelurahan berhasil ditambahkan.');
        redirect('kelurahan_admin');
    }
    
    public function update_kelurahan() {
        $id = $this->input->post('id');
        $data = [
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
            'lat' => $this->input->post('lat') ?: null,
            'lng' => $this->input->post('lng') ?: null,
        ];
        $this->Kelurahan_model->update_kelurahan($id, $data);
        $this->session->set_flashdata('success', 'Kelurahan berhasil diperbarui.');
        redirect('kelurahan_admin');
    }

    public function delete_kelurahan($id) {
        $this->Kelurahan_model->delete_kelurahan($id);
        $this->session->set_flashdata('success', 'Kelurahan berhasil dihapus.');
        redirect('kelurahan_admin');
    }
}
