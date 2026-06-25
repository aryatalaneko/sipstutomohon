<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    class MockSession {
        public function userdata($key) { return 1; }
        public function flashdata($key) { return null; }
    }
    class MockDB {
        public function where() { return $this; }
        public function count_all_results() { return 10; }
        public function select() { return $this; }
        public function get() { 
            return new class {
                public $k_count = 5;
                public function row() { return $this; }
            };
        }
    }
    class MockCI {
        public $session;
        public $db;
        public function __construct() {
            $this->session = new MockSession();
            $this->db = new MockDB();
        }
        public function run_view() {
            $balita = [
                ['id' => 1, 'nama_lengkap' => null, 'jenis_kelamin' => 'L', 'tgl_lahir' => '2020-01-01', 'nama_kelurahan' => null, 'nama_kecamatan' => null, 'tgl_pengukuran_terakhir' => null, 'id_kecamatan' => 1, 'id_kelurahan' => 1]
            ];
            $kecamatan = [
                 ['id' => 1, 'nama_kecamatan' => null]
            ];
            $kelurahan = [];
            include 'c:/laragon/www/sipstu/application/views/admin_puskesmas_balita_index.php';
        }
    }

    function get_instance() {
        global $mockCI;
        if (!$mockCI) $mockCI = new MockCI();
        return $mockCI;
    }

    function base_url($path = '') { return 'http://localhost/' . $path; }

    
try {
    $ci = get_instance();
    $ci->run_view();
    echo "OK";
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine();
}
