<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            $this->redirect_based_on_role();
        }
        $this->load->view('auth/login');
    }

    public function process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->get_user($username);

        if ($user && password_verify($password, $user['password'])) {
            $userdata = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'puskesmas_id' => $user['puskesmas_id'],
                'nama_puskesmas' => $user['nama_puskesmas'],
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($userdata);
            $this->redirect_based_on_role();
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    private function redirect_based_on_role() {
        if ($this->session->userdata('role') == 'superadmin') {
            redirect('welcome');
        } else {
            redirect('welcome/puskesmas');
        }
    }
}
