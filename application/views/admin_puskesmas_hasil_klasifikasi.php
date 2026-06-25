<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Klasifikasi — SIPSTU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap');
    
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

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
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
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .topbar {
      background: white;
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: 60px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .topbar-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 16px;
    }

    .topbar-sub {
      font-size: 12px;
      color: var(--text-muted);
      margin-left: 4px;
    }

    .topbar-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .content {
      flex: 1;
      padding: 24px 28px;
      overflow-y: auto;
    }

    /* ML DASHBOARD COMPONENTS */
    .metrics-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
    .metric-card { background: white; border-radius: 12px; border: 1px solid var(--border); padding: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .metric-value { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 32px; color: var(--blue-600); line-height: 1; margin: 8px 0; }
    .metric-label { font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .metric-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }

    .card-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 14px; margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { background: #f8fafc; padding: 10px 14px; font-size: 11px; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.4px; border-bottom: 1px solid var(--border); text-align: left; }
    .data-table td { padding: 10px 14px; font-size: 13px; border-bottom: 1px solid #f1f5f9; color: var(--text-primary); }
    
    .badge-ml { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; }
    .badge-primary { background: var(--blue-50); color: var(--blue-700); }
    .badge-success { background: var(--success-light); color: var(--success-dark); }
    .badge-warning { background: var(--warning-light); color: var(--warning-dark); }
    .badge-danger  { background: var(--danger-light); color: var(--danger-dark); }

    .prediction-match { background: #ecfdf5; color: #065f46; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 11px; }
    .prediction-mismatch { background: #fef2f2; color: #991b1b; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 11px; }

    .error-alert { background: #fef2f2; border: 1px solid #fee2e2; border-radius: 12px; padding: 24px; color: #991b1b; text-align: center; }
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
<a href="<?= base_url('balita_admin/index') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Data Balita
        </a>
        <a href="<?= base_url('klasifikasi/index') ?>" class="nav-item active">
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
          <div class="avatar">AD</div>
          <div>
            <div class="user-name">Admin
              <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?></div>
            <div class="user-role">Admin Puskesmas</div>
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
      <div>
        <span class="topbar-title">Hasil Klasifikasi</span>
        <span class="topbar-sub">—
          <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?></span>
      </div>
      <div class="topbar-right">
        <div style="font-size:12px;color:var(--text-muted);">
          <span class="badge-ml badge-primary">Model: GaussianNB</span>
        </div>
      </div>
    </div>

    <div class="content">
      <?php if(isset($ml_error)): ?>
        <div class="error-alert">
          <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="opacity:0.5;margin-bottom:12px;"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <div style="font-size:16px;font-weight:700;">Gagal Memuat Analisis ML</div>
          <div style="font-size:13px;margin-top:4px;"><?= $ml_error ?></div>
          <a href="<?= current_url() ?>" class="btn btn-sm btn-outline-danger mt-3">Coba Lagi</a>
        </div>
      <?php else: ?>
        
        <!-- METRICS OVERVIEW -->
        <div class="metrics-grid">
          <div class="metric-card">
            <div class="metric-icon" style="background:var(--blue-50);"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="var(--blue-600)" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="metric-label">Accuracy</div>
            <div class="metric-value"><?= number_format($ml_data['metrics']['accuracy'] * 100, 1) ?>%</div>
            <div style="font-size:10px;color:var(--text-muted);">Ketepatan prediksi keseluruhan</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon" style="background:#f0fdf4;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#10b981" stroke-width="2"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg></div>
            <div class="metric-label">Precision</div>
            <div class="metric-value"><?= number_format($ml_data['metrics']['precision'] * 100, 1) ?>%</div>
            <div style="font-size:10px;color:var(--text-muted);">Keandalan prediksi positif</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon" style="background:#fff7ed;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#f59e0b" stroke-width="2"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg></div>
            <div class="metric-label">Recall</div>
            <div class="metric-value"><?= number_format($ml_data['metrics']['recall'] * 100, 1) ?>%</div>
            <div style="font-size:10px;color:var(--text-muted);">Kemampuan menemukan kasus</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon" style="background:#faf5ff;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#8b5cf6" stroke-width="2"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg></div>
            <div class="metric-label">F1-Score</div>
            <div class="metric-value"><?= number_format($ml_data['metrics']['f1_score'] * 100, 1) ?>%</div>
            <div style="font-size:10px;color:var(--text-muted);">Keseimbangan P & R (Macro)</div>
          </div>
        </div>

        <div class="row g-4">
          <!-- CATEGORY DETAILS -->
          <div class="col-md-5">
            <div class="metric-card" style="height:100%;">
              <div class="card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Evaluasi Per Kategori
              </div>
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th class="text-center">Precision</th>
                    <th class="text-center">F1-Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($ml_data['category_details'] as $cat => $met): ?>
                  <tr>
                    <td><span class="badge-ml badge-primary"><?= $cat ?></span></td>
                    <td class="text-center"><?= number_format($met['precision'] * 100, 0) ?>%</td>
                    <td class="text-center font-bold" style="color:var(--blue-700);"><?= number_format($met['f1'] * 100, 0) ?>%</td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div style="margin-top:20px; padding-top:10px; border-top:1px dashed var(--border); font-size:10px; color:var(--text-muted);">
                * Data training: <?= $ml_data['train_size'] ?> pengukuran<br>
                * Data testing: <?= $ml_data['test_size'] ?> pengukuran
              </div>
            </div>
          </div>

          <!-- RECENT SAMPLES -->
          <div class="col-md-7">
            <div class="metric-card" style="height:100%;">
              <div class="card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Contoh Cek Klasifikasi Model
              </div>
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Fitur Data</th>
                    <th>Status Aktual</th>
                    <th>Prediksi Model</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($ml_data['samples'] as $s): ?>
                  <tr>
                    <td style="font-size:11px;"><?= $s['fitur'] ?></td>
                    <td><span style="font-size:11px;"><?= $s['aktual'] ?></span></td>
                    <td><span style="font-weight:600;font-size:11px;"><?= $s['prediksi'] ?></span></td>
                    <td class="text-center">
                      <?php if($s['aktual'] == $s['prediksi']): ?>
                        <span class="prediction-match">MATCH</span>
                      <?php else: ?>
                        <span class="prediction-mismatch">DIFF</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div style="margin-top:16px; font-size:11px; color:var(--text-muted); background:var(--surface); padding:10px; border-radius:8px;">
                <strong>Catatan:</strong> Klasifikasi menggunakan 4 fitur utama yaitu usia balita (bulan), jenis kelamin, berat badan, dan tinggi badan. Algoritma Naive Bayes menghitung probabilitas tiap kategori status gizi berdasarkan fitur tersebut.
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>
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
</body>
</html>
