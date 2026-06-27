<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Puskesmas - SIPSTU</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap');
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --blue-950: #0a1628; --blue-900: #0f2044; --blue-800: #163060; --blue-700: #1e4080; 
      --blue-600: #2563a8; --blue-500: #3b82d4; --blue-400: #60a5f0; --blue-300: #93c5fd; 
      --blue-100: #dbeafe; --blue-50:  #eff6ff; --success:  #10b981; --warning:  #f59e0b; 
      --danger:   #ef4444; --text-primary: #0f172a; --text-secondary: #475569; 
      --text-muted: #94a3b8; --border: #e2e8f0; --surface: #f8fafc;
    }
    body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text-primary); height: 100vh; overflow: hidden; }
    .layout { display: flex; height: 100vh; width: 100vw; overflow: hidden; }

    /* SIDEBAR */
    .sidebar { width: 240px; background: var(--blue-950); display: flex; flex-direction: column; flex-shrink: 0; position: relative; overflow-y: auto; overflow-x: hidden; }
    .sidebar-logo { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); }
    .logo-badge { display: inline-flex; align-items: center; gap: 10px; }
    .logo-icon { width: 34px; height: 34px; background: var(--blue-500); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: white; }
    .logo-text { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 15px; color: white; line-height: 1.2; }
    .logo-sub { font-size: 10px; color: rgba(255,255,255,0.4); }
    .sidebar-section { padding: 16px 12px 4px; }
    .sidebar-label { font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.3); letter-spacing: 1px; text-transform: uppercase; padding: 0 8px 8px; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; font-size: 13px; color: rgba(255,255,255,0.55); cursor: pointer; transition: all 0.15s; margin-bottom: 2px; font-weight: 500; text-decoration: none; }
    .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.9); }
    .nav-item.active { background: var(--blue-700); color: white; }
    .nav-item .icon { width: 16px; height: 16px; flex-shrink: 0; opacity:0.8;}
    .nav-badge { margin-left: auto; background: var(--blue-500); color: white; font-size: 10px; padding: 1px 6px; border-radius: 10px; font-weight: 600; }
    .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
    .user-card { display: flex; align-items: center; gap: 10px; padding: 8px; border-radius: 8px; }
    .avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--blue-600); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: white; flex-shrink: 0; }
    .user-name { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.85); }
    .user-role { font-size: 10px; color: rgba(255,255,255,0.35); }

    /* MAIN */
    .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; background: #fafafa; }
    .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 28px; height: 60px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;}
    .topbar-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: var(--text-primary); }
    .content { flex: 1; padding: 24px 28px; overflow-y: auto; }

    /* PAGE HEADER */
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .page-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 20px; color: var(--text-primary); margin-bottom: 4px; }
    .page-sub { font-size: 13px; color: var(--text-secondary); }
    
    .btn-primary-custom { background: var(--blue-600); color: white; border: none; border-radius: 8px; padding: 10px 18px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; text-decoration: none; cursor: pointer; }
    .btn-primary-custom:hover { background: var(--blue-700); color: white; transform: translateY(-1px); }

    /* CUSTOM CARD & TABLE */
    .card-custom { background: white; border-radius: 12px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-custom { width: 100%; margin-bottom: 0; border-collapse: collapse; }
    .table-custom th { font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; padding: 14px 20px; background: var(--surface); border-bottom: 1px solid var(--border); text-align: left; }
    .table-custom td { padding: 16px 20px; font-size: 13px; color: var(--text-secondary); border-bottom: 1px solid var(--border); vertical-align: middle; }
    .table-custom tr:last-child td { border-bottom: none; }
    .table-custom tr:hover td { background: var(--surface); }
    .item-title { font-weight: 600; color: var(--text-primary); font-size: 14px; margin-bottom: 2px; }
    .item-sub { font-size: 11px; color: var(--text-muted); }
    
    .action-btn { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid transparent; transition: all 0.2s; cursor: pointer; background: transparent; }
    .action-btn.edit { color: var(--blue-600); }
    .action-btn.edit:hover { background: var(--blue-50); border-color: var(--blue-200); }
    .action-btn.delete { color: var(--danger); }
    .action-btn.delete:hover { background: #fef2f2; border-color: #fca5a5; }

    /* MODAL STYLING */
    .modal-content { border-radius: 14px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    .modal-header { border-bottom: 1px solid var(--border); padding: 20px 24px; }
    .modal-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 16px; color: var(--text-primary); }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--border); padding: 16px 24px; background: var(--surface); border-radius: 0 0 14px 14px; }
    
    .form-label { font-size: 12px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid var(--border); padding: 10px 14px; font-size: 13px; transition: all 0.2s; font-family: 'DM Sans', sans-serif;}
    .form-control:focus, .form-select:focus { border-color: var(--blue-400); box-shadow: 0 0 0 3px rgba(59,130,212,0.1); outline: none; }
    .form-text { font-size: 11px; color: var(--text-muted); margin-top: 4px; }
    
    .badge-creds { background: #f1f5f9; border: 1px solid var(--border); padding: 4px 8px; border-radius: 6px; font-size: 11px; color: var(--text-secondary); display: inline-flex; align-items: center; gap: 4px; font-family: monospace; }

    /* COORD STYLES */
    .coord-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-family: 'DM Sans', monospace; color: var(--text-muted); background: var(--surface); border: 1px solid var(--border); border-radius: 6px; padding: 3px 8px; cursor: pointer; transition: all 0.2s; }
    .coord-badge:hover { border-color: var(--blue-400); color: var(--blue-600); background: var(--blue-50); }
    .coord-badge .copied { display: none; color: var(--success); font-weight: 600; }
    .coord-empty { font-size: 11px; color: var(--text-muted); font-style: italic; }
    .mini-map-wrap { border-radius: 10px; overflow: hidden; border: 1px solid var(--border); margin-top: 12px; }
    .coord-inputs { display: flex; gap: 12px; }
    .coord-inputs .coord-field { flex: 1; }
    .coord-hint { font-size: 11px; color: var(--text-muted); margin-top: 4px; display: flex; align-items: center; gap: 4px; }
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
      <a href="<?= base_url('welcome/peta_puskesmas') ?>" class="nav-item">
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
      <a href="<?= base_url('puskesmas_admin') ?>" class="nav-item active">
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
      <div class="topbar-title">Manajemen Data Puskesmas</div>
    </div>

    <div class="content">
      
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="font-size: 13px; border-radius: 10px;">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
        </div>
      <?php endif; ?>
      <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="font-size: 13px; border-radius: 10px;">
          <?= $this->session->flashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
        </div>
      <?php endif; ?>

      <!-- PAGE HEADER -->
      <div class="page-header">
        <div>
          <h2 class="page-title">Puskesmas Terdaftar</h2>
          <p class="page-sub">Kelola data puskesmas, lokasi, kontak, dan akses login aplikasi.</p>
        </div>
        <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Tambah Puskesmas
        </button>
      </div>

      <!-- TABLE -->
      <div class="card-custom">
        <div class="table-responsive">
          <table class="table-custom">
            <thead>
              <tr>
                <th width="35%">Profil Puskesmas</th>
                <th width="25%">Kontak & Lokasi</th>
                <th width="20%">Akses Akun</th>
                <th width="20%" class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($puskesmas)): ?>
              <tr>
                <td colspan="4" class="text-center py-4 text-muted" style="font-size:13px">Belum ada data puskesmas.</td>
              </tr>
              <?php else: ?>
                <?php foreach($puskesmas as $p): ?>
                <tr>
                  <td>
                    <div class="item-title"><?= htmlspecialchars($p['nama_puskesmas']) ?></div>
                    <div class="item-sub text-truncate" style="max-width: 250px;" title="<?= htmlspecialchars($p['alamat']) ?>">
                      <?= $p['alamat'] ? htmlspecialchars($p['alamat']) : 'Alamat belum diatur' ?>
                    </div>
                  </td>
                  <td>
                    <div style="font-size: 12px; color: var(--text-primary); margin-bottom: 2px;">
                      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1"><path stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                      <?= $p['no_telp'] ? htmlspecialchars($p['no_telp']) : '-' ?>
                    </div>
                    <div style="margin-top: 4px;">
                      <?php if(!empty($p['lat']) && !empty($p['lng'])): ?>
                        <span class="coord-badge" onclick="copyCoord(this, '<?= $p['lat'] ?>, <?= $p['lng'] ?>')" title="Klik untuk copy">
                          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                          <span class="coords"><?= $p['lat'] ?>, <?= $p['lng'] ?></span>
                          <span class="copied">✓ Copied!</span>
                        </span>
                      <?php else: ?>
                        <span class="coord-empty">GPS belum diatur</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <div class="badge-creds">
                      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                      <?= htmlspecialchars($p['username']) ?>
                    </div>
                  </td>
                  <td class="text-end">
                    <button class="action-btn edit" title="Edit Data" 
                      data-bs-toggle="modal" 
                      data-bs-target="#modalEdit"
                      data-id="<?= $p['id'] ?>"
                      data-nama="<?= htmlspecialchars($p['nama_puskesmas']) ?>"
                      data-notelp="<?= htmlspecialchars($p['no_telp']) ?>"
                      data-alamat="<?= htmlspecialchars($p['alamat']) ?>"
                      data-lat="<?= htmlspecialchars($p['lat']) ?>"
                      data-lng="<?= htmlspecialchars($p['lng']) ?>"
                      data-username="<?= htmlspecialchars($p['username']) ?>">
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <a href="<?= base_url('puskesmas_admin/delete/'.$p['id']) ?>" class="action-btn delete" title="Hapus" onclick="return confirm('Menghapus Puskesmas juga akan menghapus akun login terkait secara permanen. Lanjutkan?')">
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </a>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Puskesmas Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
      </div>
      <form action="<?= base_url('puskesmas_admin/create') ?>" method="POST">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nama Puskesmas <span class="text-danger">*</span></label>
              <input type="text" name="nama_puskesmas" class="form-control" required placeholder="Contoh: Puskesmas Matani">
            </div>
            <div class="col-md-6">
              <label class="form-label">Nomor Telepon</label>
              <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 08123456789">
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2" placeholder="Detail alamat puskesmas"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align: -2px; margin-right: 4px;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
              Koordinat GPS
            </label>
            <div class="coord-inputs">
              <div class="coord-field">
                <input type="text" name="lat" id="add-lat" class="form-control" placeholder="Latitude" oninput="updateAddMap()">
              </div>
              <div class="coord-field">
                <input type="text" name="lng" id="add-lng" class="form-control" placeholder="Longitude" oninput="updateAddMap()">
              </div>
            </div>
            <div class="coord-hint">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              Klik pada peta atau masukkan koordinat manual. Contoh: 1.3165, 124.8365
            </div>
            <div class="mini-map-wrap">
              <div id="add-map" style="height: 200px;"></div>
            </div>
          </div>
          
          <div class="p-3 bg-light rounded-3 border mt-4">
            <label class="form-label text-primary mb-3">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1"><path stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              Akses Login Admin Puskesmas
            </label>
            <div class="row">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" required placeholder="Contoh: admin_matani">
              </div>
              <div class="col-md-6">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="text" name="password" class="form-control" required placeholder="Masukkan password">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="font-size:13px; font-weight:600; padding:9px 18px; border-radius:8px">Batal</button>
          <button type="submit" class="btn btn-primary-custom" style="padding:9px 18px;">Simpan Puskesmas</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Puskesmas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
      </div>
      <form action="<?= base_url('puskesmas_admin/update') ?>" method="POST">
        <input type="hidden" name="id" id="edit-id">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nama Puskesmas <span class="text-danger">*</span></label>
              <input type="text" name="nama_puskesmas" id="edit-nama" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nomor Telepon</label>
              <input type="text" name="no_telp" id="edit-notelp" class="form-control">
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" id="edit-alamat" class="form-control" rows="2"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align: -2px; margin-right: 4px;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
              Koordinat GPS
            </label>
            <div class="coord-inputs">
              <div class="coord-field">
                <input type="text" name="lat" id="edit-lat" class="form-control" placeholder="Latitude" oninput="updateEditMap()">
              </div>
              <div class="coord-field">
                <input type="text" name="lng" id="edit-lng" class="form-control" placeholder="Longitude" oninput="updateEditMap()">
              </div>
            </div>
            <div class="coord-hint">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              Klik pada peta atau drag marker untuk mengatur posisi
            </div>
            <div class="mini-map-wrap">
              <div id="edit-map" style="height: 200px;"></div>
            </div>
          </div>
          
          <div class="p-3 bg-light rounded-3 border mt-4">
            <label class="form-label text-primary mb-3">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1"><path stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              Akses Login Akun
            </label>
            <div class="row">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" id="edit-username" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Password Baru</label>
                <input type="text" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                <div class="form-text">Biarkan kosong jika password tidak diganti.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="font-size:13px; font-weight:600; padding:9px 18px; border-radius:8px">Batal</button>
          <button type="submit" class="btn btn-primary-custom" style="padding:9px 18px;">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const DEFAULT_LAT = 1.3165, DEFAULT_LNG = 124.8300, DEFAULT_ZOOM = 13;
  let addMap, addMarker, editMap, editMarker;

  // ====== ADD MAP ======
  const modalTambah = document.getElementById('modalTambah');
  if (modalTambah) {
    modalTambah.addEventListener('shown.bs.modal', () => {
      if (!addMap) {
        addMap = L.map('add-map').setView([DEFAULT_LAT, DEFAULT_LNG], DEFAULT_ZOOM);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OSM', maxZoom: 19
        }).addTo(addMap);
        addMap.on('click', function(e) {
          document.getElementById('add-lat').value = e.latlng.lat.toFixed(6);
          document.getElementById('add-lng').value = e.latlng.lng.toFixed(6);
          setAddMarker(e.latlng.lat, e.latlng.lng);
        });
      }
      setTimeout(() => addMap.invalidateSize(), 100);
    });
  }

  function setAddMarker(lat, lng) {
    if (addMarker) addMap.removeLayer(addMarker);
    addMarker = L.marker([lat, lng], { draggable: true }).addTo(addMap);
    addMarker.on('dragend', function() {
      const pos = addMarker.getLatLng();
      document.getElementById('add-lat').value = pos.lat.toFixed(6);
      document.getElementById('add-lng').value = pos.lng.toFixed(6);
    });
    addMap.flyTo([lat, lng], 15, { duration: 0.5 });
  }

  function updateAddMap() {
    const lat = parseFloat(document.getElementById('add-lat').value);
    const lng = parseFloat(document.getElementById('add-lng').value);
    if (!isNaN(lat) && !isNaN(lng) && addMap) setAddMarker(lat, lng);
  }

  // ====== EDIT MAP ======
  const modalEdit = document.getElementById('modalEdit');
  if (modalEdit) {
    modalEdit.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      document.getElementById('edit-id').value = button.getAttribute('data-id');
      document.getElementById('edit-nama').value = button.getAttribute('data-nama');
      document.getElementById('edit-notelp').value = button.getAttribute('data-notelp');
      document.getElementById('edit-alamat').value = button.getAttribute('data-alamat');
      document.getElementById('edit-lat').value = button.getAttribute('data-lat') || '';
      document.getElementById('edit-lng').value = button.getAttribute('data-lng') || '';
      document.getElementById('edit-username').value = button.getAttribute('data-username');
    });

    modalEdit.addEventListener('shown.bs.modal', () => {
      if (!editMap) {
        editMap = L.map('edit-map').setView([DEFAULT_LAT, DEFAULT_LNG], DEFAULT_ZOOM);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OSM', maxZoom: 19
        }).addTo(editMap);
        editMap.on('click', function(e) {
          document.getElementById('edit-lat').value = e.latlng.lat.toFixed(6);
          document.getElementById('edit-lng').value = e.latlng.lng.toFixed(6);
          setEditMarker(e.latlng.lat, e.latlng.lng);
        });
      }
      setTimeout(() => {
        editMap.invalidateSize();
        const lat = parseFloat(document.getElementById('edit-lat').value);
        const lng = parseFloat(document.getElementById('edit-lng').value);
        if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
          setEditMarker(lat, lng);
        } else {
          if (editMarker) editMap.removeLayer(editMarker);
          editMarker = null;
          editMap.setView([DEFAULT_LAT, DEFAULT_LNG], DEFAULT_ZOOM);
        }
      }, 100);
    });
  }

  function setEditMarker(lat, lng) {
    if (editMarker) editMap.removeLayer(editMarker);
    editMarker = L.marker([lat, lng], { draggable: true }).addTo(editMap);
    editMarker.on('dragend', function() {
      const pos = editMarker.getLatLng();
      document.getElementById('edit-lat').value = pos.lat.toFixed(6);
      document.getElementById('edit-lng').value = pos.lng.toFixed(6);
    });
    editMap.flyTo([lat, lng], 15, { duration: 0.5 });
  }

  function updateEditMap() {
    const lat = parseFloat(document.getElementById('edit-lat').value);
    const lng = parseFloat(document.getElementById('edit-lng').value);
    if (!isNaN(lat) && !isNaN(lng) && editMap) setEditMarker(lat, lng);
  }

  // ====== COPY COORDINATES ======
  function copyCoord(el, text) {
    navigator.clipboard.writeText(text).then(() => {
      const coordsEl = el.querySelector('.coords');
      const copiedEl = el.querySelector('.copied');
      coordsEl.style.display = 'none';
      copiedEl.style.display = 'inline';
      setTimeout(() => {
        coordsEl.style.display = 'inline';
        copiedEl.style.display = 'none';
      }, 1500);
    });
  }
</script>

<script src="<?= base_url('assets/js/responsive.js?v=1.4') ?>"></script>
</body>
</html>
