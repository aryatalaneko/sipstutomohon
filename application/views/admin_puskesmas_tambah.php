<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Balita - SIPSTU</title>

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
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background: #fafafa;
    }

    .content {
      flex: 1;
      padding: 24px 28px;
      overflow-y: auto;
    }

    /* TOPBAR & HEADER */
    .topbar {
      background: white;
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: 60px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .topbar-back {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: var(--text-secondary);
      transition: all 0.2s;
      text-decoration: none;
    }

    .topbar-back:hover {
      background: var(--surface);
      color: var(--text-primary);
      border-color: var(--text-muted);
    }

    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 0;
    }

    .breadcrumb-link {
      color: var(--text-muted);
      cursor: pointer;
      text-decoration: none;
    }

    .breadcrumb-link:hover {
      color: var(--blue-600);
    }

    .breadcrumb-sep {
      color: var(--border);
      font-size: 14px;
    }

    .breadcrumb-current {
      color: var(--text-primary);
      font-weight: 600;
    }

    .page-header {
      margin-bottom: 24px;
    }

    .page-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 20px;
      color: var(--text-primary);
      margin-bottom: 4px;
    }

    .page-sub {
      font-size: 13px;
      color: var(--text-secondary);
    }

    /* TABS */
    .tabs {
      display: flex;
      gap: 24px;
      border-bottom: 1px solid var(--border);
      margin-bottom: 24px;
      padding-bottom: 0;
    }

    .tab {
      padding: 12px 0;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-muted);
      cursor: pointer;
      position: relative;
    }

    .tab.active {
      color: var(--blue-600);
    }

    .tab.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 2px;
      background: var(--blue-600);
      border-radius: 2px 2px 0 0;
    }

    .tab:hover:not(.active) {
      color: var(--text-primary);
    }

    /* FORM GRID & SECTIONS */
    .form-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 24px;
      margin-bottom: 32px;
    }

    @media (max-width: 992px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    .form-section {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .form-section-header {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 12px;
      background: #fff;
    }

    .form-section-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .form-section-icon.blue {
      background: var(--blue-50);
    }

    .form-section-icon.green {
      background: #ecfdf5;
    }

    .form-section-icon.purple {
      background: #f3e8ff;
    }

    .form-section-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 14px;
      color: var(--text-primary);
    }

    .form-section-body {
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      background: #fff;
    }

    /* FIELD */
    .field {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .field-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .field-label {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .field-required {
      color: var(--danger);
    }

    .field-input {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 13px;
      color: var(--text-primary);
      transition: all 0.2s;
      font-family: 'DM Sans', sans-serif;
      width: 100%;
      outline: none;
    }

    .field-input:focus {
      border-color: var(--blue-400);
      box-shadow: 0 0 0 3px rgba(59, 130, 212, 0.1);
    }

    .field-input.filled {
      background: #f8fafc;
    }

    .field-input:disabled {
      background: #f1f5f9;
      color: var(--text-muted);
      cursor: not-allowed;
    }

    .field-hint {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* USIA DISPLAY */
    .usia-display {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #f8fafc;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 12px 14px;
    }

    .usia-icon {
      color: var(--blue-500);
      flex-shrink: 0;
    }

    .usia-value {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 2px;
    }

    .usia-label {
      font-size: 11px;
      color: var(--text-muted);
    }

    /* RADIO GROUP */
    .radio-group {
      display: flex;
      gap: 12px;
    }

    .radio-option {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 10px;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 10px 14px;
      cursor: pointer;
      transition: all 0.2s;
      background: white;
    }

    .radio-option.selected-boy {
      border-color: var(--blue-500);
      background: var(--blue-50);
    }

    .radio-option.selected-girl {
      border-color: #ec4899;
      background: #fdf2f8;
    }

    .radio-circle {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      background: white;
    }

    .radio-circle.checked-boy {
      border-color: var(--blue-500);
    }

    .radio-circle.checked-girl {
      border-color: #ec4899;
    }

    .radio-circle .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: currentColor;
    }

    .radio-circle.checked-boy .dot {
      background: var(--blue-500);
    }

    .radio-circle.checked-girl .dot {
      background: #ec4899;
    }

    .radio-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
    }

    /* PREVIEW HASIL */
    .status-result {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 20px;
      transition: all 0.3s;
    }

    .status-result.stunting {
      background: #fffbeb;
      border: 1px solid #fcd34d;
    }

    .status-result.normal {
      background: #ecfdf5;
      border: 1px solid #6ee7b7;
    }

    .status-result.severe {
      background: #fef2f2;
      border: 1px solid #fca5a5;
    }

    .status-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      background: white;
      transition: all 0.3s;
    }

    .status-icon.stunting {
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
    }

    .status-icon.normal {
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .status-icon.severe {
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }

    .status-text-main {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 15px;
      margin-bottom: 2px;
    }

    .status-text-main.stunting {
      color: #b45309;
    }

    .status-text-main.normal {
      color: #047857;
    }

    .status-text-main.severe {
      color: #b91c1c;
    }

    .status-text-sub {
      font-size: 11px;
    }

    .status-text-sub.stunting {
      color: #d97706;
    }

    .status-text-sub.normal {
      color: #059669;
    }

    .status-text-sub.severe {
      color: #dc2626;
    }

    .zscore-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-bottom: 24px;
    }

    .zscore-item {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 12px;
      text-align: center;
      background: white;
    }

    .zscore-type {
      font-size: 10px;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 4px;
    }

    .zscore-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 18px;
      line-height: 1;
    }

    .zscore-val.normal {
      color: var(--success);
    }

    .zscore-val.warning {
      color: var(--warning);
    }

    .zscore-val.danger {
      color: var(--danger);
    }

    .prob-bars {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 24px;
    }

    .prob-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .prob-label {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-primary);
      width: 80px;
      flex-shrink: 0;
    }

    .prob-bar-wrap {
      flex: 1;
      height: 6px;
      background: var(--border);
      border-radius: 3px;
      overflow: hidden;
    }

    .prob-bar-fill {
      height: 100%;
      border-radius: 3px;
      transition: width 0.5s ease;
    }

    .prob-pct {
      font-size: 11px;
      font-weight: 700;
      color: var(--text-primary);
      width: 32px;
      text-align: right;
      flex-shrink: 0;
    }

    /* ACTIONS */
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding-top: 20px;
      border-top: 1px solid var(--border);
    }

    .btn-secondary {
      background: white;
      color: var(--text-primary);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 9px 18px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
    }

    .btn-secondary:hover {
      background: var(--surface);
      border-color: var(--text-muted);
    }

    .btn-primary {
      background: var(--blue-600);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 9px 18px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
      box-shadow: 0 4px 12px rgba(37, 99, 168, 0.15);
    }

    .btn-primary:hover {
      background: var(--blue-700);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(37, 99, 168, 0.25);
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
        <a href="#" class="nav-item">
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
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012-2h-2a2 2 0 01-2-2z" />
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
            <div class="user-name">
              <?= $this->session->userdata('nama_puskesmas') ? htmlspecialchars($this->session->userdata('nama_puskesmas')) : 'Admin Puskesmas' ?>
            </div>
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
        <a href="<?= base_url('welcome/puskesmas') ?>" class="topbar-back">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </a>
        <div class="breadcrumb">
          <span class="breadcrumb-link">Data Balita</span>
          <span class="breadcrumb-sep">›</span>
          <span class="breadcrumb-current">Tambah Balita Baru</span>
        </div>
      </div>

      <div class="content">

        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
            style="font-size: 13px; border-radius: 10px;">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
              style="font-size: 10px;"></button>
          </div>
        <?php endif; ?>

        <div class="page-header">
          <div>
            <div class="page-title">Tambah Balita Baru</div>
            <div class="page-sub" style="color: red; font-weight: 600;">*** Note: Form data identitas dan pengukuran
              awal
              balita
            </div>
          </div>
        </div>

        <!-- TABS -->
        <div class="tabs">
          <div class="tab active">Data Identitas</div>
          <!-- <div class="tab">Pengukuran Bulanan</div> -->
        </div>

        <!-- FORM GRID -->
        <form action="<?= base_url('balita_admin/simpan_pengukuran') ?>" method="POST" class="form-grid"
          id="form-balita">

          <!-- Hidden inputs yang akan diupdate via Javascript -->
          <input type="hidden" name="jenis_kelamin" id="inp-jk" value="L">
          <input type="hidden" name="zscore_tbu" id="inp-ztbu" value="-2.4">
          <input type="hidden" name="zscore_bbu" id="inp-zbbu" value="-1.2">
          <input type="hidden" name="zscore_bbtb" id="inp-zbbtb" value="0.3">
          <input type="hidden" name="status_stunting" id="inp-status" value="stunting">

          <!-- KIRI: DATA BALITA -->
          <div style="display:flex;flex-direction:column;gap:20px">

            <!-- Identitas -->
            <div class="form-section">
              <div class="form-section-header">
                <div class="form-section-icon blue">
                  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#3b82d4">
                    <path stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <div class="form-section-title">Identitas Balita</div>
              </div>
              <div class="form-section-body">
                <div class="field">
                  <label class="field-label">Nama Lengkap <span class="field-required">*</span></label>
                  <input class="field-input" name="nama_lengkap" type="text" value=""
                    placeholder="cth. Rizky Nata Pratama" required />
                </div>
                <div class="field">
                  <label class="field-label">Tanggal Lahir <span class="field-required">*</span></label>
                  <input class="field-input" name="tgl_lahir" type="date" value="" id="tgl-lahir" oninput="hitungUsia()"
                    required />
                  <span class="field-hint">Usia akan dihitung otomatis oleh sistem</span>
                </div>

                <!-- USIA OTOMATIS -->
                <div class="field">
                  <label class="field-label">Usia (dihitung otomatis)</label>
                  <div class="usia-display" id="usia-display">
                    <svg class="usia-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-width="1.8"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                      <div class="usia-value" id="usia-value">1 tahun 3 bulan 4 hari</div>
                      <div class="usia-label" id="usia-label">15 bulan · per hari ini</div>
                    </div>
                  </div>
                </div>

                <div class="field">
                  <label class="field-label">Jenis Kelamin <span class="field-required">*</span></label>
                  <div class="radio-group">
                    <div class="radio-option selected-boy" id="opt-laki" onclick="pilihJK('L')">
                      <div class="radio-circle checked-boy" id="rc-laki">
                        <div class="dot"></div>
                      </div>
                      <span class="radio-label">Laki-laki</span>
                    </div>
                    <div class="radio-option" id="opt-perempuan" onclick="pilihJK('P')">
                      <div class="radio-circle" id="rc-perempuan"></div>
                      <span class="radio-label">Perempuan</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Wilayah -->
            <div class="form-section">
              <div class="form-section-header">
                <div class="form-section-icon green">
                  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#10b981">
                    <path stroke-width="1.8"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div class="form-section-title">Wilayah</div>
              </div>
              <div class="form-section-body">
                <div class="field">
                  <label class="field-label">Puskesmas</label>
                  <input class="field-input" type="text"
                    value="<?= $this->session->userdata('nama_puskesmas') ? htmlspecialchars($this->session->userdata('nama_puskesmas')) : 'Admin Puskesmas' ?>"
                    disabled />
                </div>
                <div class="field-row">
                  <div class="field">
                    <label class="field-label">Kecamatan <span class="field-required">*</span></label>
                    <select class="field-input" name="id_kecamatan" id="sel-kecamatan" onchange="filterKelurahan()"
                      required>
                      <option value="">Pilih kecamatan...</option>
                      <?php if (isset($kecamatan))
                        foreach ($kecamatan as $k): ?>
                          <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kecamatan']) ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="field">
                    <label class="field-label">Kelurahan <span class="field-required">*</span></label>
                    <select class="field-input" name="id_kelurahan" id="sel-kelurahan" disabled required>
                      <option value="">Pilih kecamatan terlebih dahulu</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pengukuran Awal -->
            <div class="form-section">
              <div class="form-section-header">
                <div class="form-section-icon purple">
                  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed">
                    <path stroke-width="1.8"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012-2h-2a2 2 0 01-2-2z" />
                  </svg>
                </div>
                <div class="form-section-title">Pengukuran Awal</div>
              </div>
              <div class="form-section-body">
                <div class="field-row">
                  <div class="field">
                    <label class="field-label">Berat Badan (kg) <span class="field-required">*</span></label>
                    <input class="field-input" name="berat_badan" type="number" value="" step="0.1" min="0" max="30"
                      placeholder="0.0" id="inp-bb" oninput="hitungZscore()" required />
                  </div>
                  <div class="field">
                    <label class="field-label">Tinggi Badan (cm) <span class="field-required">*</span></label>
                    <input class="field-input" name="tinggi_badan" type="number" value="" step="0.1" min="0" max="130"
                      placeholder="0.0" id="inp-tb" oninput="hitungZscore()" required />
                  </div>
                </div>
                <div class="field">
                  <label class="field-label">Tanggal Pengukuran <span class="field-required">*</span></label>
                  <input class="field-input filled" name="tgl_pengukuran" type="date" value="<?= date('Y-m-d') ?>"
                    required />
                </div>
              </div>
            </div>

          </div>

          <!-- KANAN: PREVIEW HASIL -->
          <div style="display:flex;flex-direction:column;gap:20px">
            <div class="form-section" style="position:sticky;top:0">
              <div class="form-section-header">
                <div class="form-section-icon purple">
                  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7c3aed">
                    <path stroke-width="1.8"
                      d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" />
                  </svg>
                </div>
                <div class="form-section-title">Pratinjau Hasil Klasifikasi</div>
              </div>
              <div class="form-section-body">

                <!-- STATUS HASIL -->
                <div class="status-result stunting" id="status-result">
                  <div class="status-icon stunting" id="status-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#d97706">
                      <path stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                  </div>
                  <div>
                    <div class="status-text-main stunting" id="status-label">Stunting (Pendek)</div>
                    <div class="status-text-sub stunting" id="status-sub">Z-score TB/U: -2.4 SD · Di bawah normal</div>
                  </div>
                </div>

                <!-- Z-SCORE GRID -->
                <div>
                  <div
                    style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:10px">
                    Z-Score WHO</div>
                  <div class="zscore-grid">
                    <div class="zscore-item">
                      <div class="zscore-type">TB/U</div>
                      <div class="zscore-val warning" id="z-tbu">-2.4</div>
                    </div>
                    <div class="zscore-item">
                      <div class="zscore-type">BB/U</div>
                      <div class="zscore-val normal" id="z-bbu">-1.2</div>
                    </div>
                    <div class="zscore-item">
                      <div class="zscore-type">BB/TB</div>
                      <div class="zscore-val normal" id="z-bbtb">+0.3</div>
                    </div>
                  </div>
                </div>

                <!-- PROBABILITAS -->
                <div>
                  <div
                    style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:10px">
                    Probabilitas Naive Bayes</div>
                  <div class="prob-bars">
                    <div class="prob-row">
                      <div class="prob-label">Normal</div>
                      <div class="prob-bar-wrap">
                        <div class="prob-bar-fill" id="pb-normal" style="background:var(--success);width:12%"></div>
                      </div>
                      <div class="prob-pct" id="pp-normal">12%</div>
                    </div>
                    <div class="prob-row">
                      <div class="prob-label">Stunting</div>
                      <div class="prob-bar-wrap">
                        <div class="prob-bar-fill" id="pb-stunting" style="background:var(--warning);width:71%"></div>
                      </div>
                      <div class="prob-pct" id="pp-stunting">71%</div>
                    </div>
                    <div class="prob-row">
                      <div class="prob-label">Sangat Pendek</div>
                      <div class="prob-bar-wrap">
                        <div class="prob-bar-fill" id="pb-severe" style="background:var(--danger);width:17%"></div>
                      </div>
                      <div class="prob-pct" id="pp-severe">17%</div>
                    </div>
                  </div>
                </div>

                <!-- KETERANGAN ZSCORE -->
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:12px">
                  <div style="font-size:11px;font-weight:600;color:var(--text-secondary);margin-bottom:8px">Referensi
                    Z-score WHO</div>
                  <div style="display:flex;flex-direction:column;gap:4px">
                    <div style="display:flex;justify-content:space-between;font-size:11px">
                      <span style="color:var(--success)">Normal</span>
                      <span style="color:var(--text-muted)">&ge; -2 SD</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:11px">
                      <span style="color:var(--warning)">Stunting</span>
                      <span style="color:var(--text-muted)">-3 SD s/d &lt; -2 SD</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:11px">
                      <span style="color:var(--danger)">Sangat Pendek</span>
                      <span style="color:var(--text-muted)">&lt; -3 SD</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </form>

        <!-- ACTIONS -->
        <div class="form-actions mb-4">
          <!-- Submitting the form with JS wrapper for visual feedback, or relying on standard submit -->
          <button type="submit" form="form-balita" class="btn-primary"
            onclick="return confirm('Simpan data pengukuran balita?')">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
            Simpan Data Balita
          </button>
          <button type="button" class="btn-secondary" onclick="window.location.reload()">Batal</button>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/js/who_zscore.js') ?>"></script>

  <script>
    function hitungUsia() {
      const tgl = document.getElementById('tgl-lahir').value;
      if (!tgl) return;
      const lahir = new Date(tgl);
      const now = new Date();
      let tahun = now.getFullYear() - lahir.getFullYear();
      let bulan = now.getMonth() - lahir.getMonth();
      let hari = now.getDate() - lahir.getDate();
      if (hari < 0) { bulan--; hari += 30; }
      if (bulan < 0) { tahun--; bulan += 12; }
      const totalBulan = tahun * 12 + bulan;
      document.getElementById('usia-value').textContent = tahun + ' tahun ' + bulan + ' bulan ' + hari + ' hari';
      document.getElementById('usia-label').textContent = totalBulan + ' bulan · per hari ini';
      hitungZscore();
    }

    const kelurahanData = <?= isset($kelurahan) ? json_encode($kelurahan) : '[]' ?>;

    function filterKelurahan() {
      const idKec = document.getElementById('sel-kecamatan').value;
      const selKel = document.getElementById('sel-kelurahan');

      selKel.innerHTML = '<option value="">Pilih kelurahan...</option>';
      if (!idKec) {
        selKel.disabled = true;
        return;
      }
      selKel.disabled = false;

      const filtered = kelurahanData.filter(k => k.id_kecamatan == idKec);
      if (filtered.length === 0) {
        selKel.innerHTML = '<option value="">Tidak ada kelurahan</option>';
        selKel.disabled = true;
        return;
      }

      filtered.forEach(k => {
        selKel.innerHTML += `<option value="${k.id}">${k.nama_kelurahan}</option>`;
      });
    }

    function pilihJK(jk) {
      const optL = document.getElementById('opt-laki');
      const optP = document.getElementById('opt-perempuan');
      const rcL = document.getElementById('rc-laki');
      const rcP = document.getElementById('rc-perempuan');
      if (jk === 'L') {
        optL.className = 'radio-option selected-boy';
        optP.className = 'radio-option';
        rcL.className = 'radio-circle checked-boy'; rcL.innerHTML = '<div class="dot"></div>';
        rcP.className = 'radio-circle'; rcP.innerHTML = '';
      } else {
        optP.className = 'radio-option selected-girl';
        optL.className = 'radio-option';
        rcP.className = 'radio-circle checked-girl'; rcP.innerHTML = '<div class="dot"></div>';
        rcL.className = 'radio-circle'; rcL.innerHTML = '';
      }
      document.getElementById('inp-jk').value = jk;
      hitungZscore();
    }

    function hitungZscore() {
      const bb = parseFloat(document.getElementById('inp-bb').value) || 0;
      const tb = parseFloat(document.getElementById('inp-tb').value) || 0;
      if (!bb || !tb) return;

      const tglLahir = document.getElementById('tgl-lahir').value;
      if (!tglLahir) return;

      const jk = document.getElementById('inp-jk').value || 'L';
      const usiaBulan = whoHitungUsiaBulan(tglLahir);

      // Hitung z-score menggunakan tabel LMS WHO 2006
      const hasil = whoHitungSemua(bb, tb, usiaBulan, jk);
      const { tbu, bbu, bbtb, status, statusString } = hasil;

      const setZ = (id, val) => {
        const el = document.getElementById(id);
        if (val === null) { el.textContent = '-'; el.className = 'zscore-val normal'; return; }
        el.textContent = (val >= 0 ? '+' : '') + val;
        el.className = 'zscore-val ' + (val >= -2 ? 'normal' : val >= -3 ? 'warning' : 'danger');
      };
      setZ('z-tbu', tbu); setZ('z-bbu', bbu); setZ('z-bbtb', bbtb);

      let pN, pS, pSv;
      if (status === 'normal') { pN = 85; pS = 11; pSv = 4; }
      else if (status === 'stunting') { pN = 12; pS = 71; pSv = 17; }
      else { pN = 3; pS = 14; pSv = 83; }

      const labels = { normal: 'Normal', stunting: 'Stunting (Pendek)', severe: 'Sangat Pendek' };
      const subs = {
        normal: 'Z-score TB/U: ' + tbu + ' SD · Tinggi badan normal',
        stunting: 'Z-score TB/U: ' + tbu + ' SD · Di bawah normal',
        severe: 'Z-score TB/U: ' + tbu + ' SD · Jauh di bawah normal'
      };
      const icons = {
        normal: '<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#059669"><path stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        stunting: '<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#d97706"><path stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
        severe: '<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#dc2626"><path stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
      };

      document.getElementById('status-result').className = 'status-result ' + status;
      document.getElementById('status-icon').className = 'status-icon ' + status;
      document.getElementById('status-icon').innerHTML = icons[status];
      document.getElementById('status-label').className = 'status-text-main ' + status;
      document.getElementById('status-label').textContent = labels[status];
      document.getElementById('status-sub').className = 'status-text-sub ' + status;
      document.getElementById('status-sub').textContent = subs[status];

      document.getElementById('pb-normal').style.width = pN + '%';
      document.getElementById('pb-stunting').style.width = pS + '%';
      document.getElementById('pb-severe').style.width = pSv + '%';
      document.getElementById('pp-normal').textContent = pN + '%';
      document.getElementById('pp-stunting').textContent = pS + '%';
      document.getElementById('pp-severe').textContent = pSv + '%';

      // Update hidden inputs untuk dikirim ke server
      document.getElementById('inp-ztbu').value = tbu !== null ? tbu : 0;
      document.getElementById('inp-zbbu').value = bbu !== null ? bbu : 0;
      document.getElementById('inp-zbbtb').value = bbtb !== null ? bbtb : 0;
      document.getElementById('inp-status').value = statusString;
    }
  </script>

<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>

</html>