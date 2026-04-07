/* ============================================================
   GAMEVAULT — main.js
   Mobile nav · FAQ accordion · Tab switching · Countdown
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ── Mobile nav toggle ───────────────────────────────────── */
  const toggle = document.querySelector('.navbar__toggle');
  const links  = document.querySelector('.navbar__links');
  if (toggle && links) {
    toggle.addEventListener('click', () => {
      toggle.classList.toggle('open');
      links.classList.toggle('open');
    });
    // close on link click
    links.querySelectorAll('a').forEach(a =>
      a.addEventListener('click', () => {
        toggle.classList.remove('open');
        links.classList.remove('open');
      })
    );
  }

  /* ── Active nav link (based on current page filename) ───── */
  const currentPage = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.navbar__links a').forEach(a => {
    if (a.getAttribute('href') === currentPage) a.classList.add('active');
  });

  /* ── FAQ accordion ───────────────────────────────────────── */
  document.querySelectorAll('.faq-question').forEach(q => {
    q.addEventListener('click', () => {
      const item = q.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      // close all
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ── Tab switching ───────────────────────────────────────── */
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tab;
      const container = btn.closest('.tabs-section') || document;
      container.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      container.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      const panel = container.querySelector(`[data-panel="${target}"]`);
      if (panel) panel.classList.add('active');
    });
  });

  /* ── Countdown timer (promo banner) ─────────────────────── */
  const countdownEl = document.querySelector('.hero-countdown');
  if (countdownEl) {
    const endTime = new Date();
    endTime.setHours(endTime.getHours() + 11, endTime.getMinutes() + 47, endTime.getSeconds() + 32);

    function updateCountdown() {
      const diff = endTime - new Date();
      if (diff <= 0) { countdownEl.textContent = 'EXPIRED'; return; }
      const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
      const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
      const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
      const units = countdownEl.querySelectorAll('.countdown-unit__val');
      if (units.length === 3) { units[0].textContent = h; units[1].textContent = m; units[2].textContent = s; }
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);
  }

  /* ── Shop view toggle (grid/list) ───────────────────────── */
  const viewBtns = document.querySelectorAll('.view-btn');
  const gamesGrid = document.querySelector('.games-grid');
  viewBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      viewBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      if (gamesGrid) {
        gamesGrid.classList.toggle('list-view', btn.dataset.view === 'list');
      }
    });
  });

  /* ── Sidebar filter toggle (mobile) ─────────────────────── */
  const filterToggle = document.querySelector('.sidebar__filters-toggle');
  const sidebarBody  = document.querySelector('.sidebar__body');
  if (filterToggle && sidebarBody) {
    filterToggle.addEventListener('click', () => {
      sidebarBody.classList.toggle('open');
      filterToggle.querySelector('.ft-arrow').textContent =
        sidebarBody.classList.contains('open') ? '▲' : '▼';
    });
  }

  /* ── Price range slider live update ─────────────────────── */
  const slider = document.querySelector('.price-slider');
  const maxLabel = document.querySelector('.price-max');
  if (slider && maxLabel) {
    slider.addEventListener('input', () => {
      maxLabel.textContent = '$' + slider.value;
      slider.style.setProperty('--val', slider.value + '%');
    });
  }

  /* ── Contact form: char counter ─────────────────────────── */
  const msgField = document.querySelector('#contact-message');
  const charCount = document.querySelector('.char-counter');
  if (msgField && charCount) {
    msgField.addEventListener('input', () => {
      charCount.textContent = msgField.value.length + ' / 1000';
    });
  }

  /* ── Contact form: client-side validation feedback ───────── */
  const contactForm = document.querySelector('.contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault(); // remove this line when PHP is connected

      const feedback = contactForm.querySelector('.form-feedback');
      const name  = contactForm.querySelector('[name="name"]').value.trim();
      const email = contactForm.querySelector('[name="email"]').value.trim();
      const msg   = contactForm.querySelector('[name="message"]').value.trim();
      const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

      if (!name || !email || !msg || !emailOk) {
        feedback.className = 'form-feedback error';
        feedback.innerHTML = '⚠ Please fill in all required fields with valid information.';
        return;
      }

      feedback.className = 'form-feedback success';
      feedback.innerHTML = '✓ Message sent! We\'ll get back to you within 24 hours.';
      contactForm.reset();
      if (charCount) charCount.textContent = '0 / 1000';
    });
  }

  /* ── Thumbnail gallery (game detail) ────────────────────── */
  document.querySelectorAll('.thumb-item').forEach(thumb => {
    thumb.addEventListener('click', () => {
      document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
    });
  });

});
