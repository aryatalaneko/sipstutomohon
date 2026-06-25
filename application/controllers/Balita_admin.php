<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balita_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('auth');
        // }
        $this->load->model('Balita_model');
        $this->load->model('Kelurahan_model');
    }

    public function index() {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $puskesmas_id = $this->session->userdata('puskesmas_id');
        $id_kelurahan = $this->input->get('id_kelurahan');
        $nama = $this->input->get('nama');
        $status_stunting = $this->input->get('status_stunting');
        
        $data['balita'] = $this->Balita_model->get_all_balita_by_puskesmas($puskesmas_id, $id_kelurahan, $nama, $status_stunting);
        $data['kecamatan'] = $this->Kelurahan_model->get_kecamatan();
        $data['kelurahan'] = $this->Kelurahan_model->get_kelurahan();
        $data['kelurahan_puskesmas'] = $this->Balita_model->get_kelurahan_by_puskesmas($puskesmas_id);
        $data['filter_kelurahan'] = $id_kelurahan;
        $data['filter_nama'] = $nama;
        $data['filter_status'] = $status_stunting;

        $this->load->view('admin_puskesmas_balita_index', $data);
    }

    public function detail($id) {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $data['balita'] = $this->Balita_model->get_balita_by_id($id);
        if (!$data['balita']) {
            show_404();
        }
        $data['pengukuran'] = $this->Balita_model->get_pengukuran_by_balita($id);
        $this->load->view('admin_puskesmas_balita_detail', $data);
    }

    public function update_identitas() {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $id = $this->input->post('id');
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'id_kelurahan' => $this->input->post('id_kelurahan')
        ];
        $this->Balita_model->update_balita($id, $data);
        $this->session->set_flashdata('success', 'Data identitas balita berhasil diperbarui!');
        redirect('balita_admin/index');
    }

    public function tambah_pengukuran_bulanan() {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $balita_id = $this->input->post('balita_id');
        $data_pengukuran = [
            'balita_id' => $balita_id,
            'tgl_pengukuran' => $this->input->post('tgl_pengukuran'),
            'berat_badan' => $this->input->post('berat_badan'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'zscore_tbu' => $this->input->post('zscore_tbu'),
            'zscore_bbu' => $this->input->post('zscore_bbu'),
            'zscore_bbtb' => $this->input->post('zscore_bbtb'),
            'status_stunting' => $this->input->post('status_stunting')
        ];
        $this->Balita_model->insert_pengukuran($data_pengukuran);
        $this->session->set_flashdata('success', 'Riwayat pengukuran baru berhasil ditambahkan!');
        redirect('balita_admin/detail/'.$balita_id);
    }

    public function tambah() {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $data['kecamatan'] = $this->Kelurahan_model->get_kecamatan();
        $data['kelurahan'] = $this->Kelurahan_model->get_kelurahan();
        $this->load->view('admin_puskesmas_tambah', $data);
    }

    public function simpan_pengukuran() {
        // Balita Data
        $data_balita = [
            'puskesmas_id' => $this->session->userdata('puskesmas_id') ? $this->session->userdata('puskesmas_id') : 0, 
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'id_kelurahan' => $this->input->post('id_kelurahan')
        ];
        
        $balita_id = $this->Balita_model->insert_balita($data_balita);

        // Pengukuran Data
        $data_pengukuran = [
            'balita_id' => $balita_id,
            'tgl_pengukuran' => $this->input->post('tgl_pengukuran'),
            'berat_badan' => $this->input->post('berat_badan'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'zscore_tbu' => $this->input->post('zscore_tbu'),
            'zscore_bbu' => $this->input->post('zscore_bbu'),
            'zscore_bbtb' => $this->input->post('zscore_bbtb'),
            'status_stunting' => $this->input->post('status_stunting')
        ];

        $this->Balita_model->insert_pengukuran($data_pengukuran);

        $this->session->set_flashdata('success', 'Data balita dan pengukuran awal berhasil disimpan!');
        redirect('balita_admin/index');
    }

    public function hapus($id) {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
        $this->Balita_model->hapus_balita($id);
        $this->session->set_flashdata('success', 'Data balita dan riwayat pengukurannya berhasil dihapus secara permanen.');
        redirect('balita_admin/index');
    }
}
