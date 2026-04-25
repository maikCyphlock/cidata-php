document.addEventListener('DOMContentLoaded', function () {

  // ── Lucide icons ──
  if (typeof lucide !== 'undefined') lucide.createIcons();

  // ── Hero popup close ──
  var popup = document.getElementById('hero-popup');
  var popupClose = document.getElementById('popup-close');
  if (popup && popupClose) {
    popupClose.addEventListener('click', function () { popup.classList.add('hidden'); });
  }

  // ── Mobile Menu Toggle ──
  var navToggle = document.getElementById('nav-toggle');
  var navLinks = document.getElementById('nav-links');

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      navLinks.classList.toggle('open');
      // Change icon to X if open
      var icon = navToggle.querySelector('i');
      if (icon) {
        var isOpening = navLinks.classList.contains('open');
        icon.setAttribute('data-lucide', isOpening ? 'x' : 'menu');
        if (typeof lucide !== 'undefined') lucide.createIcons();
      }
    });

    // Close menu when clicking a link
    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        navLinks.classList.remove('open');
        var icon = navToggle.querySelector('i');
        if (icon) {
          icon.setAttribute('data-lucide', 'menu');
          if (typeof lucide !== 'undefined') lucide.createIcons();
        }
      });
    });
  }

  // ── Plans tabs ──
  var tabs = document.querySelectorAll('.plans-tab');
  var resGrid = document.getElementById('residenciales-grid');
  var corpGrid = document.getElementById('corporativos-grid');

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      if (tab.classList.contains('active')) return;
      
      var target = tab.dataset.tab; // 'residenciales' or 'corporativos'
      
      tabs.forEach(function (t) { t.classList.remove('active'); });
      tab.classList.add('active');

      if (typeof gsap !== 'undefined') {
        var hide = target === 'residenciales' ? corpGrid : resGrid;
        var show = target === 'residenciales' ? resGrid : corpGrid;

        gsap.to(hide, { 
          autoAlpha: 0, 
          y: 20, 
          duration: 0.3, 
          onComplete: function() {
            hide.style.display = 'none';
            show.style.display = 'grid';
            gsap.fromTo(show, 
              { autoAlpha: 0, y: 20 }, 
              { autoAlpha: 1, y: 0, duration: 0.4, clearProps: 'all' }
            );
          } 
        });
      } else {
        resGrid.style.display  = (target === 'residenciales') ? 'grid' : 'none';
        corpGrid.style.display = (target === 'corporativos')  ? 'grid' : 'none';
      }
    });
  });

  // ── Flash auto-hide ──
  var flash = document.querySelector('.flash');
  if (flash) {
    setTimeout(function () {
      flash.style.transition = 'opacity 600ms';
      flash.style.opacity = '0';
      setTimeout(function () { flash.style.display = 'none'; }, 650);
    }, 5000);
  }

  // ── Smooth scroll ──
  document.querySelectorAll('[data-scroll-to]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      var t = document.querySelector(el.dataset.scrollTo);
      if (t) t.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // ── Coverage map (Leaflet) ──
  if (typeof L !== 'undefined') {
    var mapEl = document.getElementById('coverage-map');
    if (mapEl) {
      var map = L.map('coverage-map', { zoomControl: true, scrollWheelZoom: false })
                 .setView([9.5658, -69.2097], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap',
        maxZoom: 19
      }).addTo(map);
      var icon = L.divIcon({
        className: '',
        html: '<div style="width:18px;height:18px;background:#ff4b89;border:3px solid #fff;border-radius:50%;box-shadow:0 0 20px rgba(255,75,137,.6)"></div>',
        iconSize: [18, 18], iconAnchor: [9, 9]
      });
      L.marker([9.5658, -69.2097], { icon: icon })
        .addTo(map)
        .bindPopup('<b style="font-family:sans-serif">Araure, Portuguesa</b><br><span style="font-size:12px;color:#ff4b89">Cidata — Fibra Óptica</span>');
      setTimeout(function () { map.invalidateSize(); }, 120);
    }
  }

  // ─────────── GSAP anim ───────────
  if (typeof gsap === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  // Hero entrada
  gsap.set('.hero-eyebrow',   { y: 30, autoAlpha: 0 });
  gsap.set('.hero-headline',  { y: 50, autoAlpha: 0 });
  gsap.set('.hero-sub',       { y: 30, autoAlpha: 0 });
  gsap.set('.hero-actions',   { y: 25, autoAlpha: 0 });
  gsap.set('.hero-visual',    { x: 60, autoAlpha: 0 });
  gsap.set('.hero-popup',     { y: 20, autoAlpha: 0 });

  gsap.timeline({ defaults: { ease: 'power3.out' } })
    .to('.hero-eyebrow',  { y: 0, autoAlpha: 1, duration: 0.55 })
    .to('.hero-headline', { y: 0, autoAlpha: 1, duration: 0.75 }, '-=0.3')
    .to('.hero-sub',      { y: 0, autoAlpha: 1, duration: 0.55 }, '-=0.45')
    .to('.hero-actions',  { y: 0, autoAlpha: 1, duration: 0.45 }, '-=0.3')
    .to('.hero-visual',   { x: 0, autoAlpha: 1, duration: 0.9, ease: 'power2.out' }, '-=0.75')
    .to('.hero-popup',    { y: 0, autoAlpha: 1, duration: 0.55, ease: 'back.out(1.6)' }, '-=0.2');

  function reveal(sel, vars) {
    gsap.utils.toArray(sel).forEach(function (el) {
      gsap.from(el, Object.assign({
        y: 40, autoAlpha: 0, duration: 0.7, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 88%' }
      }, vars || {}));
    });
  }

  reveal('.section-title', { y: 30, duration: 0.65 });
  reveal('.plans-tabs',    { y: 20, duration: 0.55 });

  gsap.from('.c-card--horizontal', {
    y: 40, autoAlpha: 0, duration: 0.6, stagger: 0.1, ease: 'power3.out',
    scrollTrigger: { trigger: '.advantages__grid', start: 'top 85%' },
    clearProps: 'transform'
  });

  gsap.from('.plans .c-card', {
    y: 60, autoAlpha: 0, duration: 0.75, stagger: 0.15, ease: 'power3.out',
    scrollTrigger: { trigger: '.plans-grid', start: 'top 82%' },
    clearProps: 'transform'
  });

  gsap.from('.coverage-form', {
    x: -40, autoAlpha: 0, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '.coverage', start: 'top 80%' }
  });
  gsap.from('.coverage-visual', {
    x: 40, autoAlpha: 0, duration: 0.8, ease: 'power3.out',
    scrollTrigger: { trigger: '.coverage', start: 'top 80%' }
  });

  gsap.from('.about-title, .about-desc, .about-cta-row', {
    y: 30, autoAlpha: 0, duration: 0.7, stagger: 0.12, ease: 'power3.out',
    scrollTrigger: { trigger: '.about', start: 'top 80%' }
  });
  gsap.from('.stat', {
    y: 30, autoAlpha: 0, duration: 0.6, stagger: 0.12, ease: 'power3.out',
    scrollTrigger: { trigger: '.about-stats', start: 'top 85%' }
  });

  gsap.from('.review', {
    y: 40, autoAlpha: 0, duration: 0.6, stagger: 0.09, ease: 'power3.out',
    scrollTrigger: { trigger: '.reviews__grid', start: 'top 85%' },
    clearProps: 'transform'
  });

  gsap.from('.post-card', {
    y: 50, autoAlpha: 0, duration: 0.7, stagger: 0.12, ease: 'power3.out',
    scrollTrigger: { trigger: '.news__grid', start: 'top 85%' },
    clearProps: 'transform'
  });

  gsap.from('.contact-visual', {
    x: -40, autoAlpha: 0, duration: 0.85, ease: 'power3.out',
    scrollTrigger: { trigger: '.contact', start: 'top 80%' }
  });
  gsap.from('.contact-form-wrap', {
    x: 40, autoAlpha: 0, duration: 0.85, ease: 'power3.out',
    scrollTrigger: { trigger: '.contact', start: 'top 80%' }
  });

  gsap.from('.footer-grid', {
    y: 35, autoAlpha: 0, duration: 0.7, ease: 'power2.out',
    scrollTrigger: { trigger: '.footer', start: 'top 90%' }
  });
});
