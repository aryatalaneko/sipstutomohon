<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPSTU - Admin Puskesmas</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

    .nav-badge {
      margin-left: auto;
      background: var(--danger);
      color: white;
      font-size: 10px;
      padding: 1px 6px;
      border-radius: 10px;
      font-weight: 600;
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

    .period-select {
      border: 1px solid var(--border);
      background: var(--surface);
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 12px;
      color: var(--text-secondary);
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
    }

    .btn-primary {
      background: var(--blue-600);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 7px 14px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      font-family: 'DM Sans', sans-serif;
    }

    .btn-primary:hover {
      background: var(--blue-700);
    }

    .content {
      flex: 1;
      padding: 24px 28px;
      overflow-y: auto;
    }

    /* WELCOME BANNER */
    .welcome-banner {
      background: linear-gradient(135deg, var(--blue-800) 0%, var(--blue-600) 100%);
      border-radius: 14px;
      padding: 20px 24px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }

    .welcome-banner::before {
      content: '';
      position: absolute;
      right: -30px;
      top: -40px;
      width: 160px;
      height: 160px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
    }

    .welcome-banner::after {
      content: '';
      position: absolute;
      right: 60px;
      bottom: -50px;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.04);
    }

    .welcome-text h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 18px;
      color: white;
      margin-bottom: 0;
    }

    .welcome-text p {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.65);
      margin-top: 4px;
      margin-bottom: 0;
    }

    .welcome-stats {
      display: flex;
      gap: 24px;
      z-index: 1;
    }

    .welcome-stat {
      text-align: center;
    }

    .welcome-stat-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 22px;
      color: white;
    }

    .welcome-stat-lbl {
      font-size: 10px;
      color: rgba(255, 255, 255, 0.5);
      margin-top: 2px;
    }

    .welcome-divider {
      width: 1px;
      background: rgba(255, 255, 255, 0.15);
      align-self: stretch;
    }

    /* STAT CARDS */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 18px;
      border: 1px solid var(--border);
      position: relative;
      overflow: hidden;
    }

    .stat-card::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 3px;
    }

    .stat-card.blue::after {
      background: var(--blue-500);
    }

    .stat-card.green::after {
      background: var(--success);
    }

    .stat-card.amber::after {
      background: var(--warning);
    }

    .stat-card.red::after {
      background: var(--danger);
    }

    .stat-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .stat-icon {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-icon.blue {
      background: var(--blue-50);
    }

    .stat-icon.green {
      background: #ecfdf5;
    }

    .stat-icon.amber {
      background: #fffbeb;
    }

    .stat-icon.red {
      background: #fef2f2;
    }

    .stat-value {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 26px;
      color: var(--text-primary);
      line-height: 1;
    }

    .stat-change {
      display: flex;
      align-items: center;
      gap: 4px;
      margin-top: 6px;
      font-size: 11px;
    }

    .stat-change.up {
      color: var(--success);
    }

    .stat-change.down {
      color: var(--danger);
    }

    .stat-change span {
      color: var(--text-muted);
    }

    /* GRID */
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 20px;
    }

    .grid-3-2 {
      display: grid;
      grid-template-columns: 3fr 2fr;
      gap: 16px;
      margin-bottom: 20px;
    }

    /* CARD CUSTOM */
    .card-custom {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .card-custom-header {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-custom-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 13px;
      color: var(--text-primary);
      margin-bottom: 0;
    }

    .card-custom-sub {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 1px;
    }

    .card-custom-body {
      padding: 20px;
    }

    .card-custom-action {
      font-size: 11px;
      color: var(--blue-500);
      cursor: pointer;
      font-weight: 500;
      text-decoration: none;
    }

    .card-custom-action:hover {
      text-decoration: underline;
    }

    /* CHART */
    .chart-area {
      height: 160px;
      display: flex;
      align-items: flex-end;
      gap: 8px;
      padding: 0 4px;
    }

    .bar-group {
      flex: 1;
      display: flex;
      gap: 2px;
      align-items: flex-end;
    }

    .bar {
      border-radius: 4px 4px 0 0;
      flex: 1;
      transition: opacity 0.2s;
      cursor: pointer;
    }

    .bar:hover {
      opacity: 0.75;
    }

    .bar.blue {
      background: var(--blue-500);
    }

    .bar.amber {
      background: var(--warning);
    }

    .bar.red {
      background: var(--danger);
    }

    .chart-labels {
      display: flex;
      gap: 8px;
      padding: 8px 4px 0;
    }

    .chart-label {
      flex: 1;
      text-align: center;
      font-size: 10px;
      color: var(--text-muted);
    }

    .legend {
      display: flex;
      gap: 14px;
      padding: 10px 20px;
      border-top: 1px solid var(--border);
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 11px;
      color: var(--text-secondary);
    }

    .legend-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    /* KELURAHAN TABLE */
    .kel-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 0;
    }

    .kel-table th {
      font-size: 10px;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 10px 16px;
      text-align: left;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
    }

    .kel-table td {
      padding: 11px 16px;
      font-size: 12px;
      color: var(--text-secondary);
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }

    .kel-table tr:last-child td {
      border-bottom: none;
    }

    .kel-table tr:hover td {
      background: var(--surface);
    }

    .kel-name {
      font-weight: 600;
      color: var(--text-primary);
      font-size: 13px;
    }

    .prog-wrap {
      flex: 1;
      height: 5px;
      background: var(--border);
      border-radius: 3px;
      overflow: hidden;
    }

    .prog-fill {
      height: 100%;
      border-radius: 3px;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 2px 8px;
      border-radius: 6px;
      font-size: 10px;
      font-weight: 600;
    }

    .status-badge.normal {
      background: #ecfdf5;
      color: #065f46;
    }

    .status-badge.stunting {
      background: #fffbeb;
      color: #92400e;
    }

    .status-badge.severe {
      background: #fef2f2;
      color: #991b1b;
    }

    /* BALITA LIST */
    .balita-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .balita-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 8px;
      background: var(--surface);
      border: 1px solid var(--border);
      cursor: pointer;
      transition: border-color 0.15s;
    }

    .balita-item:hover {
      border-color: var(--blue-300);
    }

    .balita-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 700;
      flex-shrink: 0;
    }

    .balita-avatar.boy {
      background: var(--blue-50);
      color: var(--blue-600);
    }

    .balita-avatar.girl {
      background: #fdf2f8;
      color: #9d174d;
    }

    .balita-name {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .balita-info {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 1px;
    }

    .balita-right {
      margin-left: auto;
      text-align: right;
    }

    .balita-status {
      font-size: 11px;
      font-weight: 600;
    }

    .balita-status.normal {
      color: var(--success);
    }

    .balita-status.stunting {
      color: var(--warning);
    }

    .balita-status.severe {
      color: var(--danger);
    }

    .balita-date {
      font-size: 10px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* INPUT REMINDER */
    .reminder-card {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      padding: 16px 20px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .reminder-icon {
      width: 40px;
      height: 40px;
      background: #fffbeb;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .reminder-text {
      flex: 1;
    }

    .reminder-title {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 2px;
    }

    .reminder-sub {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 2px;
      margin-bottom: 0;
    }

    .reminder-btn {
      background: var(--warning);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 7px 14px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      white-space: nowrap;
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
        <a href="<?= base_url('welcome/puskesmas') ?>" class="nav-item active">
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
          <div class="avatar">AD</div>
          <div>
            <div class="user-name">Admin
              <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?>
            </div>
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
          <span class="topbar-title">Dashboard</span>
          <span class="topbar-sub">—
            <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?></span>
        </div>
        <div class="topbar-right">
          <!-- <select class="period-select focus-ring" style="--bs-focus-ring-color: rgba(var(--bs-primary-rgb), .25)">
            <option>Maret 2026</option>
            <option>Februari 2026</option>
            <option>Januari 2026</option>
          </select> -->
          <button class="btn-primary" onclick="window.location.href='<?= base_url('balita_admin/tambah') ?>'">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Input Pengukuran
          </button>
        </div>
      </div>

      <div class="content">

        <!-- WELCOME BANNER -->
        <div class="welcome-banner">
          <div class="welcome-text">
            <h2>Selamat datang, Admin <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: '') ?></h2>
            <p><?= htmlspecialchars($bulan_ini) ?> · <?= $belum_diukur ?> balita belum diukur bulan ini</p>
          </div>
          <div class="welcome-stats">
            <div class="welcome-stat">
              <div class="welcome-stat-val"><?= $jml_balita ?></div>
              <div class="welcome-stat-lbl">Total Balita</div>
            </div>
            <div class="welcome-divider"></div>
            <div class="welcome-stat">
              <div class="welcome-stat-val"><?= $sudah_diukur ?></div>
              <div class="welcome-stat-lbl">Sudah Diukur</div>
            </div>
            <div class="welcome-divider"></div>
            <div class="welcome-stat">
              <div class="welcome-stat-val"><?= $belum_diukur ?></div>
              <div class="welcome-stat-lbl">Belum Diukur</div>
            </div>
          </div>
        </div>

        <!-- REMINDER -->
        <!-- <div class="reminder-card">
          <div class="reminder-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#f59e0b">
              <path stroke-width="1.8"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="reminder-text">
            <h6 class="reminder-title"><?= $belum_diukur ?> balita belum diinput pengukuran bulan
              <?= htmlspecialchars($bulan_ini) ?></h6>
            <p class="reminder-sub">Batas akhir input disarankan sebelum akhir bulan</p>
          </div>
          <button class="reminder-btn">Lihat Daftar</button>
        </div> -->

        <!-- STAT CARDS -->
        <div class="stats-grid">
          <div class="stat-card blue">
            <div class="stat-header">
              <div class="stat-label">Total Balita</div>
              <div class="stat-icon blue">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#3b82d4">
                  <path stroke-width="1.8"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
            </div>
            <div class="stat-value"><?= $jml_balita ?></div>
            <div class="stat-change up">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2.5" d="M5 15l7-7 7 7" />
              </svg>
              +0 <span>bulan ini</span>
            </div>
          </div>
          <div class="stat-card green">
            <div class="stat-header">
              <div class="stat-label">Normal</div>
              <div class="stat-icon green">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#10b981">
                  <path stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
            <div class="stat-value"><?= $count_normal ?></div>
            <div class="stat-change up">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2.5" d="M5 15l7-7 7 7" />
              </svg>
              <?= $jml_balita > 0 ? floatval(str_replace(',', '.', number_format(($count_normal / $jml_balita) * 100, 1))) : 0 ?>%
              <span>dari total</span>
            </div>
          </div>
          <div class="stat-card amber">
            <div class="stat-header">
              <div class="stat-label">Stunting (Risiko)</div>
              <div class="stat-icon amber">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#f59e0b">
                  <path stroke-width="1.8"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
            </div>
            <div class="stat-value"><?= $count_stunting ?></div>
            <div class="stat-change down">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
              <?= $jml_balita > 0 ? floatval(str_replace(',', '.', number_format(($count_stunting / $jml_balita) * 100, 1))) : 0 ?>%
              <span>dari total</span>
            </div>
          </div>
          <div class="stat-card red">
            <div class="stat-header">
              <div class="stat-label">Sangat Pendek / Stunting</div>
              <div class="stat-icon red">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#ef4444">
                  <path stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
            <div class="stat-value"><?= $count_sangat ?></div>
            <div class="stat-change down">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
              <?= $jml_balita > 0 ? floatval(str_replace(',', '.', number_format(($count_sangat / $jml_balita) * 100, 1))) : 0 ?>%
              <span>dari total</span>
            </div>
          </div>
        </div>

        <!-- CHART + BALITA TERBARU -->
        <div class="grid-3-2">
          <div class="card-custom">
            <div class="card-custom-header">
              <div>
                <h5 class="card-custom-title">Tren Stunting</h5>
                <div class="card-custom-sub">6 bulan terakhir · Puskesmas
                  <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: '') ?>
                </div>
              </div>
              <a href="#" class="card-custom-action">Detail grafik</a>
            </div>
            <div class="card-custom-body">
              <div class="chart-area" id="tren-chart">
                <?php
                $max_raw = 1;
                foreach ($tren_6_bulan as $t) {
                  $rt = ($t['norm_raw'] ?? 0) + ($t['stunt_raw'] ?? 0) + ($t['sangat_raw'] ?? 0);
                  if ($rt > $max_raw)
                    $max_raw = $rt;
                }
                ?>
                <?php foreach ($tren_6_bulan as $t):
                  $nr = $t['norm_raw'] ?? 0;
                  $sr = $t['stunt_raw'] ?? 0;
                  $gr = $t['sangat_raw'] ?? 0;
                  $h_n = $nr > 0 ? max(6, round(($nr / $max_raw) * 130)) : 0;
                  $h_s = $sr > 0 ? max(6, round(($sr / $max_raw) * 130)) : 0;
                  $h_g = $gr > 0 ? max(6, round(($gr / $max_raw) * 130)) : 0;
                  $tot = $nr + $sr + $gr;
                  ?>
                  <div class="bar-group">
                    <?php if ($tot == 0): ?>
                      <div style="flex:1;border-radius:4px 4px 0 0;background:#e2e8f0;height:4px;" title="Belum ada data">
                      </div>
                    <?php else: ?>
                      <?php if ($h_n > 0): ?>
                        <div class="bar blue" style="height:<?= $h_n ?>px;" title="Normal: <?= $nr ?>"></div><?php endif; ?>
                      <?php if ($h_s > 0): ?>
                        <div class="bar amber" style="height:<?= $h_s ?>px;" title="Stunting: <?= $sr ?>"></div>
                      <?php endif; ?>
                      <?php if ($h_g > 0): ?>
                        <div class="bar red" style="height:<?= $h_g ?>px;" title="Sangat Pendek: <?= $gr ?>"></div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="chart-labels">
                <?php foreach ($label_6_bulan as $l): ?>
                  <div class="chart-label"><?= $l ?></div>
                <?php endforeach; ?>
              </div>

            </div>
            <div class="legend">
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--blue-500)"></div>Normal
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--warning)"></div>Stunting
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--danger)"></div>Sangat Pendek
              </div>
            </div>
          </div>

          <div class="card-custom">
            <div class="card-custom-header">
              <div>
                <h5 class="card-custom-title">Pengukuran Terbaru</h5>
                <div class="card-custom-sub">Input terakhir hari ini</div>
              </div>
              <a href="#" class="card-custom-action">Lihat semua</a>
            </div>
            <div class="card-custom-body">
              <div class="balita-list">
                <?php if (empty($pengukuran_terbaru)): ?>
                  <div style="text-align:center; padding: 20px 0; color: var(--text-muted); font-size: 13px;">Belum ada
                    pengukuran terbaru.</div>
                <?php else: ?>
                  <?php foreach ($pengukuran_terbaru as $p): ?>
                    <?php
                    $s = strtolower($p['status_stunting']);
                    $status_class = 'normal';
                    if (strpos($s, 'sangat') !== false || strpos($s, 'severe') !== false)
                      $status_class = 'severe';
                    else if (strpos($s, 'stunting') !== false)
                      $status_class = 'stunting';

                    $jk_label = $p['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki-laki';
                    $avatar_class = $p['jenis_kelamin'] == 'P' ? 'girl' : 'boy';

                    $bday = new DateTime($p['tgl_lahir']);
                    $today = new DateTime('now');
                    $diff = $today->diff($bday);
                    $age = ($diff->y > 0 ? $diff->y . ' thn ' : '') . $diff->m . ' bln';

                    $words = explode(' ', trim($p['nama_lengkap']));
                    $initials = '';
                    foreach (array_slice($words, 0, 2) as $w) {
                      if (!empty($w))
                        $initials .= strtoupper($w[0]);
                    }

                    $ts = strtotime($p['tgl_pengukuran']);
                    $fw = date('Y-m-d', $ts) == date('Y-m-d') ? 'Hari ini' : date('d M Y', $ts);
                    ?>
                    <div class="balita-item">
                      <div class="balita-avatar <?= $avatar_class ?>"><?= $initials ?></div>
                      <div>
                        <div class="balita-name"><?= htmlspecialchars($p['nama_lengkap']) ?></div>
                        <div class="balita-info"><?= $age ?> · <?= $jk_label ?> · Kel.
                          <?= htmlspecialchars($p['nama_kelurahan']) ?>
                        </div>
                      </div>
                      <div class="balita-right">
                        <div class="balita-status <?= $status_class ?>"><?= htmlspecialchars($p['status_stunting']) ?></div>
                        <div class="balita-date"><?= $fw ?></div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- KELURAHAN TABLE -->
        <div class="card-custom">
          <div class="card-custom-header">
            <div>
              <h5 class="card-custom-title">Rekapitulasi per Kelurahan</h5>
              <div class="card-custom-sub"><?= htmlspecialchars($bulan_ini) ?> · Puskesmas
                <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: '') ?>
              </div>
            </div>
            <a href="#" class="card-custom-action">Lihat laporan</a>
          </div>
          <div class="table-responsive">
            <table class="kel-table table table-borderless table-hover mb-0">
              <thead>
                <tr>
                  <th>Kelurahan</th>
                  <th>Total Balita</th>
                  <th>Normal</th>
                  <th>Stunting</th>
                  <th>Sangat Pendek</th>
                  <th>Prevalensi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($rekap_kelurahan)): ?>
                  <tr>
                    <td colspan="6"
                      style="text-align:center; padding: 20px 0; color: var(--text-muted); font-size: 13px;">Tidak ada
                      rekapitulasi kelurahan.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($rekap_kelurahan as $rk): ?>
                    <?php
                    $tb = (int) $rk['total_balita'];
                    $norm = (int) $rk['normal'];
                    $st = (int) $rk['stunting'];
                    $sp = (int) $rk['sangat_pendek'];
                    $stunted_total = $st + $sp;
                    $prevalensi = $tb > 0 ? ($stunted_total / $tb) * 100 : 0;
                    $color = $prevalensi >= 20 ? 'var(--danger)' : 'var(--warning)';
                    if ($prevalensi == 0)
                      $color = 'var(--success)';
                    ?>
                    <tr>
                      <td>
                        <div class="kel-name"><?= htmlspecialchars($rk['nama_kelurahan']) ?></div>
                      </td>
                      <td><?= $tb ?></td>
                      <td><span class="status-badge normal"><?= $norm ?></span></td>
                      <td><span class="status-badge stunting"><?= $st ?></span></td>
                      <td><span class="status-badge severe"><?= $sp ?></span></td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <div class="prog-wrap">
                            <div class="prog-fill" style="background:<?= $color ?>;width:<?= min(100, $prevalensi) ?>%">
                            </div>
                          </div>
                          <span
                            style="font-size:11px;font-weight:600;color:<?= $color ?>"><?= number_format($prevalensi, 1, ',', '.') ?>%</span>
                        </div>
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

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmxc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>
