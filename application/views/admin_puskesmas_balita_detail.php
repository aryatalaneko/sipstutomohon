<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Balita - SIPSTU</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		:root {
			--blue-950: #0a1628;
			--blue-900: #0f2044;
			--blue-800: #163060;
			--blue-700: #1e4080;
			--blue-600: #2563a8;
			--blue-500: #3b82d4;
			--blue-400: #60a5f0;
			--blue-300: #93c5fd;
			--blue-100: #dbeafe;
			--blue-50: #eff6ff;
			--success: #10b981;
			--warning: #f59e0b;
			--danger: #ef4444;
			--text-primary: #0f172a;
			--text-secondary: #475569;
			--text-muted: #94a3b8;
			--border: #e2e8f0;
			--surface: #f8fafc;
			--white: #ffffff;
		}

		body {
			font-family: 'DM Sans', sans-serif;
			background: var(--surface);
			color: var(--text-primary);
			height: 100vh;
			overflow: hidden;
		}

		.layout {
			display: flex;
			height: 100vh;
			width: 100vw;
			overflow: hidden;
		}

		/* SIDEBAR */
		.sidebar {
			width: 240px;
			background: var(--blue-950);
			display: flex;
			flex-direction: column;
			flex-shrink: 0;
			position: relative;
			overflow: hidden;
		}

		.sidebar-logo {
			padding: 24px 20px 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.07);
		}

		.logo-badge {
			display: inline-flex;
			align-items: center;
			gap: 10px;
		}

		.logo-icon {
			width: 34px;
			height: 34px;
			background: var(--blue-500);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-weight: 700;
			font-size: 13px;
			color: white;
		}

		.logo-text {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-weight: 700;
			font-size: 15px;
			color: white;
			line-height: 1.2;
		}

		.logo-sub {
			font-size: 10px;
			color: rgba(255, 255, 255, 0.4);
		}

		.puskesmas-pill {
			margin: 12px 20px;
			background: rgba(59, 130, 212, 0.15);
			border: 1px solid rgba(59, 130, 212, 0.3);
			border-radius: 8px;
			padding: 10px 12px;
		}

		.puskesmas-pill-label {
			font-size: 10px;
			color: rgba(255, 255, 255, 0.35);
			text-transform: uppercase;
			letter-spacing: 0.8px;
			font-weight: 600;
		}

		.puskesmas-pill-name {
			font-size: 13px;
			color: white;
			font-weight: 600;
			margin-top: 2px;
		}

		.puskesmas-pill-sub {
			font-size: 10px;
			color: rgba(255, 255, 255, 0.4);
			margin-top: 1px;
		}

		.sidebar-section {
			padding: 16px 12px 4px;
		}

		.sidebar-label {
			font-size: 10px;
			font-weight: 600;
			color: rgba(255, 255, 255, 0.3);
			letter-spacing: 1px;
			text-transform: uppercase;
			padding: 0 8px 8px;
		}

		.nav-item {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 9px 10px;
			border-radius: 8px;
			font-size: 13px;
			color: rgba(255, 255, 255, 0.55);
			cursor: pointer;
			transition: all 0.15s;
			margin-bottom: 2px;
			font-weight: 500;
			text-decoration: none;
		}

		.nav-item:hover {
			background: rgba(255, 255, 255, 0.07);
			color: rgba(255, 255, 255, 0.9);
			text-decoration: none;
		}

		.nav-item.active {
			background: var(--blue-700);
			color: white;
		}

		.nav-item .icon {
			width: 16px;
			height: 16px;
			flex-shrink: 0;
		}

		.sidebar-footer {
			margin-top: auto;
			padding: 16px 12px;
			border-top: 1px solid rgba(255, 255, 255, 0.07);
		}

		.user-card {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 8px;
			border-radius: 8px;
			cursor: pointer;
		}

		.user-card:hover {
			background: rgba(255, 255, 255, 0.06);
		}

		.avatar {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			background: var(--blue-600);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			font-weight: 700;
			color: white;
			flex-shrink: 0;
		}

		.user-name {
			font-size: 12px;
			font-weight: 600;
			color: rgba(255, 255, 255, 0.85);
		}

		.user-role {
			font-size: 10px;
			color: rgba(255, 255, 255, 0.35);
		}

    /* MAIN */
    .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; background: #fafafa; }
    .content { flex: 1; padding: 24px 28px; overflow-y: auto; }
    
    /* TOPBAR & HEADER */
    .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 28px; height: 60px; display: flex; justify-content: flex-start;  align-items: center; gap:12px; flex-shrink:0; }
    .topbar-back { width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-secondary); transition: all 0.2s; text-decoration: none; }
    .topbar-back:hover { background: var(--surface); color: var(--text-primary); border-color: var(--text-muted); }
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; margin-bottom: 0; }
    .breadcrumb-link { color: var(--text-muted); cursor: pointer; text-decoration: none;}
    .breadcrumb-link:hover { color: var(--blue-600); }
    .breadcrumb-sep { color: var(--border); font-size: 14px; }
    .breadcrumb-current { color: var(--text-primary); font-weight: 600; }
    
    .btn-primary-custom { background: var(--blue-600); color: white; border: none; border-radius: 8px; padding: 10px 18px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; text-decoration: none;}
    .btn-primary-custom:hover { background: var(--blue-700); color: white; transform: translateY(-1px); }

		/* CARD & TABLE */
		.card-custom {
			background: white;
			border-radius: 12px;
			border: 1px solid var(--border);
			overflow: hidden;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
		}

		.table-custom {
			width: 100%;
			margin-bottom: 0;
			border-collapse: collapse;
		}

		.table-custom th {
			font-size: 11px;
			font-weight: 600;
			color: var(--text-muted);
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 12px 20px;
			background: var(--surface);
			border-bottom: 1px solid var(--border);
			text-align: left;
		}

		.table-custom td {
			padding: 14px 20px;
			font-size: 13px;
			color: var(--text-secondary);
			border-bottom: 1px solid var(--border);
			vertical-align: middle;
		}

		.table-custom tr:last-child td {
			border-bottom: none;
		}

		.table-custom tr:hover td {
			background: var(--surface);
		}

		.item-title {
			font-weight: 700;
			color: var(--text-primary);
			font-size: 14px;
			margin-bottom: 2px;
			font-family: 'Plus Jakarta Sans', sans-serif;
		}
	</style>
