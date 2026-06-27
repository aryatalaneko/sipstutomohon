<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan per Puskesmas - SIPSTU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap');

    :root {
      --blue-950: #0a1628;
      --blue-900: #0f2044;
      --blue-700: #1e4080;
      --blue-600: #2563a8;
      --blue-500: #3b82d4;
      --border: #e2e8f0;
      --surface: #f8fafc;
      --text-primary: #0f172a;
      --text-secondary: #475569;
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

    .sidebar::before {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 180px;
      height: 180px;
      background: radial-gradient(circle, rgba(37, 99, 168, 0.4) 0%, transparent 70%);
      pointer-events: none;
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

    /* MAIN CONTENT */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background: var(--surface);
    }

    .topbar {
      background: white;
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .content {
      flex: 1;
      padding: 24px 28px;
      overflow-y: auto;
    }

    /* FILTER CARD */
    .filter-card {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      padding: 20px;
      margin-bottom: 24px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-label {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-secondary);
      margin-bottom: 6px;
    }

    .form-select,
    .form-control {
      font-size: 13px;
      border-radius: 8px;
      border: 1px solid var(--border);
      padding: 8px 12px;
    }

    /* REPORTING AREA */
    .report-container {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .report-header {
      padding: 32px;
      border-bottom: 2px solid var(--blue-500);
      text-align: center;
      background: linear-gradient(to bottom, #ffffff, #f8fafc);
    }

    .report-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 800;
      font-size: 22px;
      color: var(--blue-950);
      margin-bottom: 4px;
    }

    .report-sub {
      font-size: 14px;
      color: var(--text-secondary);
      font-weight: 500;
    }

    .report-summary {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1px;
      background: var(--border);
      border-bottom: 1px solid var(--border);
    }

    .summary-item {
      background: white;
      padding: 20px;
      text-align: center;
    }

    .summary-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 20px;
      color: var(--blue-900);
    }

    .summary-lbl {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-secondary);
      text-transform: uppercase;
      margin-top: 2px;
    }

    .table-responsive {
      padding: 24px;
    }

    .report-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .report-table th {
      background: #f1f5f9;
      color: var(--text-secondary);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 11px;
      padding: 12px 16px;
      border-bottom: 1px solid var(--border);
      text-align: left;
    }

    .report-table td {
      padding: 14px 16px;
      border-bottom: 1px solid #f1f5f9;
    }

    .report-table tr:last-child td {
      border-bottom: none;
    }

    .badge-status {
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
    }

    .badge-high {
      background: #fef2f2;
      color: #dc2626;
    }

    .badge-med {
      background: #fffbeb;
      color: #d97706;
    }

    .badge-low {
      background: #f0fdf4;
      color: #16a34a;
    }

    @media print {

      .sidebar,
      .topbar,
      .filter-card,
      .btn-print-action {
        display: none !important;
      }

      body {
        background: white;
      }

      .main {
        padding: 0;
      }

      .content {
        padding: 0;
      }

      .report-container {
        border: none;
        box-shadow: none;
      }

      @page {
        size: A4;
        margin: 1.5cm;
      }
    }
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
            <div class="logo-sub" style="font-size: 10px; color: rgba(255,255,255,0.4);">Dinkes Kota Tomohon</div>
          </div>
        </div>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-label">Utama</div>
        <a href="<?= base_url() ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="1.8" />
            <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="1.8" />
            <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="1.8" />
            <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="1.8" />
          </svg>
          Dashboard
        </a>
<a href="<?= base_url('welcome/peta_kelurahan') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
            <circle cx="12" cy="9" r="2.5" stroke-width="1.8" />
          </svg>
          Peta per Kelurahan
        </a>
        <a href="<?= base_url('welcome/peta_puskesmas') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
          </svg>
          Peta per Puskesmas
        </a>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-label">Analitik</div>
        <a href="<?= base_url('welcome/grafik_kelurahan') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          Grafik per Kelurahan
        </a>
        <a href="<?= base_url('welcome/grafik_puskesmas') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M16 8v8m-4-5v5m-4-2v2M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Grafik per Puskesmas
        </a>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-label">Laporan</div>
        <a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Laporan per Kelurahan
        </a>
        <a href="<?= base_url('welcome/laporan_puskesmas') ?>" class="nav-item active">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Laporan per Puskesmas
        </a>
      </div>

      <div class="sidebar-section">
        <div class="sidebar-label">Kelola</div>
        <a href="<?= base_url('puskesmas_admin') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          Manajemen Puskesmas
        </a>
        <a href="<?= base_url('kelurahan_admin') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Manajemen Kelurahan
        </a>
      </div>

      <div style="margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07);">
        <div class="user-card" style="display: flex; align-items: center; gap: 10px; padding: 8px; border-radius: 8px;">
          <div class="avatar"
            style="width: 32px; height: 32px; border-radius: 50%; background: var(--blue-600); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: white;">
            SA</div>
          <div>
            <div class="user-name" style="font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.85);">Super Admin
            </div>
            <div class="user-role" style="font-size: 10px; color: rgba(255,255,255,0.35);">Dinas Kesehatan</div>
          </div>
        </div>
        <a href="<?= base_url('auth/logout') ?>" class="nav-item text-danger mt-2"
          style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #ef4444;">
            <path stroke-width="1.8"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Keluar
        </a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main">
      <div class="topbar">
        <div style="font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;">Laporan Stunting per Puskesmas
        </div>
        <button class="btn btn-danger btn-sm btn-print-action" onclick="window.print()"
          style="border-radius: 8px; font-weight: 600; padding: 6px 16px;">
          Cetak PDF
        </button>
      </div>

      <div class="content">
        <!-- FILTERS -->
        <div class="filter-card">
          <form method="get" action="<?= base_url('welcome/laporan_puskesmas') ?>" class="row g-3">
            <div class="col-md-2">
              <label class="form-label">Bulan</label>
              <select name="bulan" class="form-select">
                <?php
                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                foreach ($bulan as $i => $b):
                  $m = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                  ?>
                  <option value="<?= $m ?>" <?= $sel_m == $m ? 'selected' : '' ?>><?= $b ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Tahun</label>
              <select name="tahun" class="form-select">
                <?php for ($y = date('Y'); $y >= 2020; $y--): ?>
                  <option value="<?= $y ?>" <?= $sel_y == $y ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Puskesmas</label>
              <select name="puskesmas" class="form-select">
                <option value="all" <?= $sel_p == 'all' ? 'selected' : '' ?>>Semua Puskesmas</option>
                <?php foreach ($puskesmas_list as $pk): ?>
                  <option value="<?= $pk['id'] ?>" <?= $sel_p == $pk['id'] ? 'selected' : '' ?>><?= $pk['nama_puskesmas'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Jenis Laporan</label>
              <select name="jenis" class="form-select">
                <option value="rekap" <?= $sel_jenis == 'rekap' ? 'selected' : '' ?>>Rekapitulasi</option>
                <option value="detail" <?= $sel_jenis == 'detail' ? 'selected' : '' ?>>Detail Balita</option>
              </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="submit" class="btn btn-dark w-100"
                style="border-radius: 8px; font-weight: 600; padding: 8px;">Tampilkan</button>
            </div>
          </form>
        </div>

        <!-- REPORT -->
        <div class="report-container">
          <div class="report-header">
            <div class="report-title">LAPORAN ANALISA STUNTING KOTA TOMOHON</div>
            <div class="report-sub">PUSKESMAS: <?= $sel_p == 'all' ? 'SEMUA WILAYAH' : 'PUSKESMAS TERTENTU' ?> ·
              PERIODE: <?= strtoupper($bulan_str) ?></div>
          </div>

          <div class="report-summary">
            <div class="summary-item">
              <div class="summary-val"><?= $total_diukur ?></div>
              <div class="summary-lbl">TERUKUR</div>
            </div>
            <div class="summary-item">
              <div class="summary-val"><?= $total_stunted ?></div>
              <div class="summary-lbl">POKOK STUNTING</div>
            </div>
            <div class="summary-item">
              <div class="summary-val" style="color: #ef4444;"><?= $total_sangat ?></div>
              <div class="summary-lbl">SANGAT PENDEK</div>
            </div>
            <div class="summary-item">
              <div class="summary-val" style="color: #3b82d4; font-size: 24px;"><?= $prev_all ?>%</div>
              <div class="summary-lbl">PREVALENSI KOTA</div>
            </div>
          </div>

          <div class="table-responsive">
            <?php if ($sel_jenis == 'rekap'): ?>
              <table class="report-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Puskesmas</th>
                    <th class="text-center">Sasaran</th>
                    <th class="text-center">Diukur</th>
                    <th class="text-center">Normal</th>
                    <th class="text-center">Stunting</th>
                    <th class="text-center">S. Pendek</th>
                    <th class="text-center">Prevalensi</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($laporan as $idx => $r): ?>
                    <tr>
                      <td><?= $idx + 1 ?></td>
                      <td style="font-weight: 600; color: var(--blue-900);"><?= $r['nama_puskesmas'] ?></td>
                      <td class="text-center"><?= $r['total_terdaftar'] ?></td>
                      <td class="text-center"><?= $r['total_diukur'] ?></td>
                      <td class="text-center"><?= $r['jml_normal'] ?></td>
                      <td class="text-center"><?= $r['jml_stunting'] ?></td>
                      <td class="text-center" style="color: #ef4444;"><?= $r['jml_sangat'] ?></td>
                      <td class="text-center"><strong><?= $r['prevalensi'] ?>%</strong></td>
                      <td class="text-center">
                        <span
                          class="badge-status <?= $r['status'] == 'Tinggi' ? 'badge-high' : ($r['status'] == 'Sedang' ? 'badge-med' : 'badge-low') ?>">
                          <?= $r['status'] ?>
                        </span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <table class="report-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>L/P</th>
                    <th>Umur</th>
                    <th>Tgl Lahir</th>
                    <th>Puskesmas</th>
                    <th>Tgl Ukur</th>
                    <th>Status Gizi (TB/U)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($laporan_detail)): ?>
                    <?php foreach ($laporan_detail as $idx => $ld):
                      $bday = new DateTime($ld['tgl_lahir']);
                      $today = new DateTime($ld['tgl_pengukuran']);
                      $diff = $bday->diff($today);
                      $age_str = ($diff->y > 0 ? $diff->y . ' Thn ' : '') . $diff->m . ' Bln';
                      ?>
                      <tr>
                        <td><?= $idx + 1 ?></td>
                        <td style="font-weight: 600;"><?= $ld['nama_lengkap'] ?></td>
                        <td><?= $ld['jenis_kelamin'] ?></td>
                        <td><?= $age_str ?></td>
                        <td><?= date('d/m/Y', strtotime($ld['tgl_lahir'])) ?></td>
                        <td><?= $ld['nama_puskesmas'] ?></td>
                        <td><?= date('d/m/Y', strtotime($ld['tgl_pengukuran'])) ?></td>
                        <td>
                          <span
                            class="badge-status <?= strpos(strtolower($ld['status_stunting']), 'sangat') !== false ? 'badge-high' : (strpos(strtolower($ld['status_stunting']), 'stunting') !== false ? 'badge-med' : 'badge-low') ?>">
                            <?= $ld['status_stunting'] ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7" class="text-center py-4">Tidak ada data detail untuk periode ini</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>

          <div style="padding: 40px; text-align: right; font-size: 13px;">
            Tomohon, <?= date('d') ?> <?= $bulan[(int) date('m') - 1] ?> <?= date('Y') ?><br>
            <div style="margin-top: 60px; font-weight: 700; text-decoration: underline;">SUPER ADMIN</div>
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

<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>

</html>
