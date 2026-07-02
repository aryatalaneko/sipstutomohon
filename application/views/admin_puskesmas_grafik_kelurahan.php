<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Grafik Stunting per Kelurahan - SIPSTU</title>

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
		}

		/* CARDS */
		.card-chart {
			background: white;
			border-radius: 12px;
			border: 1px solid var(--border);
			overflow: hidden;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
			margin-bottom: 20px;
		}

		.card-chart-header {
			padding: 16px 20px;
			border-bottom: 1px solid var(--border);
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.card-chart-title {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-weight: 700;
			font-size: 14px;
			color: var(--text-primary);
		}

		.card-chart-sub {
			font-size: 11px;
			color: var(--text-muted);
		}

		.card-chart-body {
			padding: 20px;
		}

		/* SUMMARY CARDS */
		.summary-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 16px;
			margin-bottom: 24px;
		}

		.summary-card {
			background: white;
			border-radius: 12px;
			border: 1px solid var(--border);
			padding: 16px 18px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
			transition: all 0.2s;
		}

		.summary-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
		}

		.summary-icon {
			width: 36px;
			height: 36px;
			border-radius: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 10px;
		}

		.summary-value {
			font-family: 'Plus Jakarta Sans', sans-serif;
			font-weight: 700;
			font-size: 22px;
			line-height: 1;
			margin-bottom: 4px;
		}

		.summary-label {
			font-size: 11px;
			color: var(--text-muted);
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.3px;
		}

		/* CHART GRID */
		.chart-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
		}

		@media (max-width: 1200px) {
			.chart-grid {
				grid-template-columns: 1fr;
			}
		}

		@media (max-width: 768px) {
			.summary-grid {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		/* LEGEND */
		.chart-legend {
			display: flex;
			gap: 16px;
			justify-content: center;
			margin-top: 12px;
		}

		.legend-item {
			display: flex;
			align-items: center;
			gap: 5px;
			font-size: 11px;
			color: var(--text-secondary);
			font-weight: 500;
		}

		.legend-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			flex-shrink: 0;
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
							<path stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
						</svg>
						Peta per Puskesmas
					</a>
				</div>

				<div class="sidebar-section">
					<div class="sidebar-label">Analitik</div>
					<a href="<?= base_url('welcome/grafik_kelurahan') ?>" class="nav-item active">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
						</svg>
						Grafik per Kelurahan
					</a>
					<a href="<?= base_url('welcome/grafik_puskesmas') ?>" class="nav-item">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M16 8v8m-4-5v5m-4-2v2M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
						</svg>
						Grafik per Puskesmas
					</a>
				</div>

				<div class="sidebar-section">
					<div class="sidebar-label">Laporan</div>
					<a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
						</svg>
						Laporan per Kelurahan
					</a>
					<a href="<?= base_url('welcome/laporan_puskesmas') ?>" class="nav-item">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
						</svg>
						Laporan per Puskesmas
					</a>
				</div>

				<div class="sidebar-section">
					<div class="sidebar-label">Kelola</div>
					<a href="<?= base_url('puskesmas_admin') ?>" class="nav-item">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
						</svg>
						Manajemen Puskesmas
					</a>
					<a href="<?= base_url('kelurahan_admin') ?>" class="nav-item">
						<svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
					<a href="<?= base_url('auth/logout') ?>" class="nav-item text-danger mt-2" style="background: rgba(239, 68, 68, 0.1);">
						<svg class="icon text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
					$ci = &get_instance();
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
					<a href="<?= base_url('welcome/grafik_kelurahan') ?>" class="nav-item active">
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
			<?php endif; ?>
		</aside>
		</aside>

		<!-- MAIN -->
		<div class="main">
			<div class="topbar">
				<div style="display: flex; align-items: center; gap: 12px;">
					<span class="topbar-title">Grafik Stunting per Kelurahan</span>
					<span class="topbar-sub">— 6 Bulan Terakhir</span>
				</div>
				<div style="margin-left: auto; display: flex; align-items: center; gap: 8px;">
					<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="2">
						<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
					</svg>
					<select onchange="filterGrafik(this.value)" style="border: 1px solid var(--border); background: var(--surface); border-radius: 8px; padding: 6px 12px; font-size: 12px; color: var(--text-secondary); cursor: pointer; font-family: 'DM Sans', sans-serif; outline: none;">
						<?php foreach ($bulan_list as $bl): ?>
							<option value="<?= $bl['bulan'] ?>-<?= $bl['tahun'] ?>"
								<?= ((int)$bl['bulan'] == (int)$sel_m && (int)$bl['tahun'] == (int)$sel_y) ? 'selected' : '' ?>>
								<?= $bl['label'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="content">

				<?php
				// Calculate current month summary totals
				$cur_total = end($overall['total']);
				$cur_normal = end($overall['normal']);
				$cur_stunting = end($overall['stunting']);
				$cur_sangat = end($overall['sangat_pendek']);
				$prev_total = $overall['total'][4] ?? 0;
				$prev_stunted = ($overall['stunting'][4] ?? 0) + ($overall['sangat_pendek'][4] ?? 0);
				$cur_stunted = $cur_stunting + $cur_sangat;
				$prevalensi = $cur_total > 0 ? round(($cur_stunted / $cur_total) * 100, 1) : 0;
				?>

				<!-- SUMMARY CARDS -->
				<div class="summary-grid">
					<div class="summary-card">
						<div class="summary-icon" style="background: var(--blue-50);">
							<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="var(--blue-600)" stroke-width="2">
								<path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
						</div>
						<div class="summary-value" style="color: var(--blue-600);"><?= $cur_total ?></div>
						<div class="summary-label">Total Terukur</div>
					</div>
					<div class="summary-card">
						<div class="summary-icon" style="background: #ecfdf5;">
							<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="var(--success)" stroke-width="2">
								<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</div>
						<div class="summary-value" style="color: var(--success);"><?= $cur_normal ?></div>
						<div class="summary-label">Normal</div>
					</div>
					<div class="summary-card">
						<div class="summary-icon" style="background: #fffbeb;">
							<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="var(--warning)" stroke-width="2">
								<path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
							</svg>
						</div>
						<div class="summary-value" style="color: var(--warning);"><?= $cur_stunting ?></div>
						<div class="summary-label">Stunting</div>
					</div>
					<div class="summary-card">
						<div class="summary-icon" style="background: #fef2f2;">
							<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="var(--danger)" stroke-width="2">
								<path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</div>
						<div class="summary-value" style="color: var(--danger);"><?= $cur_sangat ?></div>
						<div class="summary-label">Sangat Pendek</div>
					</div>
				</div>

				<!-- OVERALL TREND CHART (full width) -->
				<div class="card-chart">
					<div class="card-chart-header">
						<div>
							<div class="card-chart-title">Tren Keseluruhan — 6 Bulan Terakhir</div>
							<div class="card-chart-sub">Seluruh kelurahan di wilayah <?= htmlspecialchars($this->session->userdata('nama_puskesmas') ?: 'Puskesmas') ?></div>
						</div>
						<div style="display: flex; align-items: center; gap: 8px;">
							<span style="font-size: 11px; color: var(--text-muted);">Prevalensi Bulan Ini</span>
							<span style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: <?= $prevalensi >= 20 ? 'var(--danger)' : ($prevalensi > 0 ? 'var(--warning)' : 'var(--success)') ?>;"><?= number_format($prevalensi, 1, ',', '.') ?>%</span>
						</div>
					</div>
					<div class="card-chart-body">
						<canvas id="overallChart" height="85"></canvas>
						<div class="chart-legend">
							<div class="legend-item">
								<div class="legend-dot" style="background: #10b981;"></div>Normal
							</div>
							<div class="legend-item">
								<div class="legend-dot" style="background: #f59e0b;"></div>Stunting
							</div>
							<div class="legend-item">
								<div class="legend-dot" style="background: #ef4444;"></div>Sangat Pendek
							</div>
						</div>
					</div>
				</div>

				<!-- PER-KELURAHAN CHARTS -->
				<?php if (!empty($grafik)): ?>
					<div style="margin-bottom: 16px; display: flex; align-items: center; gap: 10px;">
						<div style="width: 32px; height: 32px; background: var(--blue-50); color: var(--blue-600); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
							<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
							</svg>
						</div>
						<div>
							<h4 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; margin: 0; font-size: 15px;">Detail per Kelurahan</h4>
							<p style="font-size: 11px; color: var(--text-muted); margin: 0;"><?= count($grafik) ?> kelurahan dalam wilayah ini</p>
						</div>
					</div>

					<div class="chart-grid">
						<?php foreach ($grafik as $idx => $g):
							$last_total = end($g['total']);
							$last_stunted = end($g['stunting']) + end($g['sangat_pendek']);
							$kel_prev = $last_total > 0 ? round(($last_stunted / $last_total) * 100, 1) : 0;
							$prev_color = $kel_prev >= 20 ? 'var(--danger)' : ($kel_prev > 0 ? 'var(--warning)' : 'var(--success)');
						?>
							<div class="card-chart">
								<div class="card-chart-header">
									<div>
										<div class="card-chart-title"><?= htmlspecialchars($g['nama']) ?></div>
										<div class="card-chart-sub"><?= $last_total ?> balita terukur bulan ini</div>
									</div>
									<div style="text-align: right;">
										<div style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Prevalensi</div>
										<div style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: <?= $prev_color ?>;"><?= number_format($kel_prev, 1, ',', '.') ?>%</div>
									</div>
								</div>
								<div class="card-chart-body" style="padding: 16px 20px;">
									<canvas id="kelChart<?= $idx ?>" height="90"></canvas>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else: ?>
					<div class="card-chart">
						<div style="text-align: center; padding: 60px 20px; color: var(--text-muted);">
							<svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 12px; opacity: 0.4;">
								<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
							</svg>
							<div style="font-size: 14px; font-weight: 600;">Belum ada data grafik</div>
							<div style="font-size: 12px; margin-top: 4px;">Data akan ditampilkan setelah ada pengukuran balita.</div>
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
	<script>
		const labels = <?= json_encode($labels) ?>;
		const overall = <?= json_encode($overall) ?>;
		const grafik = <?= json_encode($grafik) ?>;

		const chartDefaults = {
			responsive: true,
			maintainAspectRatio: true,
			plugins: {
				legend: {
					display: false
				},
				tooltip: {
					backgroundColor: '#0f172a',
					titleFont: {
						family: "'Plus Jakarta Sans', sans-serif",
						weight: '600',
						size: 12
					},
					bodyFont: {
						family: "'DM Sans', sans-serif",
						size: 11
					},
					padding: 10,
					cornerRadius: 8,
					boxPadding: 4,
					callbacks: {
						afterBody: function(ctx) {
							const idx = ctx[0].dataIndex;
							const ds = ctx[0].chart.data.datasets;
							const total = ds.reduce((s, d) => s + d.data[idx], 0);
							return total > 0 ? `Total: ${total} balita` : '';
						}
					}
				}
			},
			scales: {
				x: {
					grid: {
						display: false
					},
					ticks: {
						font: {
							family: "'DM Sans', sans-serif",
							size: 11
						},
						color: '#94a3b8'
					}
				},
				y: {
					beginAtZero: true,
					ticks: {
						stepSize: 1,
						font: {
							family: "'DM Sans', sans-serif",
							size: 11
						},
						color: '#94a3b8'
					},
					grid: {
						color: '#f1f5f9'
					}
				}
			}
		};

		function makeDatasets(normalData, stuntingData, sangatData) {
			return [{
					label: 'Normal',
					data: normalData,
					backgroundColor: 'rgba(16, 185, 129, 0.15)',
					borderColor: '#10b981',
					borderWidth: 2,
					pointBackgroundColor: '#10b981',
					pointRadius: 4,
					pointHoverRadius: 6,
					tension: 0.35,
					fill: true,
					order: 3
				},
				{
					label: 'Stunting',
					data: stuntingData,
					backgroundColor: 'rgba(245, 158, 11, 0.15)',
					borderColor: '#f59e0b',
					borderWidth: 2,
					pointBackgroundColor: '#f59e0b',
					pointRadius: 4,
					pointHoverRadius: 6,
					tension: 0.35,
					fill: true,
					order: 2
				},
				{
					label: 'Sangat Pendek',
					data: sangatData,
					backgroundColor: 'rgba(239, 68, 68, 0.15)',
					borderColor: '#ef4444',
					borderWidth: 2,
					pointBackgroundColor: '#ef4444',
					pointRadius: 4,
					pointHoverRadius: 6,
					tension: 0.35,
					fill: true,
					order: 1
				}
			];
		}

		// Overall Chart
		new Chart(document.getElementById('overallChart'), {
			type: 'line',
			data: {
				labels: labels,
				datasets: makeDatasets(overall.normal, overall.stunting, overall.sangat_pendek)
			},
			options: chartDefaults
		});

		// Per-kelurahan charts
		grafik.forEach((g, idx) => {
			const el = document.getElementById('kelChart' + idx);
			if (!el) return;
			new Chart(el, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [{
							label: 'Normal',
							data: g.normal,
							backgroundColor: '#10b981',
							borderRadius: 4,
							barPercentage: 0.6,
							categoryPercentage: 0.7
						},
						{
							label: 'Stunting',
							data: g.stunting,
							backgroundColor: '#f59e0b',
							borderRadius: 4,
							barPercentage: 0.6,
							categoryPercentage: 0.7
						},
						{
							label: 'Sangat Pendek',
							data: g.sangat_pendek,
							backgroundColor: '#ef4444',
							borderRadius: 4,
							barPercentage: 0.6,
							categoryPercentage: 0.7
						}
					]
				},
				options: {
					...chartDefaults,
					plugins: {
						...chartDefaults.plugins,
						tooltip: {
							...chartDefaults.plugins.tooltip,
							mode: 'index',
							intersect: false,
						}
					},
					scales: {
						...chartDefaults.scales,
						x: {
							...chartDefaults.scales.x,
							stacked: true
						},
						y: {
							...chartDefaults.scales.y,
							stacked: true
						}
					}
				}
			});
		});
	</script>
	<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
	<script>
		function filterGrafik(val) {
			if (!val) return;
			const parts = val.split('-');
			if (parts.length === 2) {
				const baseUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
				window.location.href = baseUrl + '?bulan=' + parts[0] + '&tahun=' + parts[1];
			}
		}
	</script>
</body>

</html>