</head>

<body>

<div class="layout">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-badge">
        <div class="logo-icon">ST</div>
        <div>
          <div class="logo-text">SIPSTU</div>
          <div class="logo-sub">Kota Tomohon</div>
        </div>
      </div>
    </div>

    <div class="puskesmas-pill">
      <div class="puskesmas-pill-label">Puskesmas Aktif</div>
      <div class="puskesmas-pill-name">
        <?= $this->session->userdata('nama_puskesmas') ? htmlspecialchars($this->session->userdata('nama_puskesmas')) : 'Admin Puskesmas' ?>
      </div>
      <?php
      $ci =& get_instance();
      $pid = $ci->session->userdata('puskesmas_id') ?: 0;
      $jml_balita = $ci->db->where('puskesmas_id', $pid)->count_all_results('balita');

      $ci->db->select('COUNT(DISTINCT id_kelurahan) as k_count');
      $ci->db->where('puskesmas_id', $pid);
      $res = $ci->db->get('balita')->row();
      $jml_kelurahan = $res ? $res->k_count : 0;
      ?>
      <div class="puskesmas-pill-sub"><?= $jml_kelurahan ?> kelurahan · <?= $jml_balita ?> balita</div>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Utama</div>
      <a href="<?= base_url('welcome/puskesmas') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="1.8" />
          <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="1.8" />
          <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="1.8" />
          <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="1.8" />
        </svg>
        Dashboard
      </a>
