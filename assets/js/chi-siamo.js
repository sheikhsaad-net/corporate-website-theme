/* Chi siamo — small layout helpers (section pills adapt to their background),
   ported from the approved concept. Loaded only on this page. */
(()=>{
const reduced=matchMedia('(prefers-reduced-motion:reduce)');
// Neutral section pills adapt to the actual surrounding surface.
document.querySelectorAll('.eyebrow').forEach(pill=>{let parent=pill.parentElement;while(parent){const rgba=getComputedStyle(parent).backgroundColor.match(/[\d.]+/g);if(rgba&&rgba.length>=3&&(rgba.length<4||+rgba[3]>.5)){pill.dataset.surface=(+rgba[0]*.2126+ +rgba[1]*.7152+ +rgba[2]*.0722)>150?'light':'dark';break;}parent=parent.parentElement;}});
// Keep mobile visuals below the copy and actions, even when text wraps.
document.querySelectorAll('.immersive-hero').forEach(hero=>{const actions=hero.querySelector('.ih-new-actions');if(!actions)return;const place=()=>{const y=actions.getBoundingClientRect().bottom-hero.getBoundingClientRect().top+36;hero.style.setProperty('--hero-visual-top',`${Math.ceil(y)}px`);};new ResizeObserver(place).observe(actions);window.addEventListener('resize',place,{passive:true});document.fonts.ready.then(place);place();});
document.querySelectorAll('.ih-sccaud').forEach(row=>row.addEventListener('pointermove',e=>{if(reduced.matches)return;const b=row.getBoundingClientRect();row.style.setProperty('--mx',`${(e.clientX-b.left)/b.width*100}%`);row.style.setProperty('--my',`${(e.clientY-b.top)/b.height*100}%`);},{passive:true}));
const nav=document.querySelector('.nav');let pending=false;
function update(){pending=false;if(!nav)return;const sections=[...document.querySelectorAll('main>section')],target=sections.find(el=>{const b=el.getBoundingClientRect();return b.top<=45&&b.bottom>45;});if(target){const rgb=getComputedStyle(target).backgroundColor.match(/[\d.]+/g);let light=false;if(rgb&&rgb.length>=3&&(rgb.length<4||+rgb[3]>.2))light=(+rgb[0]*.2126+ +rgb[1]*.7152+ +rgb[2]*.0722)>150;nav.classList.toggle('is-over-light',light);}}
function schedule(){if(!pending){pending=true;requestAnimationFrame(update);}}window.addEventListener('scroll',schedule,{passive:true});window.addEventListener('resize',schedule);update();
document.querySelectorAll('.ih-reveal').forEach(el=>el.classList.add('is-visible'));
})();

