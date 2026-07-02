<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Puskesmas - SIPSTU</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
    .sidebar::before { content: ''; position: absolute; top: -60px; right: -60px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(37,99,168,0.4) 0%, transparent 70%); pointer-events: none; }
    .sidebar-logo { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); }
    .logo-badge { display: inline-flex; align-items: center; gap: 10px; }
    .logo-icon { width: 34px; height: 34px; background: var(--blue-500); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: white; }
    .logo-text { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 15px; color: white; line-height: 1.2; }
    .logo-sub { font-size: 10px; color: rgba(255,255,255,0.4); }
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
    .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
    .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 28px; height: 60px; display: flex; align-items: center;  gap: 16px; justify-content: flex-start; flex-shrink: 0; }
    .topbar-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; }
    .topbar-sub { font-size: 12px; color: var(--text-muted); margin-left: 4px; }
    .content { flex: 1; display: flex; overflow: hidden; }

    /* MAP */
    #map { flex: 1; z-index: 1; }
    
    /* SIDE PANEL */
    .map-panel { width: 340px; background: white; border-left: 1px solid var(--border); display: flex; flex-direction: column; overflow: hidden; flex-shrink: 0; }
    .panel-header { padding: 18px 20px; border-bottom: 1px solid var(--border); }
    .panel-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 14px; color: var(--text-primary); margin-bottom: 2px; }
    .panel-sub { font-size: 11px; color: var(--text-muted); }
    .panel-body { flex: 1; overflow-y: auto; padding: 12px; }

    /* LEGEND */
    .map-legend { padding: 12px 20px; border-bottom: 1px solid var(--border); display: flex; gap: 14px; flex-wrap: wrap; }
    .legend-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: var(--text-secondary); }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* PK CARD */
    .pk-card { background: var(--surface); border: 1px solid var(--border); border-radius: 10px; padding: 12px 14px; margin-bottom: 8px; cursor: pointer; transition: all 0.2s; }
    .pk-card:hover { border-color: var(--blue-300); background: var(--blue-50); transform: translateX(2px); }
    .pk-card.active { border-color: var(--blue-500); background: var(--blue-50); box-shadow: 0 0 0 2px rgba(59,130,212,0.15); }
    .pk-card-name { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
    .pk-card-addr { font-size: 11px; color: var(--text-muted); margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .pk-card-stats { display: flex; gap: 6px; }
    .pk-stat { flex: 1; background: white; border-radius: 6px; padding: 6px 8px; text-align: center; border: 1px solid var(--border); }
    .pk-stat-val { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 14px; }
    .pk-stat-lbl { font-size: 9px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600; }
    .pk-stat.normal .pk-stat-val { color: var(--success); }
    .pk-stat.stunting .pk-stat-val { color: var(--warning); }
    .pk-stat.severe .pk-stat-val { color: var(--danger); }
    .pk-stat.total .pk-stat-val { color: var(--blue-600); }

    /* PREVALENSI BAR */
    .prevalensi-bar { margin-top: 8px; }
    .prev-bar-wrap { height: 4px; background: #e2e8f0; border-radius: 3px; overflow: hidden; display: flex; }
    .prev-bar-fill { height: 100%; transition: width 0.3s; }
    .prev-info { display: flex; justify-content: space-between; margin-top: 4px; }
    .prev-label { font-size: 10px; color: var(--text-muted); }
    .prev-value { font-size: 10px; font-weight: 600; }

    /* Custom Leaflet popup */
    .leaflet-popup-content-wrapper { border-radius: 12px !important; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border: 1px solid var(--border) !important; padding: 0 !important; }
    .leaflet-popup-content { margin: 0 !important; min-width: 220px; }
    .leaflet-popup-tip { box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important; }
    .popup-inner { padding: 14px 16px; }
    .popup-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 14px; color: var(--text-primary); margin-bottom: 2px; }
    .popup-addr { font-size: 11px; color: var(--text-muted); margin-bottom: 10px; line-height: 1.4; }
    .popup-stats { display: flex; gap: 8px; }
    .popup-stat { text-align: center; flex: 1; }
    .popup-stat-val { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; }
    .popup-stat-lbl { font-size: 9px; color: var(--text-muted); text-transform: uppercase; font-weight: 600; }
    .popup-stat.normal .popup-stat-val { color: var(--success); }
    .popup-stat.stunting .popup-stat-val { color: var(--warning); }
    .popup-stat.severe .popup-stat-val { color: var(--danger); }
    .popup-prev { margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .popup-prev-label { font-size: 11px; color: var(--text-secondary); }
    .popup-prev-badge { font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 6px; }
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
          <div class="logo-sub">Dinkes Kota Tomohon</div>
        </div>
      </div>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Utama</div>
      <a href="<?= base_url() ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="1.8"/><rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="1.8"/><rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="1.8"/><rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="1.8"/></svg>
        Dashboard
      </a>
<a href="<?= base_url('welcome/peta_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5" stroke-width="1.8"/></svg>
        Peta per Kelurahan
      </a>
      <a href="<?= base_url('welcome/peta_puskesmas') ?>" class="nav-item active">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
        Peta per Puskesmas
      </a>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Analitik</div>
      <a href="<?= base_url('welcome/grafik_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Grafik per Kelurahan
      </a>
      <a href="<?= base_url('welcome/grafik_puskesmas') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M16 8v8m-4-5v5m-4-2v2M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Grafik per Puskesmas
      </a>
      </div>

      <div class="sidebar-section">
      <div class="sidebar-label">Laporan</div>
      <a href="<?= base_url('welcome/laporan_kelurahan') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Laporan per Kelurahan
      </a>
      <a href="<?= base_url('welcome/laporan_puskesmas') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Laporan per Puskesmas
      </a>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Kelola</div>
      <a href="<?= base_url('puskesmas_admin') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        Manajemen Puskesmas
      </a>
      <a href="<?= base_url('kelurahan_admin') ?>" class="nav-item">
        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
        <svg class="icon text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        Keluar
      </a>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <div>
        <span class="topbar-title">Peta Puskesmas</span>
        <span class="topbar-sub">— Sebaran Stunting Kawasan Puskesmas </span>
      </div>
      <div style="display: flex; align-items: center; gap: 10px;">
  <!-- FILTER BULAN -->
  <form method="GET" action="<?= base_url('welcome/peta_puskesmas') ?>" style="display:flex; align-items:center; gap:8px;">
    <select name="bulan" onchange="this.form.submit()"
      style="border: 1px solid var(--border); border-radius: 8px; padding: 7px 12px; font-size: 12px; color: var(--text-secondary); background: var(--surface); cursor: pointer; font-family: 'DM Sans', sans-serif; outline: none;">
      <?php foreach($bulan_list as $bl): ?>
        <option value="<?= $bl['bulan'] ?>" data-tahun="<?= $bl['tahun'] ?>"
          <?= ((int)$bl['bulan'] == (int)$sel_m && (int)$bl['tahun'] == (int)$sel_y) ? 'selected' : '' ?>>
          <?= $bl['label'] ?>
        </option>
      <?php endforeach; ?>
    </select>
    <input type="hidden" name="tahun" id="tahun-input" value="<?= $sel_y ?>">
  </form>

  <button onclick="resetMapView()"
    style="background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 7px 14px; font-size: 12px; color: var(--text-secondary); cursor: pointer; font-family: 'DM Sans', sans-serif; display: flex; align-items: center; gap: 5px; transition: all 0.15s;"
    onmouseover="this.style.borderColor='var(--blue-400)'"
    onmouseout="this.style.borderColor='var(--border)'">
    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
    Reset Peta
  </button>
</div>
    </div>

    <div class="content map-content-layout">
      <!-- MAP -->
      <div id="map"></div>

      <!-- SIDE PANEL -->
      <div class="map-panel">
        <div class="panel-header">
          <div class="panel-title">Rekapitulasi Puskesmas</div>
          <div class="panel-sub"><?= htmlspecialchars($bulan_ini) ?> · <?= count($puskesmas_data) ?> puskesmas</div>
        </div>
        <div class="map-legend">
          <div class="legend-item"><div class="legend-dot" style="background: var(--success);"></div>Normal</div>
          <div class="legend-item"><div class="legend-dot" style="background: var(--warning);"></div> Gejala Stunting</div>
          <div class="legend-item"><div class="legend-dot" style="background: var(--danger);"></div>Sangat Pendek</div>
        </div>
        <div class="panel-body">
          <?php if(empty($puskesmas_data)): ?>
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
              <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 10px; opacity: 0.5;"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
              <div style="font-size: 13px; font-weight: 600;">Belum ada data</div>
              <div style="font-size: 11px; margin-top: 4px;">Data puskesmas akan muncul setelah koordinat diatur.</div>
            </div>
          <?php else: ?>
            <?php foreach($puskesmas_data as $pk):
              $total = (int)($pk['total_balita'] ?? 0);
              $normal = (int)($pk['normal'] ?? 0);
              $stunting = (int)($pk['stunting'] ?? 0);
              $sangat = (int)($pk['sangat_pendek'] ?? 0);
              $stunted_total = $stunting + $sangat;
              $prevalensi = $total > 0 ? ($stunted_total / $total) * 100 : 0;
              $prev_color = $prevalensi >= 20 ? 'var(--danger)' : ($prevalensi > 0 ? 'var(--warning)' : 'var(--success)');
            ?>
            <div class="pk-card" data-id="<?= $pk['id'] ?>" onclick="focusPuskesmas(<?= $pk['id'] ?>)">
              <div class="pk-card-name"><?= htmlspecialchars($pk['nama_puskesmas'] ?? '') ?></div>
              <div class="pk-card-addr"><?= htmlspecialchars($pk['alamat'] ?? 'Alamat belum diatur') ?></div>
              <div class="pk-card-stats">
                <div class="pk-stat total">
                  <div class="pk-stat-val"><?= $total ?></div>
                  <div class="pk-stat-lbl">Total</div>
                </div>
                <div class="pk-stat normal">
                  <div class="pk-stat-val"><?= $normal ?></div>
                  <div class="pk-stat-lbl">Normal</div>
                </div>
                <div class="pk-stat stunting">
                  <div class="pk-stat-val"><?= $stunting ?></div>
                  <div class="pk-stat-lbl">Stunting</div>
                </div>
                <div class="pk-stat severe">
                  <div class="pk-stat-val"><?= $sangat ?></div>
                  <div class="pk-stat-lbl">S. Pendek</div>
                </div>
              </div>
              <div class="prevalensi-bar">
                <div class="prev-bar-wrap">
                  <?php if($total > 0): ?>
                  <div class="prev-bar-fill" style="width: <?= round(($normal/$total)*100) ?>%; background: var(--success);"></div>
                  <div class="prev-bar-fill" style="width: <?= round(($stunting/$total)*100) ?>%; background: var(--warning);"></div>
                  <div class="prev-bar-fill" style="width: <?= round(($sangat/$total)*100) ?>%; background: var(--danger);"></div>
                  <?php endif; ?>
                </div>
                <div class="prev-info">
                  <span class="prev-label">Prevalensi Stunting</span>
                  <span class="prev-value" style="color: <?= $prev_color ?>"><?= number_format($prevalensi, 1, ',', '.') ?>%</span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  // Puskesmas data from PHP
  const puskesmasData = <?= json_encode($puskesmas_data) ?>;

  // Center on Tomohon
  const map = L.map('map', {
    zoomControl: false
  }).setView([1.3165, 124.8300], 13);

  // Define Base Layers
  const osmStandard = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  });

  const outdoors = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  maxZoom: 19,
  attribution: '&copy; Esri'
}); 


 const standardLight = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    attribution: '&copy; Google Maps'
});
  // Set default layer
  osmStandard.addTo(map);

  // Add Layer Control
  const baseLayers = {
    "Peta Standar": osmStandard,
    "Outdoors": outdoors,
		"Street View (Light)": standardLight
  };
  L.control.layers(baseLayers, null, { position: 'topright' }).addTo(map);

  // Add zoom control
  L.control.zoom({ position: 'topright' }).addTo(map);

  // Custom Puskesmas symbol icon
  function createPuskesmasIcon() {
    return L.divIcon({
      className: 'custom-marker',
      html: `
        <div style="position:relative;">
          <div style="width:52px;height:52px;border-radius:12px;background:#FFFFFF;border:4px solid var(--blue-600);display:flex;align-items:center;justify-content:center;box-shadow:0 10px 20px rgba(0,0,0,0.15), 0 0 0 4px rgba(37,99,168,0.1);transition:transform 0.2s;cursor:pointer;" 
               onmouseover="this.style.transform='scale(1.15)'" 
               onmouseout="this.style.transform='scale(1)'">
            <!-- PUSKESMAS SYMBOL: Building with Plus -->
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19 21V5C19 3.89543 18.1046 3 17 3H7C5.89543 3 5 3.89543 5 5V21" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M3 21H21" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9 12H15M12 9V15" stroke="var(--danger)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div style="position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:12px solid var(--blue-600);"></div>
        </div>
      `,
      iconSize: [52, 62],
      iconAnchor: [26, 62],
      popupAnchor: [0, -62]
    });
  }

  // Store markers for focusing
  const markers = {};

  // Add markers
  puskesmasData.forEach(pk => {
    if (!pk.lat || !pk.lng) return;

    const lat = parseFloat(pk.lat);
    const lng = parseFloat(pk.lng);
    const total = parseInt(pk.total_balita) || 0;
    const normal = parseInt(pk.normal) || 0;
    const stunting = parseInt(pk.stunting) || 0;
    const sangat = parseInt(pk.sangat_pendek) || 0;
    const stuntedTotal = stunting + sangat;
    const prevalensi = total > 0 ? (stuntedTotal / total) * 100 : 0;

    let prevColor, prevBg;
    if (prevalensi >= 20) { prevColor = '#991b1b'; prevBg = '#fef2f2'; }
    else if (prevalensi > 0) { prevColor = '#92400e'; prevBg = '#fffbeb'; }
    else { prevColor = '#065f46'; prevBg = '#ecfdf5'; }

    const marker = L.marker([lat, lng], { icon: createPuskesmasIcon() }).addTo(map);

    const popupContent = `
      <div class="popup-inner">
        <div class="popup-title">${pk.nama_puskesmas || ''}</div>
        <div class="popup-addr">${pk.alamat || 'Alamat belum diatur'}</div>
        <div class="popup-stats">
          <div class="popup-stat normal">
            <div class="popup-stat-val">${normal}</div>
            <div class="popup-stat-lbl">Normal</div>
          </div>
          <div class="popup-stat stunting">
            <div class="popup-stat-val">${stunting}</div>
            <div class="popup-stat-lbl">Stunting</div>
          </div>
          <div class="popup-stat severe">
            <div class="popup-stat-val">${sangat}</div>
            <div class="popup-stat-lbl">S. Pendek</div>
          </div>
        </div>
        <div class="popup-prev">
          <span class="popup-prev-label">Prevalensi Kawasan</span>
          <span class="popup-prev-badge" style="color:${prevColor};background:${prevBg}">${prevalensi.toFixed(1)}%</span>
        </div>
      </div>
    `;

    marker.bindPopup(popupContent, { maxWidth: 260 });
    markers[pk.id] = { marker, lat, lng };
  });

  // Fit bounds
  const markerEntries = Object.values(markers);
  if (markerEntries.length > 0) {
    const group = L.featureGroup(markerEntries.map(m => m.marker));
    map.fitBounds(group.getBounds().pad(0.2));
  }

  // Focus on puskesmas
  function focusPuskesmas(id) {
    const entry = markers[id];
    if (!entry) return;

    map.flyTo([entry.lat, entry.lng], 16, { duration: 0.8 });
    entry.marker.openPopup();

    // Highlight card
    document.querySelectorAll('.pk-card').forEach(c => c.classList.remove('active'));
    document.querySelector(`.pk-card[data-id="${id}"]`)?.classList.add('active');
  }

  // Reset view
  function resetMapView() {
    if (markerEntries.length > 0) {
      const group = L.featureGroup(markerEntries.map(m => m.marker));
      map.flyToBounds(group.getBounds().pad(0.2), { duration: 0.8 });
    } else {
      map.flyTo([1.3165, 124.8300], 13, { duration: 0.8 });
    }
    map.closePopup();
    document.querySelectorAll('.pk-card').forEach(c => c.classList.remove('active'));
  }
</script>
<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
<script>
  // Pastikan peta Leaflet merender tile setelah CSS responsif dimuat
  setTimeout(function() {
    if (typeof map !== 'undefined') {
      map.invalidateSize();
    }
  }, 600);
</script>
<script>
  document.querySelector('select[name="bulan"]').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    document.getElementById('tahun-input').value = selected.getAttribute('data-tahun');
    this.form.submit();
  });
</script>
</body>
</html>

