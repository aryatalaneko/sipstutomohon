<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIPSTU - Super Admin Dashboard</title>

	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
			--accent: #f59e0b;
			--danger: #ef4444;
			--success: #10b981;
			--warning: #f59e0b;
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
			min-height: 100vh;
			overflow-x: hidden;
		}

		.layout {
			display: flex;
			min-height: 100vh;
			width: 100%;
			overflow-x: hidden;
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
			letter-spacing: -0.5px;
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
			font-weight: 400;
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
			opacity: 0.8;
			flex-shrink: 0;
		}

		.nav-badge {
			margin-left: auto;
			background: var(--blue-500);
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
			color: var(--text-primary);
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

		.btn-notif {
			width: 36px;
			height: 36px;
			border-radius: 8px;
			border: 1px solid var(--border);
			background: white;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			position: relative;
		}

		.notif-dot {
			position: absolute;
			top: 7px;
			right: 7px;
			width: 7px;
			height: 7px;
			background: var(--danger);
			border-radius: 50%;
			border: 1.5px solid white;
		}

		/* CONTENT */
		.content {
			flex: 1;
			padding: 24px 28px;
			overflow-y: auto;
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
			padding: 20px;
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
			margin-bottom: 12px;
		}

		.stat-label {
			font-size: 11px;
			font-weight: 600;
			color: var(--text-muted);
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.stat-icon {
			width: 32px;
			height: 32px;
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
			font-size: 28px;
			color: var(--text-primary);
			line-height: 1;
		}

		.stat-change {
			display: flex;
			align-items: center;
			gap: 4px;
			margin-top: 8px;
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

		/* GRID 2 COL */
		.grid-2 {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 16px;
			margin-bottom: 24px;
		}

		.grid-3-1 {
			display: grid;
			grid-template-columns: 2fr 1fr;
			gap: 16px;
			margin-bottom: 16px;
		}

		/* CARD */
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

		/* CHART PLACEHOLDER */
		.chart-area {
			height: 180px;
			display: flex;
			align-items: flex-end;
			gap: 6px;
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
			min-width: 6px;
			transition: opacity 0.2s;
			cursor: pointer;
		}

		.bar:hover {
			opacity: 0.75;
		}

		.bar.blue {
			background: var(--blue-500);
		}

		.bar.green {
			background: var(--success);
		}

		.bar.red {
			background: var(--danger);
		}

		.chart-labels {
			display: flex;
			gap: 6px;
			padding: 8px 4px 0;
		}

		.chart-label {
			flex: 1;
			text-align: center;
			font-size: 10px;
			color: var(--text-muted);
		}

		/* LEGEND */
		.legend {
			display: flex;
			gap: 16px;
			padding: 12px 20px;
			border-top: 1px solid var(--border);
		}

		.legend-item {
			display: flex;
			align-items: center;
			gap: 6px;
			font-size: 11px;
			color: var(--text-secondary);
		}

		.legend-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
		}

		/* PUSKESMAS TABLE */
		.pk-table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 0;
		}

		.pk-table th {
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

		.pk-table td {
			padding: 12px 16px;
			font-size: 12px;
			color: var(--text-secondary);
			border-bottom: 1px solid var(--border);
			vertical-align: middle;
		}

		.pk-table tr:last-child td {
			border-bottom: none;
		}

		.pk-table tr:hover td {
			background: var(--surface);
		}

		.pk-name {
			font-weight: 600;
			color: var(--text-primary);
			font-size: 13px;
		}

		.pk-sub {
			font-size: 11px;
			color: var(--text-muted);
		}

		/* STATUS BADGE */
		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: 4px;
			padding: 3px 8px;
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

		/* PROGRESS BAR */
		.prog-wrap {
			flex: 1;
			height: 6px;
			background: var(--border);
			border-radius: 3px;
			overflow: hidden;
		}

		.prog-fill {
			height: 100%;
			border-radius: 3px;
		}

		/* MINI DONUT via conic */
		.donut-wrap {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 24px;
			padding: 16px 0;
		}

		.donut {
			width: 140px;
			height: 140px;
			border-radius: 50%;
			flex-shrink: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
		}

		.donut::after {
			content: '';
			position: absolute;
			width: 95px;
			height: 95px;
			background: white;
			border-radius: 50%;
		}

		.donut-center {
			position: absolute;
			z-index: 1;
			text-align: center;
		}

		.donut-pct {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-weight: 700;
			font-size: 24px;
			color: var(--text-primary);
			line-height: 1.1;
		}

		.donut-lbl {
			font-size: 11px;
			color: var(--text-muted);
			text-transform: uppercase;
			letter-spacing: 0.5px;
			font-weight: 600;
		}

		.donut-legend {
			width: 100%;
			display: flex;
			flex-direction: column;
			gap: 10px;
		}

		.donut-row {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 8px 12px;
			background: var(--surface);
			border-radius: 8px;
			border: 1px solid var(--border);
		}

		.donut-label {
			font-size: 11px;
			color: var(--text-secondary);
			flex: 1;
		}

		.donut-val {
			font-size: 11px;
			font-weight: 600;
			color: var(--text-primary);
		}

		/* ALERT */
		.alert-list {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.alert-item-custom {
			display: flex;
			align-items: flex-start;
			gap: 10px;
			padding: 10px 12px;
			border-radius: 8px;
			background: var(--surface);
			border: 1px solid var(--border);
			cursor: pointer;
		}

		.alert-item-custom:hover {
			border-color: var(--blue-300);
		}

		.alert-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			margin-top: 4px;
			flex-shrink: 0;
		}

		.alert-text {
			font-size: 12px;
			color: var(--text-secondary);
			line-height: 1.5;
			margin-bottom: 0;
		}

		.alert-bold {
			font-weight: 600;
			color: var(--text-primary);
		}

		.alert-time {
			font-size: 10px;
			color: var(--text-muted);
			margin-top: 2px;
		}

		/* Extra fixes for bootstrap interference */
		a {
			text-decoration: none;
		}

		p {
			margin-bottom: 0;
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

		/* ===== RESPONSIVE ===== */

		/* Tablet (≤992px) */
		@media (max-width: 992px) {
			.sidebar {
				width: 200px;
			}

			.stats-grid {
				grid-template-columns: repeat(2, 1fr);
			}

			.grid-3-1 {
				grid-template-columns: 1fr;
			}

			.grid-2 {
				grid-template-columns: 1fr;
			}
		}

		/* Mobile (≤768px) */
		@media (max-width: 768px) {
			.sidebar {
				position: fixed;
				left: -240px;
				top: 0;
				height: 100%;
				z-index: 1050;
				width: 240px;
				transition: left 0.25s ease;
				overflow-y: auto;
			}

			.sidebar.open {
				left: 0;
			}

			.sidebar-overlay {
				display: none;
				position: fixed;
				inset: 0;
				background: rgba(0, 0, 0, 0.45);
				z-index: 1040;
			}

			.sidebar-overlay.show {
				display: block;
			}

			.main {
				width: 100%;
			}

			.topbar {
				padding: 0 16px;
			}

			.content {
				padding: 16px;
			}

			.stats-grid {
				grid-template-columns: repeat(2, 1fr);
				gap: 12px;
			}

			.stat-value {
				font-size: 22px;
			}

			.grid-3-1,
			.grid-2 {
				grid-template-columns: 1fr;
			}

			.topbar-right .period-select {
				display: none;
			}
		}

		/* Small phone (≤480px) */
		@media (max-width: 480px) {
			.stats-grid {
				grid-template-columns: 1fr 1fr;
				gap: 10px;
			}

			.stat-card {
				padding: 14px;
			}

			.stat-value {
				font-size: 20px;
			}

			.topbar-title {
				font-size: 14px;
			}

			.topbar-sub {
				display: none;
			}
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
            <div class="logo-sub">Dinkes Kota Tomohon</div>
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
        <a href="<?= base_url('akun') ?>" class="nav-item active">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Pengaturan Akun
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
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main">
      <!-- TOPBAR -->
      <div class="topbar">
        <div>
          <span class="topbar-title">Pengaturan Akun</span>
          <span class="topbar-sub">— Kelola profil dan keamanan akun</span>
        </div>
      </div>

      <!-- CONTENT -->
      <div class="content">

        <!-- ALERTS -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 13px;">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 13px;">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
            </div>
        <?php endif; ?>

        <div class="grid-2">
            <div class="card-custom">
                <div class="card-custom-header">
                    <div>
                        <h5 class="card-custom-title">Ubah Password</h5>
                        <div class="card-custom-sub">Pastikan password baru Anda aman.</div>
                    </div>
                </div>
                <div class="card-custom-body">
                    <form action="<?= base_url('akun/update_password') ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 500; color: var(--text-secondary);">Password Lama</label>
                            <input type="password" name="old_password" class="form-control" style="font-size: 13px; padding: 10px 14px; border-radius: 8px;" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 500; color: var(--text-secondary);">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" style="font-size: 13px; padding: 10px 14px; border-radius: 8px;" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" style="font-size: 12px; font-weight: 500; color: var(--text-secondary);">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" class="form-control" style="font-size: 13px; padding: 10px 14px; border-radius: 8px;" required>
                        </div>
                        <button type="submit" class="btn w-100" style="background: var(--blue-600); color: white; border: none; padding: 10px; font-size: 13px; font-weight: 600; border-radius: 8px;">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
            
            <div class="card-custom">
                 <div class="card-custom-header">
                    <div>
                        <h5 class="card-custom-title">Informasi Akun</h5>
                        <div class="card-custom-sub">Detail profil super admin</div>
                    </div>
                </div>
                <div class="card-custom-body">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--blue-100); color: var(--blue-700); display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 20px;">
                            SA
                        </div>
                        <div>
                            <div style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: var(--text-primary);">Super Admin</div>
                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">Dinas Kesehatan Kota Tomohon</div>
                        </div>
                    </div>
                    
                    <div style="border-top: 1px solid var(--border); padding-top: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 13px;">
                            <span style="color: var(--text-secondary);">Username</span>
                            <span style="font-weight: 600; color: var(--text-primary);"><?= $user['username'] ?? 'superadmin' ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span style="color: var(--text-secondary);">Hak Akses</span>
                            <span style="font-weight: 600; color: var(--text-primary); display: flex; align-items: center; gap: 6px;">
                                <div style="width: 6px; height: 6px; border-radius: 50%; background: var(--success);"></div>
                                <?= $user['role'] ?? 'Super Admin' ?>
                            </span>
                        </div>
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
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>

</html>
