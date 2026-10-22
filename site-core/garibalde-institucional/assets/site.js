(function(){
'use strict';

var nav = document.querySelector('.ga-primary-nav');
var menuToggle = document.querySelector('.ga-menu-toggle');
if (nav && menuToggle) {
  menuToggle.addEventListener('click', function() {
    var isOpen = nav.classList.toggle('is-open');
    menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && nav.classList.contains('is-open')) {
      nav.classList.remove('is-open');
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.focus();
    }
  });
}

function setupCarousel(root) {
  var media = root.querySelector('.ga-hero-media');
  var imageNodes = media ? Array.prototype.slice.call(media.querySelectorAll('[data-ga-slide]')) : [];
  var titleNode = root.querySelector('[data-ga-title]') || root.querySelector('h1');
  var descriptionNode = root.querySelector('[data-ga-description]') || root.querySelector('.ga-hero-content > p');
  var counter = root.querySelector('[data-ga-count]') || root.querySelector('[data-ga-slide-count]');
  var previous = root.querySelector('[data-ga-prev]') || root.querySelector('[data-ga-slide-prev]');
  var next = root.querySelector('[data-ga-next]') || root.querySelector('[data-ga-slide-next]');
  var pause = root.querySelector('[data-ga-pause]');
  var slideData = [];
  var active = 0;
  var timer = null;
  var paused = false;
  var interval = Math.max(4000, Number(root.getAttribute('data-ga-interval') || 7000));
  var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (root.hasAttribute('data-ga-slides')) {
    try { slideData = JSON.parse(root.getAttribute('data-ga-slides') || '[]'); } catch (error) { slideData = []; }
  }
  if (!slideData.length && imageNodes.length) {
    slideData = imageNodes.map(function(node) {
      return {
        image: node.getAttribute('src') || '',
        title: node.getAttribute('data-title') || '',
        description: node.getAttribute('data-description') || ''
      };
    });
  }
  if (!slideData.length) return;

  function paint(nextIndex) {
    active = (nextIndex + slideData.length) % slideData.length;
    var item = slideData[active] || {};
    if (titleNode && item.title) titleNode.textContent = item.title;
    if (descriptionNode && item.description) descriptionNode.textContent = item.description;

    imageNodes.forEach(function(node) {
      var selected = Number(node.getAttribute('data-ga-slide')) === active;
      node.classList.toggle('is-active', selected);
      node.setAttribute('aria-hidden', selected ? 'false' : 'true');
    });
    if (media && slideData[active].image) {
      media.style.setProperty('--ga-hero-image', 'url("' + String(slideData[active].image).replace(/["\\]/g, '') + '")');
    }
    if (counter) counter.textContent = (active + 1) + ' / ' + slideData.length;
  }

  function stopTimer() {
    if (timer !== null) window.clearInterval(timer);
    timer = null;
  }
  function startTimer() {
    stopTimer();
    if (!paused && !prefersReduced && slideData.length > 1) {
      timer = window.setInterval(function() { paint(active + 1); }, interval);
    }
  }
  function setPaused(value) {
    paused = !!value;
    if (pause) {
      pause.setAttribute('aria-pressed', paused ? 'true' : 'false');
      pause.setAttribute('aria-label', paused ? 'Retomar transição' : 'Pausar transição');
      pause.textContent = paused ? '▶' : 'Ⅱ';
    }
    startTimer();
  }
  if (previous) previous.addEventListener('click', function() { paint(active - 1); startTimer(); });
  if (next) next.addEventListener('click', function() { paint(active + 1); startTimer(); });
  if (pause) pause.addEventListener('click', function() { setPaused(!paused); });

  root.addEventListener('mouseenter', function() { stopTimer(); });
  root.addEventListener('mouseleave', startTimer);
  root.addEventListener('focusin', stopTimer);
  root.addEventListener('focusout', function(event) {
    if (!root.contains(event.relatedTarget)) startTimer();
  });
  root.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowLeft') { paint(active - 1); startTimer(); }
    if (event.key === 'ArrowRight') { paint(active + 1); startTimer(); }
  });
  paint(0);
  startTimer();
}
Array.prototype.forEach.call(document.querySelectorAll('[data-ga-carousel]'), setupCarousel);
})();