<a href="<?= base_url('balita_admin/index') ?>" class="nav-item active">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Data Balita
      </a>
      <a href="<?= base_url('klasifikasi/index') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Hasil Klasifikasi
      </a>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Wilayah</div>
      <a href="<?= base_url('welcome/peta_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
          <circle cx="12" cy="9" r="2.5" stroke-width="1.8" />
        </svg>
        Peta Kelurahan
      </a>
      <a href="<?= base_url('welcome/grafik_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8"
            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        Grafik Kelurahan
      </a>
      <a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Laporan Kelurahan
      </a>
    </div>



      <div class="sidebar-footer">
      <div class="user-card">
        <div class="avatar">MT</div>
        <div>
          <div class="user-name"><?= $this->session->userdata('nama_puskesmas') ? htmlspecialchars($this->session->userdata('nama_puskesmas')) : 'Admin Puskesmas' ?></div>
          <div class="user-role">Faskes Tingkat 1</div>
        </div>
      </div>
      <a href="<?= base_url('auth/logout') ?>" class="nav-item text-danger mt-2"
        style="background: rgba(239, 68, 68, 0.1);">
        <svg class="icon text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.8"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        Keluar
      </a>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <a href="<?= base_url('balita_admin/index') ?>" class="topbar-back">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </a>
      <div class="breadcrumb">
        <a href="<?= base_url('balita_admin/index') ?>" class="breadcrumb-link">Data Balita</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Rekam Jejak</span>
      </div>
    </div>

    <div class="content">

      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="font-size: 13px; border-radius: 10px;">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
        </div>
      <?php endif; ?>

      <?php $b = $balita; ?>

      <!-- HEADER CARD -->
      <div class="card-custom mb-4" style="background:var(--blue-950); color:white; border:none; box-shadow: 0 10px 25px rgba(10,22,40,0.15);">
          <div style="padding: 28px; display:flex; justify-content:space-between; align-items:center;">
              <div>
                  <h3 style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; margin-bottom:12px; font-size:24px; letter-spacing:-0.5px;"><?= htmlspecialchars($b['nama_lengkap']) ?></h3>
                  <div style="display:flex; gap:20px; font-size:13px; color:rgba(255,255,255,0.7); font-weight:500;">
                      <span style="display:flex; align-items:center; gap:6px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Lahir: <?= date('d M Y', strtotime($b['tgl_lahir'])) ?></span>
                      <?php 
                        $bday = new DateTime($b['tgl_lahir']);
                        $today = new DateTime();
                        $diff = $bday->diff($today);
                        $age_str = ($diff->y > 0 ? $diff->y . ' Thn ' : '') . $diff->m . ' Bln';
                      ?>
                      <span style="display:flex; align-items:center; gap:6px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Umur: <?= $age_str ?></span>
                      <span style="display:flex; align-items:center; gap:6px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Kel. <?= htmlspecialchars($b['nama_kelurahan']) ?></span>
                  </div>
              </div>
              <div>
                  <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahPengukuran" style="background:var(--blue-500); color:white; padding: 12px 24px; box-shadow: 0 8px 16px rgba(59,130,212,0.3);">
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                      Tambah Pengukuran Baru
                  </button>
              </div>
          </div>
      </div>

      <!-- TITLE ROW -->
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
        <div style="width:32px; height:32px; background:var(--blue-50); color:var(--blue-600); border-radius:8px; display:flex; align-items:center; justify-content:center;">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012-2h-2a2 2 0 01-2-2z"/></svg>
        </div>
        <h4 style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; margin:0; font-size:16px;">Riwayat Pengukuran Bulanan</h4>
      </div>

      <!-- TABLE -->
      <div class="card-custom">
        <div class="table-responsive flex-grow-1">
          <table class="table-custom">
            <thead>
              <tr>
                <th width="15%">Tgl Pengecekan</th>
                <th width="10%">Berat (kg)</th>
                <th width="10%">Tinggi (cm)</th>
                <th width="15%">Z-Score TB/U</th>
                <th width="15%">Z-Score BB/U</th>
                <th width="15%">Z-Score BB/TB</th>
                <th width="20%">Status (Naive Bayes)</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($pengukuran)): ?>
              <tr><td colspan="7" class="text-center py-5 text-muted" style="font-size:13px;">Belum ada rekam jejak pengukuran untuk balita ini.</td></tr>
              <?php else: ?>
                  <?php foreach($pengukuran as $p): ?>
                  <tr>
                      <td><div style="font-weight:600; color:var(--text-primary);"><?= date('d F Y', strtotime($p['tgl_pengukuran'])) ?></div></td>
                      <td><div class="item-title"><?= $p['berat_badan'] ?></div></td>
                      <td><div class="item-title"><?= $p['tinggi_badan'] ?></div></td>
                      <td>
                          <span style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:<?= $p['zscore_tbu'] < -2 ? 'var(--danger)' : 'var(--blue-600)' ?>;">
                              <?= $p['zscore_tbu'] >= 0 ? '+'.$p['zscore_tbu'] : $p['zscore_tbu'] ?>
                          </span>
                      </td>
                      <td>
                          <span style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:<?= $p['zscore_bbu'] < -2 ? 'var(--danger)' : 'var(--success)' ?>;">
                              <?= $p['zscore_bbu'] > 0 ? '+'.$p['zscore_bbu'] : $p['zscore_bbu'] ?>
                          </span>
                      </td>
                      <td>
                          <span style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:<?= $p['zscore_bbtb'] < -2 ? 'var(--danger)' : 'var(--success)' ?>;">
                              <?= $p['zscore_bbtb'] > 0 ? '+'.$p['zscore_bbtb'] : $p['zscore_bbtb'] ?>
                          </span>
                      </td>
                      <td>
                          <?php
                              $s = strtolower($p['status_stunting']);
                              $color = 'var(--success)'; $bg = '#ecfdf5';
                              if(strpos($s, 'stunting') !== false && strpos($s, 'sangat') === false) { $color = '#b45309'; $bg = '#fffbeb'; }
                              else if(strpos($s, 'sangat') !== false || strpos($s, 'severe') !== false) { $color = '#b91c1c'; $bg = '#fef2f2'; }
                          ?>
                          <span style="background:<?= $bg ?>; color:<?= $color ?>; padding:6px 12px; border-radius:8px; font-weight:600; font-size:11px;">
                              <?= htmlspecialchars($p['status_stunting']) ?>
                          </span>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- MODAL TAMBAH PENGUKURAN -->
