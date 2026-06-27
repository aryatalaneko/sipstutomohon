<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kelurahan - SIPSTU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap');

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
      --success-light: #ecfdf5;
      --success-dark: #065f46;
      --warning: #f59e0b;
      --warning-light: #fffbeb;
      --warning-dark: #92400e;
      --danger: #ef4444;
      --danger-light: #fef2f2;
      --danger-dark: #991b1b;
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
      justify-content: space-between;
      flex-shrink: 0;
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

    .content {
      flex: 1;
      padding: 24px 28px;
      overflow-y: auto;
      background: var(--surface);
      display: block; /* Force block layout for children */
      position: relative;
    }

    /* FILTER BAR */
    .filter-bar {
      background: white;
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 14px 20px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .filter-label {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-secondary);
      white-space: nowrap;
    }

    .filter-select,
    .filter-input {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 7px 12px;
      font-size: 13px;
      color: var(--text-primary);
      font-family: 'DM Sans', sans-serif;
      background: var(--surface);
      outline: none;
      transition: border-color 0.15s;
    }

    .filter-select:focus,
    .filter-input:focus {
      border-color: var(--blue-400);
      box-shadow: 0 0 0 3px rgba(59, 130, 212, 0.1);
    }

    .filter-input {
      width: 90px;
    }

    .btn-filter {
      background: var(--blue-600);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 7px 18px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s;
    }

    .btn-filter:hover {
      background: var(--blue-700);
    }

    .btn-pdf {
      background: var(--danger);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 7px 18px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s;
      margin-left: auto;
    }

    .btn-pdf:hover {
      background: #dc2626;
    }

    /* REPORT CONTAINER AREA */
    .report-container {
      background: white;
      border-radius: 12px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
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
      padding: 24px 20px;
      text-align: center;
    }

    .summary-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 22px;
      color: var(--blue-900);
      line-height: 1;
      margin-bottom: 6px;
    }

    .summary-lbl {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-secondary);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table-responsive-area {
      padding: 24px;
    }

    .table-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 15px;
      margin-bottom: 4px;
      color: var(--blue-950);
    }

    .table-sub {
      font-size: 12px;
      color: var(--text-muted);
      margin-bottom: 20px;
    }

    .lap-table {
      width: 100%;
      border-collapse: collapse;
    }

    .lap-table th {
      background: #f8fafc;
      padding: 10px 14px;
      font-size: 11px;
      font-weight: 700;
      color: var(--text-secondary);
      text-transform: uppercase;
      letter-spacing: 0.4px;
      border-bottom: 1px solid var(--border);
      text-align: left;
      white-space: nowrap;
    }

    .lap-table th.center {
      text-align: center;
    }

    .lap-table td {
      padding: 10px 14px;
      font-size: 13px;
      border-bottom: 1px solid #f1f5f9;
      color: var(--text-primary);
      vertical-align: middle;
    }

    .lap-table td.center {
      text-align: center;
    }

    .lap-table tr:last-child td {
      border-bottom: none;
    }

    .lap-table tr:hover td {
      background: #f8fafc;
    }

    .lap-table tr.total-row td {
      background: var(--blue-50);
      font-weight: 700;
      border-top: 2px solid var(--blue-200);
      font-size: 13px;
    }

    /* BADGES */
    .badge-status {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      white-space: nowrap;
    }

    .badge-tinggi {
      background: var(--danger-light);
      color: var(--danger-dark);
    }

    .badge-sedang {
      background: var(--warning-light);
      color: var(--warning-dark);
    }

    .badge-aman {
      background: var(--success-light);
      color: var(--success-dark);
    }

    .prev-cell {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 13px;
    }

    .prev-tinggi {
      color: var(--danger);
    }

    .prev-sedang {
      color: var(--warning);
    }

    .prev-aman {
      color: var(--success);
    }

    /* PROGRESS BAR */
    .prog-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      min-width: 100px;
    }

    .prog-bar {
      flex: 1;
      height: 5px;
      background: #e2e8f0;
      border-radius: 3px;
      overflow: hidden;
    }

    .prog-fill {
      height: 100%;
      border-radius: 3px;
      transition: width 0.4s ease;
    }

    /* NO DATA */
    .no-data {
      text-align: center;
      padding: 60px 20px;
      color: var(--text-muted);
    }

    /* ========== PRINT STYLES ========== */
    .print-header {
      display: none;
    }

    .print-footer {
      display: none;
    }

    @media print {
      @page {
        size: A4 landscape;
        margin: 12mm 14mm;
      }

      body {
        overflow: visible !important;
        height: auto !important;
        background: white !important;
      }

      .layout {
        display: block !important;
        height: auto !important;
        overflow: visible !important;
      }

      .sidebar {
        display: none !important;
      }

      .main {
        display: block !important;
        overflow: visible !important;
        height: auto !important;
      }

      .topbar {
        display: none !important;
      }

      .content {
        padding: 0 !important;
        overflow: visible !important;
        height: auto !important;
      }

      .filter-bar {
        display: none !important;
      }

      .btn-pdf {
        display: none !important;
      }

      /* Print Header */
      .print-header {
        display: block !important;
        text-align: center;
        padding-bottom: 12px;
        margin-bottom: 14px;
        border-bottom: 2.5px solid #0f2044;
      }

      .print-logo-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 6px;
      }

      .print-logo-box {
        width: 48px;
        height: 48px;
        background: #1e4080;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 16px;
      }

      .print-title-main {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 16px;
        color: #0f172a;
        letter-spacing: 0.5px;
      }

      .print-title-sub {
        font-size: 11px;
        color: #475569;
        margin-top: 2px;
      }

      .print-period {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        color: #0f172a;
        font-weight: 600;
        margin-top: 4px;
      }

      /* Hide summary cards and simplify structure for formal look */
      .summary-grid {
        display: none !important;
      }

      .table-header {
        border-bottom: 2px solid #0f172a !important;
        padding: 15px 0 !important;
      }

      .table-title {
        font-size: 14pt !important;
        text-transform: uppercase;
        color: #000 !important;
      }

      .table-sub {
        font-size: 11pt !important;
        color: #333 !important;
      }

      .no-print {
        display: none !important;
      }

      /* Table print improvements */
      .table-card {
        border: none !important;
      }

      .lap-table {
        border: 1px solid #000 !important;
        width: 100% !important;
      }

      .lap-table th {
        border: 1px solid #000 !important;
        background: #eee !important;
        color: #000 !important;
        text-transform: none !important;
      }

      .lap-table td {
        border: 1px solid #000 !important;
        color: #000 !important;
      }

      .prog-bar {
        display: none !important;
      }

      /* Hide visual bars in formal print */
      .badge-status {
        padding: 0 !important;
        background: transparent !important;
        color: #000 !important;
        font-weight: 400 !important;
        border: none !important;
      }

      /* Table print */
      .table-card {
        box-shadow: none !important;
        border: 1.5px solid #cbd5e1 !important;
      }

      .table-header {
        padding: 10px 14px !important;
      }

      .lap-table th {
        font-size: 10px !important;
        padding: 8px 10px !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .lap-table td {
        font-size: 11px !important;
        padding: 7px 10px !important;
      }

      .lap-table tr.total-row td {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .badge-status {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        font-size: 10px !important;
      }

      /* Print footer */
      .print-footer {
        display: block !important;
        margin-top: 24px;
        page-break-inside: avoid;
      }

      .print-footer-inner {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      .print-sign-box {
        text-align: center;
      }

      .print-sign-title {
        font-size: 11px;
        color: #475569;
      }

      .print-sign-name {
        font-size: 11px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 56px;
        border-top: 1px solid #475569;
        padding-top: 4px;
        display: inline-block;
        min-width: 180px;
      }

      .print-note {
        font-size: 10px;
        color: #94a3b8;
        margin-bottom: 4px;
      }

      .print-date {
        font-size: 10px;
        color: #475569;
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
            <div class="logo-sub">Kota Tomohon</div>
          </div>
        </div>
      </div>

      <?php if ($this->session->userdata('role') == 'superadmin'): ?>
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
          <a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item active">
            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-width="1.8"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Laporan per Kelurahan
          </a>
          <a href="<?= base_url('welcome/laporan_puskesmas') ?>" class="nav-item">
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

  





      <div class="sidebar-footer">
          <div class="user-card">
            <div class="avatar">SA</div>
            <div>
              <div class="user-name">Super Admin</div>
              <div class="user-role">Dinas Kesehatan</div>
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

      <?php else: ?>
        <!-- PUSKESMAS ADMIN SIDEBAR -->
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
          <a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item active">
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
      <?php endif; ?>
    </aside>

    <!-- MAIN -->
    <div class="main">
      <div class="topbar">
        <div>
          <span class="topbar-title">Laporan Kelurahan</span>
          <span class="topbar-sub">—
            <?= $sel_jenis == 'detail' ? 'Detail per Balita' : 'Rekapitulasi per Kelurahan' ?></span>
        </div>
        <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-muted);">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <?= htmlspecialchars($bulan_ini) ?>
        </div>
      </div>

      <div class="content">

        <!-- PRINT HEADER (only visible when printing) -->
        <div class="print-header">
          <div style="text-align:center;border-bottom:1.5px solid #000;margin-bottom:15px;padding-bottom:10px;">
            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;color:#000;">LAPORAN
              STUNTING (SIPSTU)</div>
            <div style="font-size:12px;color:#333;">Kota Tomohon, Sulawesi Utara</div>
          </div>
          <div class="print-title-main" style="margin-top:20px;"><?= strtoupper($sel_jenis) ?> STUNTING</div>
          <div class="print-title-sub" style="font-size:14px;font-weight:700;">
            <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?>
          </div>
          <div class="print-period">Periode: <?= htmlspecialchars($bulan_ini) ?></div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar no-print">
          <form method="GET" action="<?= base_url('welcome/laporan_kelurahan') ?>" class="row g-2 w-100">
            <div class="col-auto d-flex align-items-center">
              <span class="filter-label">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="margin-right:4px;">
                  <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Bulan:
              </span>
              <select name="bulan" class="filter-select ms-2">
                <?php foreach ($bulan as $i => $b): 
                  $m_val = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                  <option value="<?= $m_val ?>" <?= $sel_m == $m_val ? 'selected' : '' ?>><?= $b ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-auto d-flex align-items-center ms-2">
              <span class="filter-label">Tahun:</span>
              <select name="tahun" class="filter-select ms-2">
                <?php for($y_val = date('Y'); $y_val >= 2020; $y_val--): ?>
                  <option value="<?= $y_val ?>" <?= $sel_y == $y_val ? 'selected' : '' ?>><?= $y_val ?></option>
                <?php endfor; ?>
              </select>
            </div>

            <div class="col-auto d-flex align-items-center ms-2">
              <span class="filter-label">Kelurahan:</span>
              <select name="id_kelurahan" class="filter-select ms-2" style="min-width:140px;">
                <option value="all" <?= $sel_kel == 'all' ? 'selected' : '' ?>>Semua Kelurahan</option>
                <?php foreach ($kelurahan_list_dropdown as $k): ?>
                  <option value="<?= $k['id'] ?>" <?= $sel_kel == $k['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($k['nama_kelurahan']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-auto d-flex align-items-center ms-2">
              <select name="jenis" class="filter-select">
                <option value="rekap" <?= $sel_jenis == 'rekap' ? 'selected' : '' ?>>Rekapitulasi</option>
                <option value="detail" <?= $sel_jenis == 'detail' ? 'selected' : '' ?>>Detail Balita</option>
              </select>
            </div>

            <div class="col-auto ms-2">
              <button type="submit" class="btn-filter">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Tampilkan
              </button>
            </div>

            <div class="col text-end">
              <button type="button" onclick="exportPDF()" class="btn-pdf" id="btnPDF">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                PDF
              </button>
            </div>
          </form>
        </div>

        <?php
        $prev_color_all = $prev_all >= 20 ? 'var(--danger)' : ($prev_all > 0 ? 'var(--warning)' : 'var(--success)');
        $cakupan = $total_terdaftar > 0 ? round(($total_diukur / $total_terdaftar) * 100, 1) : 0;
        ?>

        <!-- REPORT AREA -->
        <div class="report-container">
          <div class="report-header">
            <div class="report-title">LAPORAN PEMANTAUAN STUNTING (SIPSTU)</div>
            <div class="report-sub">
              WILAYAH: <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?> · 
              PERIODE: <?= htmlspecialchars($bulan_ini) ?>
            </div>
          </div>

          <!-- SUMMARY SECTION -->
          <div class="report-summary">
            <div class="summary-item">
              <div class="summary-val" style="color: var(--blue-600);"><?= count($laporan) ?></div>
              <div class="summary-lbl">Total Kelurahan</div>
            </div>
            <div class="summary-item">
              <div class="summary-val" style="color: #0284c7;"><?= $total_diukur ?> <span style="font-size:12px;font-weight:400;color:var(--text-muted);">/ <?= $total_terdaftar ?></span></div>
              <div class="summary-lbl">Balita Diukur (<?= $cakupan ?>%)</div>
            </div>
            <div class="summary-item">
              <div class="summary-val" style="color: var(--warning);"><?= $total_stunted ?></div>
              <div class="summary-lbl">Total Kasus Stunting</div>
            </div>
            <div class="summary-item">
              <div class="summary-val" style="color: <?= $prev_color_all ?>;"><?= number_format($prev_all, 1, ',', '.') ?>%</div>
              <div class="summary-lbl">Prevalensi Wilayah</div>
            </div>
          </div>

          <div class="table-responsive-area">
            <div class="table-title">
              <?= $sel_jenis == 'detail' ? 'Daftar Detail Status Gizi Balita' : 'Rekapitulasi Stunting per Kelurahan' ?>
            </div>
            <div class="table-sub">
              Daftar data pengukuran balita periode <?= htmlspecialchars($bulan_ini) ?>
            </div>

          <?php
          $is_empty = ($sel_jenis == 'detail') ? empty($laporan_detail) : empty($laporan);
          if ($is_empty):
            ?>
            <div class="no-data">
              <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                style="margin-bottom:12px;opacity:0.3;">
                <path
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <div style="font-size:14px;font-weight:600;">Tidak ada data
                <?= $sel_jenis == 'detail' ? 'pengukuran' : '' ?> untuk periode ini
              </div>
              <div style="font-size:12px;margin-top:6px;">Coba pilih bulan/tahun yang berbeda.</div>
            </div>
          <?php else: ?>

            <?php if ($sel_jenis == 'detail'): ?>
              <!-- DETAIL TABLE -->
              <div style="overflow-x:auto;">
                <table class="lap-table">
                  <thead>
                    <tr>
                      <th style="width:36px;" class="center">No</th>
                      <th>Nama Balita</th>
                      <th class="center">JK</th>
                      <th class="center">Umur</th>
                      <th>Kelurahan</th>
                      <th class="center">Tgl Ukur</th>
                      <th class="center">Status Gizi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($laporan_detail as $no => $row):
                      $birthDate = new DateTime($row['tgl_lahir']);
                      $today = new DateTime($row['tgl_pengukuran']);
                      $diff = $birthDate->diff($today);
                      $umur_bulan = ($diff->y * 12) + $diff->m;

                      $stat = strtolower($row['status_stunting']);
                      $badge_cls = 'badge-aman';
                      if (strpos($stat, 'sangat') !== false || strpos($stat, 'severe') !== false)
                        $badge_cls = 'badge-tinggi';
                      else if (strpos($stat, 'stunting') !== false)
                        $badge_cls = 'badge-sedang';
                      ?>
                      <tr>
                        <td class="center" style="color:var(--text-muted);font-size:12px;"><?= $no + 1 ?></td>
                        <td>
                          <div style="font-weight:600;font-size:13px;"><?= htmlspecialchars($row['nama_lengkap']) ?></div>
                        </td>
                        <td class="center"><?= $row['jenis_kelamin'] == 'L' ? 'L' : 'P' ?></td>
                        <?php 
                          $age_formatted = ($diff->y > 0 ? $diff->y . ' Thn ' : '') . $diff->m . ' Bln';
                        ?>
                        <td class="center" style="white-space:nowrap;"><?= $age_formatted ?></td>
                        <td><?= htmlspecialchars($row['nama_kelurahan']) ?></td>
                        <td class="center" style="font-size:12px;"><?= date('d/m/y', strtotime($row['tgl_pengukuran'])) ?>
                        </td>
                        <td class="center">
                          <span class="badge-status <?= $badge_cls ?>">
                            <?= htmlspecialchars($row['status_stunting']) ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <!-- REKAP TABLE -->
              <div style="overflow-x:auto;">
                <table class="lap-table">
                  <thead>
                    <tr>
                      <th style="width:36px;" class="center">No</th>
                      <th>Kelurahan</th>
                      <th>Kecamatan</th>
                      <th class="center">Terdaftar</th>
                      <th class="center">Diukur</th>
                      <th class="center">Normal</th>
                      <th class="center">Stunting</th>
                      <th class="center">Sangat Pendek</th>
                      <th class="center">Total Stunted</th>
                      <th style="min-width:130px;">Prevalensi</th>
                      <th class="center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($laporan as $no => $row):
                      $stunted = $row['jml_stunting'] + $row['jml_sangat'];
                      $prev = $row['prevalensi'];
                      $prev_cls = $prev >= 20 ? 'prev-tinggi' : ($prev > 0 ? 'prev-sedang' : 'prev-aman');
                      $fill_color = $prev >= 20 ? '#ef4444' : ($prev > 0 ? '#f59e0b' : '#10b981');
                      $fill_bg = $prev >= 20 ? '#fecaca' : ($prev > 0 ? '#fde68a' : '#a7f3d0');
                      $badge_cls = 'badge-' . strtolower($row['status']);
                      $cakupan_r = $row['total_terdaftar'] > 0 ? round(($row['total_diukur'] / $row['total_terdaftar']) * 100) : 0;
                      ?>
                      <tr>
                        <td class="center" style="color:var(--text-muted);font-size:12px;"><?= $no + 1 ?></td>
                        <td>
                          <div style="font-weight:600;font-size:13px;"><?= htmlspecialchars($row['nama_kelurahan'] ?? '-') ?>
                          </div>
                        </td>
                        <td style="color:var(--text-secondary);font-size:12px;">
                          <?= htmlspecialchars($row['nama_kecamatan'] ?? '-') ?>
                        </td>
                        <td class="center"><?= $row['total_terdaftar'] ?></td>
                        <td class="center">
                          <?= $row['total_diukur'] ?>
                          <div style="font-size:10px;color:var(--text-muted);">(<?= $cakupan_r ?>%)</div>
                        </td>
                        <td class="center" style="color:var(--success);font-weight:600;"><?= $row['jml_normal'] ?></td>
                        <td class="center" style="color:var(--warning);font-weight:600;"><?= $row['jml_stunting'] ?></td>
                        <td class="center" style="color:var(--danger);font-weight:600;"><?= $row['jml_sangat'] ?></td>
                        <td class="center" style="font-weight:700;"><?= $stunted ?></td>
                        <td>
                          <div class="prog-wrap">
                            <div class="prog-bar">
                              <div class="prog-fill" style="width:<?= min($prev, 100) ?>%;background:<?= $fill_color ?>;">
                              </div>
                            </div>
                            <span class="prev-cell <?= $prev_cls ?>"><?= number_format($prev, 1, ',', '.') ?>%</span>
                          </div>
                        </td>
                        <td class="center">
                          <span class="badge-status <?= $badge_cls ?>">
                            <?= $row['status'] === 'Tinggi' ? '⚠ ' : ($row['status'] === 'Sedang' ? '• ' : '✓ ') ?>
                            <?= $row['status'] ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr class="total-row">
                      <td class="center" colspan="3">TOTAL KESELURUHAN</td>
                      <td class="center"><?= $total_terdaftar ?></td>
                      <td class="center"><?= $total_diukur ?> <span
                          style="font-size:10px;font-weight:400;">(<?= $cakupan ?>%)</span></td>
                      <td class="center" style="color:var(--success);"><?= $total_normal ?></td>
                      <td class="center" style="color:var(--warning);"><?= $total_stunting ?></td>
                      <td class="center" style="color:var(--danger);"><?= $total_sangat ?></td>
                      <td class="center"><?= $total_stunted ?></td>
                      <td><span
                          class="prev-cell <?= $prev_all >= 20 ? 'prev-tinggi' : ($prev_all > 0 ? 'prev-sedang' : 'prev-aman') ?>"><?= number_format($prev_all, 1, ',', '.') ?>%</span>
                      </td>
                      <td class="center">—</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- LEGEND (Hidden in print) -->
              <div class="no-print"
                style="padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:20px;flex-wrap:wrap;align-items:center;">
                <span style="font-size:11px;color:var(--text-muted);font-weight:600;">Keterangan Status:</span>
                <span class="badge-status badge-aman">✓ Aman — prevalensi 0%</span>
                <span class="badge-status badge-sedang">• Sedang — prevalensi 1–19%</span>
                <span class="badge-status badge-tinggi">⚠ Tinggi — prevalensi ≥20%</span>
              </div>
            <?php endif; // end of jenis rekap/detail ?>
          <?php endif; // end of empty check ?>
          </div> <!-- /table-responsive-area -->
        </div> <!-- /report-container -->

        <!-- PRINT FOOTER -->
        <div class="print-footer">
          <div class="print-note">Dicetak dari SIPSTU — Sistem Informasi Pemantauan Stunting Kota Tomohon</div>
          <div class="print-footer-inner">
            <div>
              <div class="print-date">Tanggal cetak: <?= date('d F Y, H:i') ?> WITA</div>
              <div style="margin-top:4px;font-size:10px;color:#94a3b8;">Dokumen ini dibuat secara otomatis oleh sistem
              </div>
            </div>
            <div class="print-sign-box">
              <div class="print-sign-title">Mengetahui, Kepala Puskesmas</div>
              <div class="print-sign-name">
                <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?>
              </div>
            </div>
          </div>
        </div>
</div>

      <!-- FOOTER -->
      <footer class="footer">
        Copyright © 2026 <span>Teknik Elektro</span> - Politeknik Negeri Manado
      </footer>

    </div>
  </div>
      </div><!-- /content -->
    </div><!-- /main -->
  </div><!-- /layout -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function exportPDF() {
      // Brief pulse animation on button
      const btn = document.getElementById('btnPDF');
      btn.textContent = '⏳ Menyiapkan...';
      btn.disabled = true;
      setTimeout(() => {
        window.print();
        btn.innerHTML = '<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> Export PDF';
        btn.disabled = false;
      }, 300);
    }

    // Keyboard shortcut: Ctrl+P already works via browser, but also Ctrl+Shift+E for export
    document.addEventListener('keydown', (e) => {
      if (e.ctrlKey && e.shiftKey && e.key === 'E') {
        e.preventDefault();
        exportPDF();
      }
    });
  </script>
<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>

</html>
