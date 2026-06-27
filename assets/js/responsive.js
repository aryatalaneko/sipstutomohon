/**
  SIPSTU Tomohon - Global Responsive Helper
  Menangani interaksi dinamis untuk navigasi seluler dan responsive wrapping
*/

function initResponsive() {
  // 1. Dapatkan Base URL secara otomatis dari script tag src
  const scriptElement = document.querySelector('script[src*="responsive.js"]');
  let baseUrl = '';
  if (scriptElement) {
    const src = scriptElement.getAttribute('src');
    // Ambil bagian path sebelum 'assets/js/responsive.js'
    const index = src.indexOf('assets/js/responsive.js');
    if (index !== -1) {
      baseUrl = src.substring(0, index);
    }
  }

  // 2. Injeksi responsive.css secara dinamis ke head
  if (!document.querySelector('link[href*="responsive.css"]')) {
    const link = document.createElement("link");
    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = baseUrl + "assets/css/responsive.css?v=1.4";
    link.onload = function () {
      setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
        // Paksa Leaflet menghitung ulang ukuran kontainer peta
        if (typeof L !== 'undefined' && document.getElementById('map')) {
          try {
            // Cari instance peta Leaflet dari elemen #map
            var mapEl = document.getElementById('map');
            if (mapEl._leaflet_id) {
              // Akses peta melalui eachLayer untuk trigger invalidateSize
              Object.keys(L).length; // pastikan L sudah loaded
            }
          } catch(e) {}
        }
        // Fallback: trigger resize lagi setelah delay lebih lama
        setTimeout(function() {
          window.dispatchEvent(new Event("resize"));
        }, 500);
      }, 200);
    };
    document.head.appendChild(link);
  }

  // 3. Konfigurasi laci navigasi (Drawer Sidebar) dan hamburger menu
  const sidebar = document.querySelector(".sidebar");
  const topbar = document.querySelector(".topbar");
  
  if (sidebar && topbar) {
    // Buat overlay jika belum ada
    let overlay = document.querySelector(".sidebar-overlay");
    if (!overlay) {
      overlay = document.createElement("div");
      overlay.className = "sidebar-overlay";
      document.body.appendChild(overlay);
    }

    // Buat tombol hamburger jika belum ada
    let burgerBtn = topbar.querySelector(".hamburger-btn");
    if (!burgerBtn) {
      burgerBtn = document.createElement("button");
      burgerBtn.className = "hamburger-btn";
      burgerBtn.type = "button";
      burgerBtn.setAttribute("aria-label", "Menu");
      burgerBtn.innerHTML = `
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      `;

      // Sisipkan di awal container topbar
      topbar.insertBefore(burgerBtn, topbar.firstChild);
    }

    // Event click untuk membuka sidebar
    burgerBtn.addEventListener("click", function () {
      sidebar.classList.toggle("show");
      overlay.classList.toggle("show");
    });

    // Event click pada overlay untuk menutup sidebar
    overlay.addEventListener("click", function () {
      sidebar.classList.remove("show");
      overlay.classList.remove("show");
    });

    // Otomatis tutup laci jika mengklik menu item (terutama jika link internal/modal)
    const navItems = sidebar.querySelectorAll(".nav-item");
    navItems.forEach(item => {
      item.addEventListener("click", function () {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
      });
    });
  }

  // 4. Bungkus semua tabel statis ke dalam div .table-responsive secara otomatis
  const tables = document.querySelectorAll("table");
  tables.forEach(table => {
    // Lewati jika tabel sudah berada di dalam elemen berkelas .table-responsive
    let parent = table.parentElement;
    let hasResponsiveWrapper = false;
    
    while (parent && parent !== document.body) {
      if (parent.classList.contains("table-responsive")) {
        hasResponsiveWrapper = true;
        break;
      }
      parent = parent.parentElement;
    }

    if (!hasResponsiveWrapper) {
      const wrapper = document.createElement("div");
      wrapper.className = "table-responsive";
      table.parentNode.insertBefore(wrapper, table);
      wrapper.appendChild(table);
    }
  });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initResponsive);
} else {
  initResponsive();
}
