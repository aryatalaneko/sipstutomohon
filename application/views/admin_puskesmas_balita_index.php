<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Balita - SIPSTU</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap');
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --blue-950: #0a1628; --blue-900: #0f2044; --blue-800: #163060;
      --blue-700: #1e4080; --blue-600: #2563a8; --blue-500: #3b82d4;
      --blue-400: #60a5f0; --blue-300: #93c5fd; --blue-100: #dbeafe; --blue-50: #eff6ff;
      --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
      --text-primary: #0f172a; --text-secondary: #475569; --text-muted: #94a3b8;
      --border: #e2e8f0; --surface: #f8fafc; --white: #ffffff;
    }
    body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text-primary); height: 100vh; overflow: hidden; }
    .layout { display: flex; height: 100vh; width: 100vw; overflow: hidden; }

    /* SIDEBAR */
    .sidebar { width: 240px; background: var(--blue-950); display: flex; flex-direction: column; flex-shrink: 0; position: relative; overflow: hidden; }
    .sidebar-logo { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); }
    .logo-badge { display: inline-flex; align-items: center; gap: 10px; }
    .logo-icon { width: 34px; height: 34px; background: var(--blue-500); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: white; }
    .logo-text { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 15px; color: white; line-height: 1.2; }
    .logo-sub { font-size: 10px; color: rgba(255,255,255,0.4); }
    .puskesmas-pill { margin: 12px 20px; background: rgba(59,130,212,0.15); border: 1px solid rgba(59,130,212,0.3); border-radius: 8px; padding: 10px 12px; }
    .puskesmas-pill-label { font-size: 10px; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; }
    .puskesmas-pill-name { font-size: 13px; color: white; font-weight: 600; margin-top: 2px; }
    .puskesmas-pill-sub { font-size: 10px; color: rgba(255,255,255,0.4); margin-top: 1px; }
    .sidebar-section { padding: 16px 12px 4px; }
    .sidebar-label { font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.3); letter-spacing: 1px; text-transform: uppercase; padding: 0 8px 8px; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; font-size: 13px; color: rgba(255,255,255,0.55); cursor: pointer; transition: all 0.15s; margin-bottom: 2px; font-weight: 500; text-decoration: none; }
    .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.9); text-decoration: none; }
    .nav-item.active { background: var(--blue-700); color: white; }
    .nav-item .icon { width: 16px; height: 16px; flex-shrink: 0; }
    .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
    .user-card { display: flex; align-items: center; gap: 10px; padding: 8px; border-radius: 8px; cursor: pointer; }
    .user-card:hover { background: rgba(255,255,255,0.06); }
    .avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--blue-600); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: white; flex-shrink: 0; }
    .user-name { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.85); }
    .user-role { font-size: 10px; color: rgba(255,255,255,0.35); }

    /* MAIN */
    .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; background: #fafafa; }
    .content { flex: 1; padding: 24px 28px; overflow-y: auto; }
    
    /* TOPBAR & HEADER */
    .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 28px; height: 60px; display: flex; align-items: center; justify-content: space-between; }
    .topbar-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: var(--text-primary); }
    
    .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; }
    .page-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 20px; color: var(--text-primary); margin-bottom: 4px; }
    .page-sub { font-size: 13px; color: var(--text-secondary); }

    .btn-primary-custom { background: var(--blue-600); color: white; border: none; border-radius: 8px; padding: 10px 18px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; text-decoration: none;}
    .btn-primary-custom:hover { background: var(--blue-700); color: white; transform: translateY(-1px); }

    /* CARD & TABLE */
    .card-custom { background: white; border-radius: 12px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-custom { width: 100%; margin-bottom: 0; border-collapse: collapse; }
    .table-custom th { font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 20px; background: var(--surface); border-bottom: 1px solid var(--border); text-align: left; }
    .table-custom td { padding: 14px 20px; font-size: 13px; color: var(--text-secondary); border-bottom: 1px solid var(--border); vertical-align: middle; }
    .table-custom tr:last-child td { border-bottom: none; }
    .table-custom tr:hover td { background: var(--surface); }
    .item-title { font-weight: 600; color: var(--text-primary); font-size: 13px; margin-bottom: 2px; }
    .item-sub { font-size: 11px; color: var(--text-muted); }

    .badge-jk { padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 600; }
    .badge-jk.L { background: var(--blue-50); color: var(--blue-600); border: 1px solid var(--blue-100); }
    .badge-jk.P { background: #fdf2f8; color: #ec4899; border: 1px solid #fbcfe8; }
    
    .action-btn { width: 30px; height: 30px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid transparent; transition: all 0.2s; cursor: pointer; background: transparent;}
    .action-btn.view { color: var(--success); }
    .action-btn.view:hover { background: #ecfdf5; border-color: #a7f3d0; }
    .action-btn.edit { color: var(--blue-600); }
    .action-btn.edit:hover { background: var(--blue-50); border-color: var(--blue-200); }
  /* FOOTER */
.footer {
  background: linear-gradient(135deg, var(--blue-950), var(--blue-900));
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding: 14px 24px;
  text-align: center;
  font-size: 12px;
  color: rgba(255, 255, 255, 0.75);
  font-weight: 500;
  letter-spacing: 0.4px;
  flex-shrink: 0;
}

.footer span {
  color: var(--blue-300);
  font-weight: 700;
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
      <div class="topbar-title">Data Pokok Balita</div>
    </div>

    <div class="content">
      
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="font-size: 13px; border-radius: 10px;">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
        </div>
      <?php endif; ?>

      <!-- PAGE HEADER -->
      <div class="page-header">
        <div>
          <h2 class="page-title">Daftar Balita</h2>
          <p class="page-sub">Kelola identitas dasar dan rekam pengukuran setiap balita di puskesmas Anda.</p>
        </div>
        <div>
          <a href="<?= base_url('balita_admin/tambah') ?>" class="btn-primary-custom" style="white-space: nowrap;">
            + Tambah Balita
          </a>
        </div>
      </div>

      <!-- FILTER BAR -->
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;">
        <form action="<?= base_url('balita_admin/index') ?>" method="GET" class="d-flex align-items-center gap-2" style="flex: 1; min-width: 0; flex-wrap: wrap; gap: 10px !important;">
          <div style="position: relative; flex: 1; min-width: 200px; max-width: 320px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%);">
              <path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="nama" value="<?= htmlspecialchars($filter_nama ?? '') ?>" 
                   placeholder="Cari nama balita..." 
                   style="width: 100%; border-radius: 8px; border: 1px solid var(--border); padding: 9px 14px 9px 36px; font-size: 13px; font-family: 'DM Sans', sans-serif; background: white; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='var(--blue-400)'" 
                   onblur="this.style.borderColor='var(--border)'"
                   id="filter-nama">
          </div>
          <select name="id_kelurahan" class="form-select" style="border-radius: 8px; border: 1px solid var(--border); padding: 9px 14px; font-size: 13px; min-width: 150px; max-width: 200px;" onchange="this.form.submit()">
            <option value="">Semua Kelurahan</option>
            <?php if(isset($kelurahan_puskesmas)) foreach($kelurahan_puskesmas as $k): ?>
              <option value="<?= $k['id'] ?>" <?= (isset($filter_kelurahan) && $filter_kelurahan == $k['id']) ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_kelurahan'] ?? '') ?></option>
            <?php endforeach; ?>
          </select>
          <select name="status_stunting" class="form-select" style="border-radius: 8px; border: 1px solid var(--border); padding: 9px 14px; font-size: 13px; min-width: 150px; max-width: 200px;" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="Normal" <?= (isset($filter_status) && $filter_status == 'Normal') ? 'selected' : '' ?>>Normal</option>
            <option value="Stunting" <?= (isset($filter_status) && $filter_status == 'Stunting') ? 'selected' : '' ?>>Stunting</option>
            <option value="Sangat Pendek" <?= (isset($filter_status) && $filter_status == 'Sangat Pendek') ? 'selected' : '' ?>>Sangat Pendek</option>
          </select>
          <?php if(!empty($filter_nama) || !empty($filter_kelurahan) || !empty($filter_status)): ?>
          <a href="<?= base_url('balita_admin/index') ?>" 
             style="display: inline-flex; align-items: center; gap: 4px; padding: 9px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; color: var(--text-muted); background: white; border: 1px solid var(--border); text-decoration: none; white-space: nowrap; transition: all 0.2s;"
             onmouseover="this.style.borderColor='var(--danger)'; this.style.color='var(--danger)'"
             onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-muted)'">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Reset Filter
          </a>
          <?php endif; ?>
          <input type="hidden" id="hidden-kelurahan" value="<?= htmlspecialchars($filter_kelurahan ?? '') ?>">
        </form>
      </div>


      <!-- TABLE -->
      <?php if(!empty($filter_nama) || !empty($filter_kelurahan) || !empty($filter_status)): ?>
      <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-size: 12px; color: var(--text-muted); flex-wrap: wrap;">
        <span>Menampilkan <strong style="color: var(--text-primary)"><?= count($balita) ?></strong> hasil</span>
        <?php if(!empty($filter_nama)): ?>
          <span style="background: var(--blue-50); color: var(--blue-600); padding: 2px 10px; border-radius: 20px; font-weight: 600; font-size: 11px;">Nama: "<?= htmlspecialchars($filter_nama) ?>"</span>
        <?php endif; ?>
        <?php if(!empty($filter_kelurahan)):
          $kel_name = '';
          if(isset($kelurahan_puskesmas)) foreach($kelurahan_puskesmas as $k) {
            if ($k['id'] == $filter_kelurahan) { $kel_name = $k['nama_kelurahan']; break; }
          }
        ?>
          <span style="background: #ecfdf5; color: #065f46; padding: 2px 10px; border-radius: 20px; font-weight: 600; font-size: 11px;">Kelurahan: <?= htmlspecialchars($kel_name) ?></span>
        <?php endif; ?>
        <?php if(!empty($filter_status)): ?>
          <?php
            $s_bg = '#f1f5f9'; $s_col = '#475569';
            if($filter_status == 'Normal') { $s_bg = '#ecfdf5'; $s_col = '#047857'; }
            else if($filter_status == 'Stunting') { $s_bg = '#fffbeb'; $s_col = '#b45309'; }
            else if($filter_status == 'Sangat Pendek') { $s_bg = '#fef2f2'; $s_col = '#b91c1c'; }
          ?>
          <span style="background: <?= $s_bg ?>; color: <?= $s_col ?>; padding: 2px 10px; border-radius: 20px; font-weight: 600; font-size: 11px;">Status: <?= htmlspecialchars($filter_status) ?></span>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <div class="card-custom">
        <div class="table-responsive">
          <table class="table-custom">
            <thead>
              <tr>
                <th width="25%">Nama Balita</th>
                <th width="8%">L/P</th>
                <th width="12%">Tanggal Lahir</th>
                <th width="15%">Wilayah (Kelurahan)</th>
                <th width="15%">Pengukuran Terakhir</th>
                <th width="15%">Status</th>
                <th class="text-end" width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($balita)): ?>
              <tr><td colspan="7" class="text-center py-5 text-muted" style="font-size:13px">Belum ada data balita.</td></tr>
              <?php else: ?>
                <?php foreach($balita as $b): ?>
                <tr>
                  <td>
                    <div class="item-title"><?= htmlspecialchars($b['nama_lengkap'] ?? '') ?></div>
                  </td>
                  <td>
                    <span class="badge-jk <?= $b['jenis_kelamin'] ?>">
                        <?= $b['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                    </span>
                  </td>
                  <td>
                    <div><?= date('d M Y', strtotime($b['tgl_lahir'])) ?></div>
                  </td>
                  <td>
                    <div class="item-title"><?= htmlspecialchars($b['nama_kelurahan'] ?? '') ?></div>
                    <div class="item-sub">Kec. <?= htmlspecialchars($b['nama_kecamatan'] ?? '') ?></div>
                  </td>
                  <td>
                    <?php if($b['tgl_pengukuran_terakhir']): ?>
                        <div class="item-title" style="font-weight: 500; font-size: 13px;"><?= date('d M Y', strtotime($b['tgl_pengukuran_terakhir'])) ?></div>
                    <?php else: ?>
                        <span class="text-muted" style="font-size:12px; font-style: italic;">Belum diukur</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($b['tgl_pengukuran_terakhir'] && isset($b['status_stunting_terakhir'])): ?>
                        <?php
                            $s = strtolower($b['status_stunting_terakhir']);
                            $color = '#047857'; $bg = '#ecfdf5'; // Normal
                            if(strpos($s, 'stunting') !== false && strpos($s, 'sangat') === false) { $color = '#b45309'; $bg = '#fffbeb'; }
                            else if(strpos($s, 'sangat') !== false || strpos($s, 'severe') !== false) { $color = '#b91c1c'; $bg = '#fef2f2'; }
                        ?>
                        <span style="background:<?= $bg ?>; color:<?= $color ?>; padding:4px 10px; border-radius:6px; font-weight:600; font-size:11px; display:inline-block; line-height:1.2;">
                            <?= htmlspecialchars($b['status_stunting_terakhir']) ?>
                        </span>
                    <?php else: ?>
                        <span class="text-muted" style="font-size:11px; font-style: italic;">Belum ada data</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-end">
                    <a href="<?= base_url('balita_admin/detail/'.$b['id']) ?>" class="action-btn view" title="Lihat Rekam Jejak">
                      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </a>
                    <button class="action-btn edit" title="Edit Identitas"
                      data-bs-toggle="modal" 
                      data-bs-target="#modalEditBalita"
                      data-id="<?= $b['id'] ?>"
                      data-nama="<?= htmlspecialchars($b['nama_lengkap'] ?? '') ?>"
                      data-tgl="<?= $b['tgl_lahir'] ?>"
                      data-jk="<?= $b['jenis_kelamin'] ?>"
                      data-idkec="<?= $b['id_kecamatan'] ?>"
                      data-idkel="<?= $b['id_kelurahan'] ?>">
                      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <button class="action-btn btn-hapus-balita" 
                       title="Hapus Balita" 
                       data-id="<?= $b['id'] ?>"
                       data-nama="<?= htmlspecialchars($b['nama_lengkap'] ?? '') ?>"
                       data-bs-toggle="modal"
                       data-bs-target="#modalHapusBalita"
                       style="color: var(--danger); background: rgba(239, 68, 68, 0.1);">
                      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
</div>

      <!-- FOOTER -->
      <footer class="footer">
        Copyright © 2026 <span>Teknik Elektro</span> - Politeknik Negeri Manado
      </footer>

    </div>
  </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT BALITA -->
<div class="modal fade" id="modalEditBalita" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 14px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
      <div class="modal-header" style="border-bottom: 1px solid var(--border); padding: 20px 24px;">
        <h5 class="modal-title" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px;">Edit Identitas Balita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?= base_url('balita_admin/update_identitas') ?>" method="POST">
        <input type="hidden" name="id" id="e-id">
        <div class="modal-body" style="padding: 24px;">
          
          <div style="margin-bottom:16px;">
            <label style="font-size: 12px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; display:block;">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama_lengkap" id="e-nama" class="form-control" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" required>
          </div>
          
          <div style="margin-bottom:16px; display:flex; gap:16px;">
            <div style="flex:1;">
              <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Tanggal Lahir <span class="text-danger">*</span></label>
              <input type="date" name="tgl_lahir" id="e-tgl" class="form-control" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" required>
            </div>
            <div style="flex:1;">
              <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Jenis Kelamin <span class="text-danger">*</span></label>
              <select name="jenis_kelamin" id="e-jk" class="form-select" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>

          <div style="margin-bottom:16px;">
            <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Kecamatan <span class="text-danger">*</span></label>
            <select name="id_kecamatan" id="e-kecamatan" class="form-select" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" onchange="filterKelurahanEdit()" required>
              <option value="">Pilih kecamatan...</option>
              <?php if(isset($kecamatan)) foreach($kecamatan as $k): ?>
                  <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kecamatan'] ?? '') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label style="font-size: 12px; font-weight: 600; margin-bottom: 6px; display:block;">Kelurahan <span class="text-danger">*</span></label>
            <select name="id_kelurahan" id="e-kelurahan" class="form-select" style="border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px;" required>
              <option value="">Pilih kelurahan...</option>
            </select>
          </div>

        </div>
        <div class="modal-footer" style="border-top: 1px solid var(--border); padding: 16px 24px; background: var(--surface); border-radius: 0 0 14px 14px;">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="font-size:13px; font-weight:600;">Batal</button>
          <button type="submit" class="btn-primary-custom" style="background:var(--blue-600); color:white; border:none; border-radius:8px; padding:10px 18px; font-size:13px; font-weight:600;">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL HAPUS BALITA -->
<div class="modal fade" id="modalHapusBalita" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
    <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.15); overflow: hidden;">
      <div class="modal-body" style="padding: 0;">
        
        <!-- Danger Header -->
        <div style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); padding: 28px 24px 20px; text-align: center; position: relative; overflow: hidden;">
          <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; border-radius: 50%; background: rgba(239,68,68,0.08);"></div>
          <div style="position: absolute; bottom: -15px; left: -15px; width: 60px; height: 60px; border-radius: 50%; background: rgba(239,68,68,0.06);"></div>
          
          <!-- Animated Warning Icon -->
          <div id="hapus-icon" style="width: 56px; height: 56px; border-radius: 50%; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; box-shadow: 0 8px 20px rgba(239,68,68,0.3); transition: transform 0.3s ease;">
            <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </div>
          
          <h5 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 17px; color: #991b1b; margin-bottom: 4px;">Hapus Data Balita?</h5>
          <p style="font-size: 12px; color: #b91c1c; margin: 0; font-weight: 500;">Tindakan ini tidak dapat dibatalkan</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px 24px;">
          <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 10px; padding: 14px 16px; margin-bottom: 16px;">
            <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: 6px;">Data yang akan dihapus</div>
            <div style="display: flex; align-items: center; gap: 10px;">
              <div style="width: 34px; height: 34px; border-radius: 50%; background: #fef2f2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                  <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </div>
              <div>
                <div id="hapus-nama" style="font-size: 14px; font-weight: 600; color: var(--text-primary); line-height: 1.3;"></div>
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 1px;">Balita & seluruh riwayat pengukuran</div>
              </div>
            </div>
          </div>
          
          <div style="display: flex; align-items: flex-start; gap: 8px; padding: 10px 12px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; margin-bottom: 4px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#f59e0b" stroke-width="2" style="flex-shrink: 0; margin-top: 1px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p style="font-size: 12px; color: #92400e; margin: 0; line-height: 1.5;">Semua data pengukuran dan rekam jejak balita ini akan <strong>terhapus secara permanen</strong> dan tidak dapat dipulihkan.</p>
          </div>
        </div>
        
        <!-- Actions -->
        <div style="padding: 0 24px 20px; display: flex; gap: 10px;">
          <button type="button" class="btn" data-bs-dismiss="modal" 
                  style="flex: 1; padding: 11px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; border: 1px solid var(--border); background: white; color: var(--text-secondary); transition: all 0.2s; font-family: 'DM Sans', sans-serif;"
                  onmouseover="this.style.background='var(--surface)'; this.style.borderColor='var(--text-muted)'"
                  onmouseout="this.style.background='white'; this.style.borderColor='var(--border)'">
            Batal
          </button>
          <a id="hapus-confirm-btn" href="#" 
             style="flex: 1; padding: 11px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; text-align: center; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(239,68,68,0.25); font-family: 'DM Sans', sans-serif;"
             onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(239,68,68,0.35)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239,68,68,0.25)'">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Ya, Hapus Sekarang
          </a>
        </div>
        
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const kelurahanData = <?= isset($kelurahan) ? json_encode($kelurahan) : '[]' ?>;

  function filterKelurahanEdit(selectedId = null) {
      const idKec = document.getElementById('e-kecamatan').value;
      const selKel = document.getElementById('e-kelurahan');
      
      selKel.innerHTML = '<option value="">Pilih kelurahan...</option>';
      if(!idKec) return;
      
      const filtered = kelurahanData.filter(k => k.id_kecamatan == idKec);
      filtered.forEach(k => {
          const selected = (selectedId == k.id) ? 'selected' : '';
          selKel.innerHTML += `<option value="${k.id}" ${selected}>${k.nama_kelurahan}</option>`;
      });
  }

  const modalEditBalita = document.getElementById('modalEditBalita');
  if (modalEditBalita) {
    modalEditBalita.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      document.getElementById('e-id').value = button.getAttribute('data-id');
      document.getElementById('e-nama').value = button.getAttribute('data-nama');
      document.getElementById('e-tgl').value = button.getAttribute('data-tgl');
      document.getElementById('e-jk').value = button.getAttribute('data-jk');
      
      document.getElementById('e-kecamatan').value = button.getAttribute('data-idkec');
      
      // trigger kelurahan list build
      filterKelurahanEdit(button.getAttribute('data-idkel'));
    });
  }

  // Handle Enter key on search input
  const filterNama = document.getElementById('filter-nama');
  if (filterNama) {
    filterNama.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        this.closest('form').submit();
      }
    });
  }

  // Handle delete modal
  const modalHapusBalita = document.getElementById('modalHapusBalita');
  if (modalHapusBalita) {
    modalHapusBalita.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nama = button.getAttribute('data-nama');
      
      document.getElementById('hapus-nama').textContent = nama;
      document.getElementById('hapus-confirm-btn').href = '<?= base_url('balita_admin/hapus/') ?>' + id;
    });

    // Animate icon on modal show
    modalHapusBalita.addEventListener('shown.bs.modal', () => {
      const icon = document.getElementById('hapus-icon');
      icon.style.transform = 'scale(1.1)';
      setTimeout(() => { icon.style.transform = 'scale(1)'; }, 200);
    });
  }
</script>
</body>
</html>
