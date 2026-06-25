<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

	public function index()
	{
		if ($this->session->userdata('role') != 'superadmin') {
            redirect('welcome/puskesmas');
        }
		$this->load->helper('url');

        $data['jml_balita'] = $this->db->count_all_results('balita');
        $data['jml_puskesmas'] = $this->db->count_all_results('puskesmas');
        
        $current_month = date('m');
        $current_year = date('Y');
        
        $this->db->select('COUNT(DISTINCT balita_id) as measured');
        $this->db->from('pengukuran_balita');
        $this->db->where('MONTH(tgl_pengukuran)', $current_month);
        $this->db->where('YEAR(tgl_pengukuran)', $current_year);
        $measured_res = $this->db->get()->row();
        $data['sudah_diukur'] = $measured_res ? $measured_res->measured : 0;
        $data['belum_diukur'] = max(0, $data['jml_balita'] - $data['sudah_diukur']);
        
        $data['count_normal'] = 0;
        $data['count_stunting'] = 0;
        $data['count_sangat'] = 0;
        
        $this->db->select('status_stunting, balita_id');
        $this->db->from('pengukuran_balita');
        $this->db->where('MONTH(tgl_pengukuran)', $current_month);
        $this->db->where('YEAR(tgl_pengukuran)', $current_year);
        $this->db->order_by('tgl_pengukuran', 'DESC');
        $this->db->order_by('id', 'DESC');
        $statuses = $this->db->get()->result_array();
        
        $processed = [];
        foreach($statuses as $s) {
            if(in_array($s['balita_id'], $processed)) continue;
            $processed[] = $s['balita_id'];
            
            $stat = strtolower($s['status_stunting']);
            if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) {
                $data['count_sangat']++;
            } elseif (strpos($stat, 'stunting') !== false) {
                $data['count_stunting']++;
            } else {
                $data['count_normal']++;
            }
        }

        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$current_month - 1] . ' ' . $current_year;

        // Rekap per Puskesmas
        $latest_msq = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$current_month' AND YEAR(pb2.tgl_pengukuran) = '$current_year')";
        $this->db->select('puskesmas.nama_puskesmas,
            COUNT(DISTINCT balita.id) as total_balita,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as sangat_pendek,
            SUM(CASE WHEN (pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" AND pengukuran_balita.status_stunting NOT LIKE "%severe%") THEN 1 ELSE 0 END) as stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as normal'
        );
        $this->db->from('puskesmas');
        $this->db->join('balita', 'balita.puskesmas_id = puskesmas.id', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_msq", 'left', false);
        $this->db->group_by('puskesmas.id, puskesmas.nama_puskesmas');
        $data['rekap_puskesmas'] = $this->db->get()->result_array();

        // 6 months trend
        $six_months_ago = date('Y-m-01', strtotime("-5 months"));
        $this->db->select('status_stunting, tgl_pengukuran, balita_id');
        $this->db->from('pengukuran_balita');
        $this->db->where("tgl_pengukuran >=", $six_months_ago);
        $this->db->order_by('tgl_pengukuran', 'DESC');
        $this->db->order_by('id', 'DESC');
        $all_measurements = $this->db->get()->result_array();

        $tren_6_bulan = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = date('n', strtotime("-$i months"));
            $y = date('Y', strtotime("-$i months"));
            $month_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $labels[] = $month_labels[$m - 1];
            
            $norm = 0; $stunt = 0; $sangat = 0;
            $processed_trend = [];
            foreach($all_measurements as $ms) {
                $ms_m = date('n', strtotime($ms['tgl_pengukuran']));
                $ms_y = date('Y', strtotime($ms['tgl_pengukuran']));
                if ($ms_m == $m && $ms_y == $y) {
                    if(in_array($ms['balita_id'], $processed_trend)) continue;
                    $processed_trend[] = $ms['balita_id'];
                    $stat = strtolower($ms['status_stunting']);
                    if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $sangat++; } 
                    elseif (strpos($stat, 'stunting') !== false) { $stunt++; } 
                    else { $norm++; }
                }
            }
            $total = $norm + $stunt + $sangat;
            $norm_pct = $total > 0 ? round(($norm / $total) * 100) : 0;
            $stunt_pct = $total > 0 ? round(($stunt / $total) * 100) : 0;
            $sangat_pct = $total > 0 ? round(($sangat / $total) * 100) : 0;
            if ($total > 0) $norm_pct = 100 - $stunt_pct - $sangat_pct;
            $tren_6_bulan[] = ['normal' => $norm_pct, 'stunting' => $stunt_pct, 'sangat_pendek' => $sangat_pct, 'total' => $total, 'norm_raw' => $norm, 'stunt_raw' => $stunt, 'sangat_raw' => $sangat];
        }
        $data['tren_6_bulan'] = $tren_6_bulan;
        $data['label_6_bulan'] = $labels;

        $this->db->select('pengukuran_balita.*, balita.nama_lengkap, puskesmas.nama_puskesmas');
        $this->db->from('pengukuran_balita');
        $this->db->join('balita', 'balita.id = pengukuran_balita.balita_id');
        $this->db->join('puskesmas', 'puskesmas.id = balita.puskesmas_id', 'left');
        $this->db->order_by('tgl_pengukuran', 'DESC'); $this->db->limit(5);
        $data['notifikasi'] = $this->db->get()->result_array();

		$this->load->view('admin_dashboard', $data);
	}

	public function puskesmas()
	{
		if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $pid = $this->session->userdata('puskesmas_id') ?: 0;
        $data['jml_balita'] = $this->db->where('puskesmas_id', $pid)->count_all_results('balita');
        $this->db->select('COUNT(DISTINCT id_kelurahan) as k'); $this->db->where('puskesmas_id', $pid);
        $rk = $this->db->get('balita')->row(); $data['jml_kelurahan'] = $rk ? $rk->k : 0;
        
        $current_month = date('m'); $current_year = date('Y');
        $this->db->select('COUNT(DISTINCT balita_id) as measured'); $this->db->from('pengukuran_balita');
        $this->db->join('balita', 'balita.id = pengukuran_balita.balita_id');
        $this->db->where('balita.puskesmas_id', $pid); $this->db->where('MONTH(tgl_pengukuran)', $current_month); $this->db->where('YEAR(tgl_pengukuran)', $current_year);
        $measured_res = $this->db->get()->row(); $data['sudah_diukur'] = $measured_res ? $measured_res->measured : 0;
        $data['belum_diukur'] = max(0, $data['jml_balita'] - $data['sudah_diukur']);
        
        $data['count_normal'] = 0; $data['count_stunting'] = 0; $data['count_sangat'] = 0;
        $this->db->select('pengukuran_balita.status_stunting, pengukuran_balita.balita_id'); $this->db->from('pengukuran_balita');
        $this->db->join('balita', 'balita.id = pengukuran_balita.balita_id');
        $this->db->where('balita.puskesmas_id', $pid); $this->db->where('MONTH(tgl_pengukuran)', $current_month); $this->db->where('YEAR(tgl_pengukuran)', $current_year);
        $this->db->order_by('tgl_pengukuran', 'DESC'); $statuses = $this->db->get()->result_array();
        
        $processed = [];
        foreach($statuses as $s) {
            if(in_array($s['balita_id'], $processed)) continue;
            $processed[] = $s['balita_id'];
            $stat = strtolower($s['status_stunting']);
            if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $data['count_sangat']++; } 
            elseif (strpos($stat, 'stunting') !== false) { $data['count_stunting']++; } 
            else { $data['count_normal']++; }
        }

        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$current_month - 1] . ' ' . $current_year;

        $this->db->select('pengukuran_balita.*, balita.nama_lengkap, balita.jenis_kelamin, balita.tgl_lahir, kelurahan.nama_kelurahan');
        $this->db->from('pengukuran_balita'); $this->db->join('balita', 'balita.id = pengukuran_balita.balita_id');
        $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->where('balita.puskesmas_id', $pid); $this->db->order_by('tgl_pengukuran', 'DESC'); $this->db->limit(5);
        $data['pengukuran_terbaru'] = $this->db->get()->result_array();

        // 6 months trend for specific puskesmas
        $six_months_ago = date('Y-m-01', strtotime("-5 months"));
        $this->db->select('pb.status_stunting, pb.tgl_pengukuran, pb.balita_id');
        $this->db->from('pengukuran_balita pb');
        $this->db->join('balita b', 'b.id = pb.balita_id');
        $this->db->where('b.puskesmas_id', $pid);
        $this->db->where("pb.tgl_pengukuran >=", $six_months_ago);
        $this->db->order_by('pb.tgl_pengukuran', 'DESC');
        $this->db->order_by('pb.id', 'DESC');
        $all_measurements = $this->db->get()->result_array();

        $tren_6_bulan = [];
        $labels = [];
        $month_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 5; $i >= 0; $i--) {
            $m = (int)date('m', strtotime("-$i months"));
            $y = (int)date('Y', strtotime("-$i months"));
            $labels[] = $month_labels[$m - 1];
            
            $norm = 0; $stunt = 0; $sangat = 0;
            $processed_trend = [];
            foreach($all_measurements as $ms) {
                $ms_m = (int)date('m', strtotime($ms['tgl_pengukuran']));
                $ms_y = (int)date('Y', strtotime($ms['tgl_pengukuran']));
                if ($ms_m == $m && $ms_y == $y) {
                    if(in_array($ms['balita_id'], $processed_trend)) continue;
                    $processed_trend[] = $ms['balita_id'];
                    $stat = strtolower($ms['status_stunting']);
                    if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $sangat++; } 
                    elseif (strpos($stat, 'stunting') !== false) { $stunt++; } 
                    else { $norm++; }
                }
            }
            $total = $norm + $stunt + $sangat;
            $norm_pct = $total > 0 ? round(($norm / $total) * 100) : 0;
            $stunt_pct = $total > 0 ? round(($stunt / $total) * 100) : 0;
            $sangat_pct = $total > 0 ? round(($sangat / $total) * 100) : 0;
            if ($total > 0) $norm_pct = 100 - $stunt_pct - $sangat_pct;
            $tren_6_bulan[] = ['normal' => $norm_pct, 'stunting' => $stunt_pct, 'sangat_pendek' => $sangat_pct, 'total' => $total, 'norm_raw' => $norm, 'stunt_raw' => $stunt, 'sangat_raw' => $sangat];
        }
        $data['tren_6_bulan'] = $tren_6_bulan;
        $data['label_6_bulan'] = $labels;

        $latest_sub = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$current_month' AND YEAR(pb2.tgl_pengukuran) = '$current_year')";
        $this->db->select('kelurahan.nama_kelurahan, COUNT(DISTINCT balita.id) as total_balita,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as sangat_pendek,
            SUM(CASE WHEN (pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" AND pengukuran_balita.status_stunting NOT LIKE "%severe%") THEN 1 ELSE 0 END) as stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as normal');
        $this->db->from('balita'); $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_sub", 'left', false);
        $this->db->where('balita.puskesmas_id', $pid); $this->db->group_by('balita.id_kelurahan, kelurahan.nama_kelurahan');
        $data['rekap_kelurahan'] = $this->db->get()->result_array();

		$this->load->view('admin_puskesmas_dashboard', $data);
	}

	public function peta_kelurahan()
	{
		if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $pid = $this->session->userdata('puskesmas_id') ?: 0;
        $m = date('m'); $y = date('Y');
        $latest_msq = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$m' AND YEAR(pb2.tgl_pengukuran) = '$y')";
        $this->db->select('kelurahan.id, kelurahan.nama_kelurahan, kelurahan.lat, kelurahan.lng, kecamatan.nama_kecamatan,
            COUNT(DISTINCT balita.id) as total_balita,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as sangat_pendek,
            SUM(CASE WHEN (pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" AND pengukuran_balita.status_stunting NOT LIKE "%severe%") THEN 1 ELSE 0 END) as stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as normal');
        $this->db->from('balita');
        $this->db->join('kelurahan',  'kelurahan.id = balita.id_kelurahan', 'left');
        $this->db->join('kecamatan',  'kecamatan.id = kelurahan.id_kecamatan', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_msq", 'left', false);
        if ($this->session->userdata('role') == 'admin_puskesmas') { $this->db->where('balita.puskesmas_id', $pid); }
        $this->db->group_by('balita.id_kelurahan, kelurahan.nama_kelurahan, kelurahan.lat, kelurahan.lng, kecamatan.nama_kecamatan, kelurahan.id');
        $data['kelurahan_data'] = $this->db->get()->result_array();
        $data['jml_balita'] = ($this->session->userdata('role') == 'admin_puskesmas') ? $this->db->where('puskesmas_id', $pid)->count_all_results('balita') : $this->db->count_all_results('balita');
        
        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$m - 1] . ' ' . $y;

        $this->load->view('admin_puskesmas_peta_kelurahan', $data);
	}

	public function peta_puskesmas()
	{
		if ($this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $m = date('m'); $y = date('Y');
        $latest_msq = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$m' AND YEAR(pb2.tgl_pengukuran) = '$y')";
        $this->db->select('puskesmas.id, puskesmas.nama_puskesmas, puskesmas.lat, puskesmas.lng, puskesmas.alamat,
            COUNT(DISTINCT balita.id) as total_balita,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as sangat_pendek,
            SUM(CASE WHEN (pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" AND pengukuran_balita.status_stunting NOT LIKE "%severe%") THEN 1 ELSE 0 END) as stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as normal');
        $this->db->from('puskesmas');
        $this->db->join('balita', 'balita.puskesmas_id = puskesmas.id', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_msq", 'left', false);
        $this->db->group_by('puskesmas.id, puskesmas.nama_puskesmas, puskesmas.lat, puskesmas.lng, puskesmas.alamat');
        $data['puskesmas_data'] = $this->db->get()->result_array();

        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$m - 1] . ' ' . $y;

        $this->load->view('admin_puskesmas_peta_puskesmas', $data);
	}

	public function grafik_kelurahan()
	{
		if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $pid = $this->session->userdata('puskesmas_id') ?: 0;
        $current_month = date('m'); $current_year = date('Y');
        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$current_month - 1] . ' ' . $current_year;

        $six_months_ago = date('Y-m-01', strtotime("-5 months"));
        $this->db->select('pb.status_stunting, pb.tgl_pengukuran, pb.balita_id, b.id_kelurahan, k.nama_kelurahan');
        $this->db->from('pengukuran_balita pb');
        $this->db->join('balita b', 'b.id = pb.balita_id');
        $this->db->join('kelurahan k', 'k.id = b.id_kelurahan', 'left');
        $this->db->where("pb.tgl_pengukuran >=", $six_months_ago);
        if ($this->session->userdata('role') == 'admin_puskesmas') { $this->db->where('b.puskesmas_id', $pid); }
        $this->db->order_by('pb.tgl_pengukuran', 'DESC');
        $all_measurements = $this->db->get()->result_array();

        $labels = []; $overall = ['normal' => [], 'stunting' => [], 'sangat_pendek' => [], 'total' => []];
        $kelurahans = []; if(!empty($all_measurements)) { foreach($all_measurements as $m) { if(!isset($kelurahans[$m['id_kelurahan']])) { $kelurahans[$m['id_kelurahan']] = $m['nama_kelurahan']; } } }

        $grafik_data = [];
        foreach($kelurahans as $kid => $knama) { $grafik_data[$kid] = ['nama' => $knama, 'normal' => [], 'stunting' => [], 'sangat_pendek' => [], 'total' => []]; }

        for ($i = 5; $i >= 0; $i--) {
            $m = date('n', strtotime("-$i months")); $y = date('Y', strtotime("-$i months"));
            $month_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $labels[] = $month_labels[$m - 1];
            
            $ov_norm = 0; $ov_stunt = 0; $ov_sangat = 0; $ov_processed = [];
            foreach($kelurahans as $kid => $knama) { $k_norm = 0; $k_stunt = 0; $k_sangat = 0; $k_processed = [];
                foreach($all_measurements as $ms) {
                    $ms_m = date('n', strtotime($ms['tgl_pengukuran'])); $ms_y = date('Y', strtotime($ms['tgl_pengukuran']));
                    if ($ms_m == $m && $ms_y == $y) {
                        if($ms['id_kelurahan'] == $kid) {
                            if(in_array($ms['balita_id'], $k_processed)) continue; $k_processed[] = $ms['balita_id'];
                            $stat = strtolower($ms['status_stunting']);
                            if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $k_sangat++; } 
                            elseif (strpos($stat, 'stunting') !== false) { $k_stunt++; } else { $k_norm++; }
                        }
                        if(!in_array($ms['balita_id'], $ov_processed)) {
                            $ov_processed[] = $ms['balita_id'];
                            $stat = strtolower($ms['status_stunting']);
                            if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $ov_sangat++; } 
                            elseif (strpos($stat, 'stunting') !== false) { $ov_stunt++; } else { $ov_norm++; }
                        }
                    }
                }
                $grafik_data[$kid]['normal'][] = $k_norm; $grafik_data[$kid]['stunting'][] = $k_stunt;
                $grafik_data[$kid]['sangat_pendek'][] = $k_sangat; $grafik_data[$kid]['total'][] = $k_norm + $k_stunt + $k_sangat;
            }
            $overall['normal'][] = $ov_norm; $overall['stunting'][] = $ov_stunt;
            $overall['sangat_pendek'][] = $ov_sangat; $overall['total'][] = $ov_norm + $ov_stunt + $ov_sangat;
        }
        $data['labels'] = $labels; $data['overall'] = $overall; $data['grafik'] = array_values($grafik_data);
        $this->load->view('admin_puskesmas_grafik_kelurahan', $data);
	}

    public function grafik_puskesmas()
    {
        if ($this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $current_month = date('m'); $current_year = date('Y');
        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$current_month - 1] . ' ' . $current_year;

        $six_months_ago = date('Y-m-01', strtotime("-5 months"));
        $this->db->select('pb.status_stunting, pb.tgl_pengukuran, pb.balita_id, b.puskesmas_id, p.nama_puskesmas');
        $this->db->from('pengukuran_balita pb');
        $this->db->join('balita b', 'b.id = pb.balita_id');
        $this->db->join('puskesmas p', 'p.id = b.puskesmas_id', 'left');
        $this->db->where("pb.tgl_pengukuran >=", $six_months_ago);
        $this->db->order_by('pb.tgl_pengukuran', 'DESC');
        $all_measurements = $this->db->get()->result_array();

        $puskesmas_list = $this->db->get('puskesmas')->result_array();
        $labels = []; $overall_trend = ['normal' => [], 'stunting' => [], 'sangat_pendek' => [], 'total' => []];
        $puskesmas_data = [];
        foreach($puskesmas_list as $pk) { 
            $puskesmas_data[$pk['id']] = ['id' => $pk['id'], 'nama_puskesmas' => $pk['nama_puskesmas'], 'normal' => 0, 'stunting' => 0, 'sangat_pendek' => 0, 'total' => 0]; 
        }

        for ($i = 5; $i >= 0; $i--) {
            $m = date('n', strtotime("-$i months")); $y = date('Y', strtotime("-$i months"));
            $month_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $labels[] = $month_labels[$m - 1];
            $ov_norm = 0; $ov_stunt = 0; $ov_sangat = 0; $ov_processed = [];
            foreach($all_measurements as $ms) {
                $ms_m = date('n', strtotime($ms['tgl_pengukuran'])); $ms_y = date('Y', strtotime($ms['tgl_pengukuran']));
                if ($ms_m == $m && $ms_y == $y) {
                    if(!in_array($ms['balita_id'], $ov_processed)) {
                        $ov_processed[] = $ms['balita_id'];
                        $stat = strtolower($ms['status_stunting']);
                        if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $ov_sangat++; } 
                        elseif (strpos($stat, 'stunting') !== false) { $ov_stunt++; } else { $ov_norm++; }
                        if($i == 0 && isset($puskesmas_data[$ms['puskesmas_id']])) {
                            $puskesmas_data[$ms['puskesmas_id']]['total']++;
                            if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false) { $puskesmas_data[$ms['puskesmas_id']]['sangat_pendek']++; } 
                            elseif (strpos($stat, 'stunting') !== false) { $puskesmas_data[$ms['puskesmas_id']]['stunting']++; } else { $puskesmas_data[$ms['puskesmas_id']]['normal']++; }
                        }
                    }
                }
            }
            $overall_trend['normal'][] = $ov_norm; $overall_trend['stunting'][] = $ov_stunt;
            $overall_trend['sangat_pendek'][] = $ov_sangat; $overall_trend['total'][] = $ov_norm + $ov_stunt + $ov_sangat;
        }
        $data['labels'] = $labels; $data['overall_trend'] = $overall_trend; $data['puskesmas_data'] = array_values($puskesmas_data);
        $this->load->view('admin_puskesmas_grafik_puskesmas', $data);
    }

	public function laporan_kelurahan()
	{
		if ($this->session->userdata('role') != 'admin_puskesmas' && $this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $pid = $this->session->userdata('puskesmas_id') ?: 0;
        $m = $this->input->get('bulan') ?: date('m'); $y = $this->input->get('tahun') ?: date('Y');
        $id_kel = $this->input->get('id_kelurahan') ?: 'all';
        $data['sel_m'] = $m; $data['sel_y'] = $y; $data['sel_kel'] = $id_kel;
        $data['sel_jenis'] = $this->input->get('jenis') ?: 'rekap';
        $bulan_arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $data['bulan_ini'] = $bulan_arr[(int)$m - 1] . ' ' . $y; $data['bulan'] = $bulan_arr;

        // Get Kelurahan list for dropdown (filtered by puskesmas if admin_puskesmas)
        if ($this->session->userdata('role') == 'admin_puskesmas') {
            $this->db->select('DISTINCT(balita.id_kelurahan) as id, kelurahan.nama_kelurahan');
            $this->db->from('balita');
            $this->db->join('kelurahan', 'kelurahan.id = balita.id_kelurahan', 'left');
            $this->db->where('balita.puskesmas_id', $pid);
            $this->db->where('balita.id_kelurahan IS NOT NULL');
            $this->db->order_by('kelurahan.nama_kelurahan', 'ASC');
            $data['kelurahan_list_dropdown'] = $this->db->get()->result_array();
        } else {
            // For superadmin, show all kelurahans
            $this->db->select('id, nama_kelurahan');
            $this->db->order_by('nama_kelurahan', 'ASC');
            $data['kelurahan_list_dropdown'] = $this->db->get('kelurahan')->result_array();
        }

        $latest_msq = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$m' AND YEAR(pb2.tgl_pengukuran) = '$y')";
        $this->db->select('kelurahan.id, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan, COUNT(DISTINCT balita.id) as total_terdaftar, SUM(CASE WHEN pengukuran_balita.id IS NOT NULL THEN 1 ELSE 0 END) as total_diukur,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as jml_normal,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" THEN 1 ELSE 0 END) as jml_stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as jml_sangat');
        $this->db->from('kelurahan'); $this->db->join('kecamatan', 'kecamatan.id = kelurahan.id_kecamatan', 'left');
        $this->db->join('balita', 'balita.id_kelurahan = kelurahan.id', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_msq", 'left', false);
        if ($this->session->userdata('role') == 'admin_puskesmas') { $this->db->where('balita.puskesmas_id', $pid); }
        if ($id_kel != 'all') { $this->db->where('kelurahan.id', $id_kel); }
        $this->db->group_by('kelurahan.id, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan');
        $laporan_rekap = $this->db->get()->result_array();

        $data['laporan'] = array_map(function($r){
            $r['prevalensi'] = $r['total_diukur'] > 0 ? round((($r['jml_stunting'] + $r['jml_sangat']) / $r['total_diukur']) * 100, 1) : 0;
            $r['status'] = $r['prevalensi'] >= 20 ? 'Tinggi' : ($r['prevalensi'] >= 10 ? 'Sedang' : 'Aman');
            return $r;
        }, $laporan_rekap);

        $data['total_terdaftar'] = array_sum(array_column($laporan_rekap, 'total_terdaftar')); 
        $data['total_diukur'] = array_sum(array_column($laporan_rekap, 'total_diukur'));
        $data['total_normal'] = array_sum(array_column($laporan_rekap, 'jml_normal'));
        $data['total_stunting'] = array_sum(array_column($laporan_rekap, 'jml_stunting')); 
        $data['total_sangat'] = array_sum(array_column($laporan_rekap, 'jml_sangat'));
        $data['total_stunted'] = $data['total_stunting'] + $data['total_sangat'];
        $data['prev_all'] = $data['total_diukur'] > 0 ? round(($data['total_stunted'] / $data['total_diukur']) * 100, 1) : 0;
        $data['cakupan'] = $data['total_terdaftar'] > 0 ? round(($data['total_diukur'] / $data['total_terdaftar']) * 100, 1) : 0;
        $data['prev_color_all'] = $data['prev_all'] >= 20 ? 'var(--danger)' : ($data['prev_all'] >= 10 ? 'var(--warning)' : 'var(--success)');

        $this->db->select('pb.*, b.nama_lengkap, b.jenis_kelamin, b.tgl_lahir, k.nama_kelurahan'); $this->db->from('pengukuran_balita pb');
        $this->db->join('balita b', 'b.id = pb.balita_id'); $this->db->join('kelurahan k', 'k.id = b.id_kelurahan', 'left');
        $this->db->where('MONTH(pb.tgl_pengukuran)', $m); $this->db->where('YEAR(pb.tgl_pengukuran)', $y);
        if ($this->session->userdata('role') == 'admin_puskesmas') { $this->db->where('b.puskesmas_id', $pid); }
        if ($id_kel != 'all') { $this->db->where('b.id_kelurahan', $id_kel); }
        $data['laporan_detail'] = $this->db->get()->result_array();

        $this->load->view('admin_puskesmas_laporan_kelurahan', $data);
	}

    public function laporan_puskesmas()
    {
        if ($this->session->userdata('role') != 'superadmin') { redirect('auth'); }
        $m = $this->input->get('bulan') ?: date('m'); $y = $this->input->get('tahun') ?: date('Y'); $ps = $this->input->get('puskesmas') ?: 'all';
        $data['sel_m'] = $m; $data['sel_y'] = $y; $data['sel_p'] = $ps; $data['sel_jenis'] = $this->input->get('jenis') ?: 'rekap';
        $bulan_arr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['bulan_str'] = $bulan_arr[(int)$m - 1] . ' ' . $y; $data['bulan'] = $bulan_arr;
        $data['puskesmas_list'] = $this->db->get('puskesmas')->result_array();

        $latest_msq = "(SELECT MAX(id) FROM pengukuran_balita pb2 WHERE pb2.balita_id = balita.id AND MONTH(pb2.tgl_pengukuran) = '$m' AND YEAR(pb2.tgl_pengukuran) = '$y')";
        $this->db->select('p.id, p.nama_puskesmas, COUNT(DISTINCT balita.id) as total_terdaftar, SUM(CASE WHEN pengukuran_balita.id IS NOT NULL THEN 1 ELSE 0 END) as total_diukur,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%normal%" THEN 1 ELSE 0 END) as jml_normal,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%stunting%" AND pengukuran_balita.status_stunting NOT LIKE "%sangat%" THEN 1 ELSE 0 END) as jml_stunting,
            SUM(CASE WHEN pengukuran_balita.status_stunting LIKE "%sangat%" OR pengukuran_balita.status_stunting LIKE "%severe%" THEN 1 ELSE 0 END) as jml_sangat');
        $this->db->from('puskesmas p'); $this->db->join('balita', 'balita.puskesmas_id = p.id', 'left');
        $this->db->join('pengukuran_balita', "pengukuran_balita.id = $latest_msq", 'left', false);
        if($ps != 'all') { $this->db->where('p.id', $ps); } $this->db->group_by('p.id, p.nama_puskesmas');
        $laporan_raw = $this->db->get()->result_array();

        $data['laporan'] = array_map(function($r){
            $r['prevalensi'] = $r['total_diukur'] > 0 ? round((($r['jml_stunting'] + $r['jml_sangat']) / $r['total_diukur']) * 100, 1) : 0;
            $r['status'] = $r['prevalensi'] >= 20 ? 'Tinggi' : ($r['prevalensi'] >= 10 ? 'Sedang' : 'Rendah'); return $r;
        }, $laporan_raw);

        $data['total_diukur'] = array_sum(array_column($laporan_raw, 'total_diukur')); 
        $data['total_stunted'] = array_sum(array_column($laporan_raw, 'jml_stunting')) + array_sum(array_column($laporan_raw, 'jml_sangat'));
        $data['total_sangat'] = array_sum(array_column($laporan_raw, 'jml_sangat'));
        $data['prev_all'] = $data['total_diukur'] > 0 ? round(($data['total_stunted'] / $data['total_diukur']) * 100, 1) : 0;

        $this->db->select('pb.*, b.nama_lengkap, b.jenis_kelamin, b.tgl_lahir, p.nama_puskesmas'); $this->db->from('pengukuran_balita pb');
        $this->db->join('balita b', 'b.id = pb.balita_id'); $this->db->join('puskesmas p', 'p.id = b.puskesmas_id', 'left');
        $this->db->where('MONTH(pb.tgl_pengukuran)', $m); $this->db->where('YEAR(pb.tgl_pengukuran)', $y);
        if($ps != 'all') { $this->db->where('b.puskesmas_id', $ps); }
        $data['laporan_detail'] = $this->db->get()->result_array();

        $this->load->view('admin_puskesmas_laporan_puskesmas', $data);
    }
}
