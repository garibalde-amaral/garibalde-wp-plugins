(function(){
'use strict';
var nav=document.querySelector('.ga-primary-nav');
var toggle=document.querySelector('.ga-menu-toggle');
if(nav && toggle){
 toggle.addEventListener('click',function(){
  var isOpen=nav.classList.toggle('is-open');
  toggle.setAttribute('aria-expanded',isOpen?'true':'false');
 });
 document.addEventListener('keydown',function(e){
  if(e.key==='Escape' && nav.classList.contains('is-open')){
   nav.classList.remove('is-open');
   toggle.setAttribute('aria-expanded','false');
   toggle.focus();
  }
 });
}
var hero=document.querySelector('#ga-hero');
if(hero){
 var slides=[];
 try { slides=JSON.parse(hero.getAttribute('data-ga-slides')||'[]'); } catch(e) { slides=[]; }
 var index=0;
 var title=hero.querySelector('h1');
 var paragraph=hero.querySelector('.ga-hero-slide p');
 var counter=hero.querySelector('[data-ga-slide-count]');
 function renderSlide(nextIndex){
  if(!slides.length || !title || !paragraph || !counter) return;
  index=(nextIndex+slides.length)%slides.length;
  title.textContent=slides[index].title||'';
  paragraph.textContent=slides[index].description||'';
  counter.textContent=(index+1)+' / '+slides.length;
  var image=String(slides[index].image||'');
  if(image && /^https:\/\/|^\/\//i.test(image)){
   hero.style.setProperty('--ga-hero-image','url("'+image.replace(/["\\\\]/g,'')+'")');
  } else {
   hero.style.setProperty('--ga-hero-image','linear-gradient(135deg,#49382e,#a08a6b)');
  }
 }
 var prev=hero.querySelector('[data-ga-slide-prev]');
 var next=hero.querySelector('[data-ga-slide-next]');
 if(prev) prev.addEventListener('click',function(){renderSlide(index-1);});
 if(next) next.addEventListener('click',function(){renderSlide(index+1);});
 renderSlide(0);
}
})();