<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'superadmin') {
            redirect('auth');
        }
    }

    public function index() {
        $data['user'] = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();
        $this->load->view('admin_akun', $data);
    }

    public function update_password() {
        $user_id = $this->session->userdata('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        $user = $this->db->get_where('users', ['id' => $user_id])->row_array();

        if (password_verify($old_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $this->db->where('id', $user_id);
                $this->db->update('users', ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);
                $this->session->set_flashdata('success', 'Password berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Password baru dan konfirmasi tidak cocok.');
            }
        } else {
            $this->session->set_flashdata('error', 'Password lama salah.');
        }

        redirect('akun');
    }
}
