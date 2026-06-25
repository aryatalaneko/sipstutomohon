<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klasifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Balita_model');
    }

    public function index() {
        if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }

        $pid = $this->session->userdata('puskesmas_id') ?: 0;
        
        // Sidebar data
        $data['jml_balita'] = $this->db->where('puskesmas_id', $pid)->count_all_results('balita');
        $this->db->select('COUNT(DISTINCT id_kelurahan) as k');
        $this->db->where('puskesmas_id', $pid);
        $rk = $this->db->get('balita')->row();
        $data['jml_kelurahan'] = $rk ? $rk->k : 0;

        // Run Python ML Script
        $python_path = "python"; // Adjust if needed
        $script_path = FCPATH . "application/services/ml/stunting_nb.py";
        
        $command = escapeshellcmd("$python_path \"$script_path\"");
        $output = shell_exec($command);
        
        $ml_result = json_decode($output, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $data['ml_error'] = "Gagal memproses hasil klasifikasi (JSON Error). Output mentah: " . $output;
        } elseif (isset($ml_result['error'])) {
            $data['ml_error'] = $ml_result['error'];
        } else {
            $data['ml_data'] = $ml_result;
        }

        $this->load->view('admin_puskesmas_hasil_klasifikasi', $data);
    }
}
