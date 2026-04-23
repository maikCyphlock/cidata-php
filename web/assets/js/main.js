document.addEventListener('DOMContentLoaded', function () {

  // ── Lucide icons ──
  if (typeof lucide !== 'undefined') lucide.createIcons();

  // ── Mobile nav toggle ──
  var navToggle = document.getElementById('nav-toggle');
  var navLinks  = document.getElementById('nav-links');
  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      navLinks.classList.toggle('open');
    });
    navLinks.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        navLinks.classList.remove('open');
      });
    });
  }

  // ── Scroll compact nav ──
  var nav = document.querySelector('.nav');
  function updateNav() {
    nav.classList.toggle('scrolled', window.scrollY > 30);
  }
  window.addEventListener('scroll', updateNav, { passive: true });
  updateNav();

  // ── FAQ accordion ──
  document.querySelectorAll('.faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item   = btn.closest('.faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(function (i) {
        i.classList.remove('open');
      });
      if (!isOpen) item.classList.add('open');
      if (typeof lucide !== 'undefined') lucide.createIcons();
    });
  });

  // ── Flash message auto-hide ──
  var flash = document.querySelector('.flash');
  if (flash) {
    setTimeout(function () {
      flash.style.transition = 'opacity 600ms';
      flash.style.opacity = '0';
      setTimeout(function () { flash.style.display = 'none'; }, 650);
    }, 5000);
  }

  // ── Smooth scroll para botones de planes ──
  document.querySelectorAll('[data-scroll-to]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      var target = document.querySelector(el.dataset.scrollTo);
      if (target) target.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // ─────────────────────────────────────────
  // GSAP — si no carga el CDN, la página
  // sigue funcionando sin animaciones
  // ─────────────────────────────────────────
  if (typeof gsap === 'undefined') return;

  gsap.registerPlugin(ScrollTrigger);

  // ── Hero: entrada secuencial al cargar ──
  gsap.set('.nav',           { y: -100, autoAlpha: 0 });
  gsap.set('.hero-eyebrow',  { y: 40,   autoAlpha: 0 });
  gsap.set('.hero-headline', { y: 55,   autoAlpha: 0 });
  gsap.set('.hero-sub',      { y: 35,   autoAlpha: 0 });
  gsap.set('.hero-actions',  { y: 25,   autoAlpha: 0 });
  gsap.set('.trust-item',    { y: 20,   autoAlpha: 0 });
  gsap.set('.hero-visual',   { x: 70,   autoAlpha: 0 });
  gsap.set('.hv-bg',         { scale: 0.88, autoAlpha: 0 });
  gsap.set('.hv-accent',     { scale: 0,    autoAlpha: 0 });
  gsap.set('.hfloat',        { y: 28,   autoAlpha: 0 });

  gsap.timeline({ defaults: { ease: 'power3.out' } })
    .to('.nav',           { y: 0, autoAlpha: 1, duration: 0.65 })
    .to('.hero-eyebrow',  { y: 0, autoAlpha: 1, duration: 0.55 }, '-=0.25')
    .to('.hero-headline', { y: 0, autoAlpha: 1, duration: 0.75 }, '-=0.35')
    .to('.hero-sub',      { y: 0, autoAlpha: 1, duration: 0.55 }, '-=0.45')
    .to('.hero-actions',  { y: 0, autoAlpha: 1, duration: 0.45 }, '-=0.3')
    .to('.trust-item',    { y: 0, autoAlpha: 1, duration: 0.4, stagger: 0.1 }, '-=0.3')
    .to('.hero-visual',   { x: 0, autoAlpha: 1, duration: 0.9, ease: 'power2.out' }, '-=0.75')
    .to('.hv-bg',         { scale: 1, autoAlpha: 1, duration: 0.65, ease: 'power2.out' }, '-=0.75')
    .to('.hv-accent',     { scale: 1, autoAlpha: 1, duration: 0.45, ease: 'back.out(2.2)' }, '-=0.45')
    .to('.hfloat',        { y: 0, autoAlpha: 1, duration: 0.5, stagger: 0.18, ease: 'back.out(1.5)' }, '-=0.4');

  // ── Parallax en formas decorativas del hero ──
  gsap.to('.hero-shape1', {
    y: -100,
    scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: 1.2 }
  });
  gsap.to('.hero-shape2', {
    y: -50,
    scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: 0.8 }
  });

  // ── Helper: reveal individual por scroll ──
  function revealEl(el, vars) {
    var opts = Object.assign({ y: 45, autoAlpha: 0, duration: 0.7, ease: 'power3.out' }, vars || {});
    opts.scrollTrigger = { trigger: el, start: 'top 88%' };
    gsap.from(el, opts);
  }

  // ── Section labels y titles ──
  gsap.utils.toArray('.section-label').forEach(function (el) {
    revealEl(el, { y: 25, duration: 0.5 });
  });
  gsap.utils.toArray('.section-title').forEach(function (el) {
    revealEl(el, { y: 40, duration: 0.65 });
  });

  // ── Planes — stagger desde abajo ──
  gsap.from('.plan-card', {
    y: 70, autoAlpha: 0, duration: 0.75,
    stagger: 0.16, ease: 'power3.out',
    scrollTrigger: { trigger: '.plans-grid', start: 'top 82%' }
  });

  // ── Por qué Cidata — stagger ──
  gsap.from('.why-item', {
    y: 55, autoAlpha: 0, duration: 0.65,
    stagger: 0.13, ease: 'power3.out',
    scrollTrigger: { trigger: '.whyus-grid', start: 'top 82%' }
  });

  // ── Banners de color — texto izquierda, botón derecha ──
  gsap.utils.toArray('.color-block').forEach(function (block) {
    var h2  = block.querySelector('h2');
    var p   = block.querySelector('p');
    var btn = block.querySelector('.btn');
    var st  = { trigger: block, start: 'top 80%' };
    if (h2)  gsap.from(h2,  { x: -55, autoAlpha: 0, duration: 0.75, ease: 'power3.out', scrollTrigger: st });
    if (p)   gsap.from(p,   { x: -35, autoAlpha: 0, duration: 0.65, ease: 'power2.out', scrollTrigger: st, delay: 0.12 });
    if (btn) gsap.from(btn, { x:  55, autoAlpha: 0, duration: 0.75, ease: 'power3.out', scrollTrigger: st, delay: 0.18 });
  });

  // ── Contacto — split izquierda/derecha ──
  gsap.from('.contact-copy', {
    x: -55, autoAlpha: 0, duration: 0.85, ease: 'power3.out',
    scrollTrigger: { trigger: '.contact', start: 'top 78%' }
  });
  gsap.from('.contact-form-wrap', {
    x: 55, autoAlpha: 0, duration: 0.85, ease: 'power3.out',
    scrollTrigger: { trigger: '.contact', start: 'top 78%' }, delay: 0.12
  });
  gsap.from('.contact-detail', {
    y: 22, autoAlpha: 0, duration: 0.5, stagger: 0.1, ease: 'power2.out',
    scrollTrigger: { trigger: '.contact-details', start: 'top 88%' }, delay: 0.25
  });

  // ── FAQ ──
  gsap.from('.faq-item', {
    y: 35, autoAlpha: 0, duration: 0.55, stagger: 0.1, ease: 'power2.out',
    scrollTrigger: { trigger: '.faq-list', start: 'top 82%' }
  });

  // ── Footer ──
  gsap.from('.footer-grid', {
    y: 45, autoAlpha: 0, duration: 0.75, ease: 'power2.out',
    scrollTrigger: { trigger: '.footer', start: 'top 90%' }
  });
  gsap.from('.footer-bottom', {
    y: 22, autoAlpha: 0, duration: 0.5, ease: 'power2.out',
    scrollTrigger: { trigger: '.footer-bottom', start: 'top 98%' }
  });

});