<div class="modal fade" id="modalTambahPengukuran" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 14px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
      <div class="modal-header" style="border-bottom: 1px solid var(--border); padding: 20px 24px;">
        <h5 class="modal-title" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px;">Catat Pengukuran Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?= base_url('balita_admin/tambah_pengukuran_bulanan') ?>" method="POST">
        <input type="hidden" name="balita_id" value="<?= $b['id'] ?>">
        
        <!-- Hidden Z-scores / Status -->
        <input type="hidden" name="zscore_tbu" id="m-inp-ztbu" value="0">
        <input type="hidden" name="zscore_bbu" id="m-inp-zbbu" value="0">
        <input type="hidden" name="zscore_bbtb" id="m-inp-zbbtb" value="0">
        <input type="hidden" name="status_stunting" id="m-inp-status" value="Normal">

        <div class="modal-body" style="padding: 24px;">
            <div style="margin-bottom:16px;">
                <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Tanggal Pengukuran <span class="text-danger">*</span></label>
                <input type="date" name="tgl_pengukuran" class="form-control" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div style="display:flex; gap:16px; margin-bottom:20px;">
                <div style="flex:1;">
                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="berat_badan" id="m-inp-bb" class="form-control" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" placeholder="0.0" oninput="hitungModalZ()" required>
                </div>
                <div style="flex:1;">
                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="tinggi_badan" id="m-inp-tb" class="form-control" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" placeholder="0.0" oninput="hitungModalZ()" required>
                </div>
            </div>

            <!-- Preview Box -->
            <div style="background:var(--surface); border:1px dashed var(--border); border-radius:10px; padding:16px;">
                <div style="font-size:11px; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">Pratinjau Sistem</div>
                <div style="display:flex; justify-content:space-between; align-items:flex-end;">
                    <div>
                        <div style="font-size:11px; color:var(--text-secondary); margin-bottom:2px;">Z-Score (TB/U)</div>
                        <div id="m-zscore-display" style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; font-size:16px; color:var(--text-primary);">-</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:11px; color:var(--text-secondary); margin-bottom:4px;">Klasifikasi (Naive Bayes)</div>
                        <div id="m-status-badge" style="background:#e2e8f0; color:#475569; padding:4px 10px; border-radius:6px; font-weight:700; font-size:12px; display:inline-block;">Belum diukur</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer" style="border-top: 1px solid var(--border); padding: 16px 24px; background: #fafafa; border-radius: 0 0 14px 14px;">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="font-size:13px; font-weight:600;">Batal</button>
          <button type="submit" class="btn-primary-custom" style="background:var(--blue-600); color:white; border:none; border-radius:8px; padding:10px 18px; font-size:13px; font-weight:600;">Simpan Pengukuran</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/who_zscore.js') ?>"></script>
<script>
function hitungModalZ() {
  const bb = parseFloat(document.getElementById('m-inp-bb').value) || 0;
  const tb = parseFloat(document.getElementById('m-inp-tb').value) || 0;
  if (!bb || !tb) return;

  // Ambil data balita dari PHP (tgl_lahir dan jenis_kelamin)
  const tglLahir = '<?= htmlspecialchars($balita['tgl_lahir']) ?>';
  const jenisKelamin = '<?= htmlspecialchars($balita['jenis_kelamin']) ?>';
  const usiaBulan = whoHitungUsiaBulan(tglLahir);

  // Hitung z-score menggunakan tabel LMS WHO 2006
  const hasil = whoHitungSemua(bb, tb, usiaBulan, jenisKelamin);
  const { tbu, bbu, bbtb, status, statusString } = hasil;

  let bg, color;
  if (status === 'normal') { bg = '#ecfdf5'; color = '#047857'; }
  else if (status === 'stunting') { bg = '#fffbeb'; color = '#b45309'; }
  else { bg = '#fef2f2'; color = '#b91c1c'; }

  document.getElementById('m-inp-ztbu').value = tbu !== null ? tbu : 0;
  document.getElementById('m-inp-zbbu').value = bbu !== null ? bbu : 0;
  document.getElementById('m-inp-zbbtb').value = bbtb !== null ? bbtb : 0;
  document.getElementById('m-inp-status').value = statusString;

  const displayTbu = tbu !== null ? tbu : '-';
  document.getElementById('m-zscore-display').textContent = (tbu !== null && tbu >= 0 ? '+' : '') + displayTbu + ' SD';
  document.getElementById('m-zscore-display').style.color = color;

  document.getElementById('m-status-badge').textContent = statusString;
  document.getElementById('m-status-badge').style.background = bg;
  document.getElementById('m-status-badge').style.color = color;
}
</script>
<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>

</html>
