/* Servizi page — hero point-sphere (orb), sector-row light flow and small
   layout helpers, ported from the approved concept. Loaded only on /servizi/. */
(()=>{
 const reduced=matchMedia('(prefers-reduced-motion: reduce)'),fine=matchMedia('(hover:hover) and (pointer:fine)');
 document.querySelectorAll('.orb-stage').forEach(stage=>{
  const hero=stage.closest('.immersive-hero'),canvas=stage.querySelector('canvas'),ctx=canvas.getContext('2d');if(!ctx)return;
  let w=1,h=1,dpr=1,t=0,frame=0,last=0,visible=true,px=0,py=0,tx=0,ty=0,mx=0,my=0,hover=0,hoverTarget=0;
  const count=matchMedia('(max-width:760px)').matches?500:900;
  const points=Array.from({length:count},(_,i)=>{const y=1-2*(i+.5)/count,a=i*2.3999632297,s=Math.sqrt(1-y*y);return {x:Math.cos(a)*s,y,z:Math.sin(a)*s,seed:i}});
  const tags=[...stage.querySelectorAll('.orb-tag')];
  function rotate(x,y,z,spin){const a=spin+px*.14,c=Math.cos(a),s=Math.sin(a);let xx=x*c+z*s,zz=z*c-x*s;const tilt=-.16+py*.1;return {x:xx,y:y*Math.cos(tilt)-zz*Math.sin(tilt),z:y*Math.sin(tilt)+zz*Math.cos(tilt)}}
  function dimensions(){return {r:Math.min(w*.225,h*.245),cx:w*.53+px*5,cy:h*.51+py*4+Math.sin(t*.45)*7}}
  function project(p,D){return {x:D.cx+p.x*D.r,y:D.cy+p.y*D.r,z:p.z,scale:1+p.z*.08}}
  const phases=[-2.35,-.85,2.95,.45,1.70],tilts=[-1.05,-.35,.45,1.18,1.85],inclinations=[.70,1.10,.85,1.20,.95];
  function orbit(i,a){const radius=1.15+i*.23,x=Math.cos(a)*radius,y=Math.sin(a)*radius*Math.cos(inclinations[i]),z=Math.sin(a)*radius*Math.sin(inclinations[i]),angle=tilts[i];return {x:x*Math.cos(angle)-y*Math.sin(angle),y:x*Math.sin(angle)+y*Math.cos(angle),z}}
  function orbitPoint(i,a,D,spin){const p=orbit(i,a);return project(rotate(p.x,p.y,p.z,spin),D)}
  function orbitHalf(D,spin,front){for(let i=0;i<5;i++){ctx.beginPath();let previous=orbitPoint(i,0,D,spin);for(let j=1;j<=180;j++){const p=orbitPoint(i,j/180*Math.PI*2,D,spin);if(((previous.z+p.z)/2>=0)===front){ctx.moveTo(previous.x,previous.y);ctx.lineTo(p.x,p.y)}previous=p}ctx.strokeStyle=`rgba(142,184,38,${front?.63+i*.035:.20+i*.015})`;ctx.lineWidth=front?1.25:.8;ctx.stroke()}}
  function lineCurve(sample,D,spin,alpha){ctx.beginPath();for(let j=0;j<=110;j++){const q=sample(j/110*Math.PI*2);const p=project(rotate(q.x,q.y,q.z,spin),D);if(j===0)ctx.moveTo(p.x,p.y);else ctx.lineTo(p.x,p.y)}ctx.strokeStyle=`rgba(142,184,38,${alpha})`;ctx.lineWidth=1.05;ctx.stroke()}
  function paint(now){frame=0;if(!visible||document.hidden)return;if(now-last<33&&!reduced.matches){frame=requestAnimationFrame(paint);return}const dt=Math.min((now-last)/1000,.05);last=now;if(!reduced.matches)t+=dt;px+=(tx-px)*.055;py+=(ty-py)*.055;hover+=(hoverTarget-hover)*.10;ctx.setTransform(dpr,0,0,dpr,0,0);ctx.clearRect(0,0,w,h);const D=dimensions(),spin=t*.032;
   orbitHalf(D,spin,false);
   const glow=ctx.createRadialGradient(D.cx,D.cy,D.r*.1,D.cx,D.cy,D.r*1.25);glow.addColorStop(0,'rgba(142,184,38,.065)');glow.addColorStop(1,'rgba(142,184,38,0)');ctx.fillStyle=glow;ctx.fillRect(0,0,w,h);
   for(let lat=1;lat<5;lat++){const v=-Math.PI/2+lat/5*Math.PI,sy=Math.sin(v),sr=Math.cos(v);lineCurve(a=>{const ripple=1+.025*Math.sin(a*3+sy*5+t*.28);return {x:Math.cos(a)*sr*ripple,y:sy+.025*Math.sin(a*2+t*.2)*sr,z:Math.sin(a)*sr*ripple}},D,spin,.10+(lat%4===0?.055:0))}
   for(let mer=0;mer<3;mer++){const a=mer/3*Math.PI;lineCurve(v=>({x:Math.cos(a)*Math.cos(v),y:Math.sin(v),z:Math.sin(a)*Math.cos(v)}),D,spin,.085)}
   const screen=[];for(const p of points){const wave=1+.022*Math.sin(p.y*7+p.z*4+t*.3)+.012*Math.sin(p.x*11-t*.2);screen.push({...project(rotate(p.x*wave,p.y*wave,p.z*wave,spin),D),seed:p.seed})}screen.sort((a,b)=>a.z-b.z);
   const influence=Math.min(155,D.r*.58);
   if(hover>.01){const halo=ctx.createRadialGradient(mx,my,0,mx,my,influence);halo.addColorStop(0,`rgba(142,184,38,${hover*.10})`);halo.addColorStop(1,'rgba(142,184,38,0)');ctx.fillStyle=halo;ctx.fillRect(mx-influence,my-influence,influence*2,influence*2)}
   for(const p of screen){const light=(p.z+1)/2,alpha=.10+light*.39,bright=p.seed%37===0;let dx=p.x-mx,dy=p.y-my,dist=Math.hypot(dx,dy);const near=Math.pow(Math.max(0,1-dist/influence),2)*hover*(.25+light*.75),push=near*25;const x=p.x+dx/(dist||1)*push,y=p.y+dy/(dist||1)*push;const r=142,g=184,b=38;ctx.fillStyle=near>.04?`rgba(${r},${g},${b},${Math.min(1,alpha+near*.45)})`:bright?`rgba(142,184,38,${Math.min(1,alpha+.07)})`:`rgba(142,184,38,${alpha})`;const radius=((bright?1.25:.65+light*.40)+near*.95)*p.scale;ctx.beginPath();ctx.arc(x,y,radius,0,Math.PI*2);ctx.fill()}
   orbitHalf(D,spin,true);
   // Anchors travel along actual 3D circles centred on the point sphere.
   const placements=tags.map((tag,i)=>{const q=orbitPoint(i,phases[i]+t*(.035+i*.004),D,spin),side=q.x>=D.cx?1:-1,tw=tag.offsetWidth,th=tag.offsetHeight;let x=q.x+side*(tw*.5+24),y=q.y;return {tag,i,q,side,tw,th,x:Math.max(tw/2+10,Math.min(w-tw/2-10,x)),y:Math.max(th/2+16,Math.min(h-th/2-16,y))}});
   // Keep every label clear of the editorial text, including during rotation.
   const stageBox=stage.getBoundingClientRect(),obstacles=[...hero.querySelectorAll('h1,.ih-new-copy,.ih-new-actions,.ih-new-top')].map(e=>e.getBoundingClientRect());
   placements.forEach(p=>{for(const b of obstacles){const left=b.left-stageBox.left,right=b.right-stageBox.left,top=b.top-stageBox.top,bottom=b.bottom-stageBox.top;if(p.x+p.tw/2>left-18&&p.x-p.tw/2<right+18&&p.y+p.th/2>top-18&&p.y-p.th/2<bottom+18)p.x=Math.min(w-p.tw/2-10,right+p.tw/2+24)}});
   // Separate label rectangles while keeping the leader on its original orbit.
   for(let pass=0;pass<5;pass++)for(let i=0;i<placements.length;i++)for(let j=i+1;j<placements.length;j++){const a=placements[i],b=placements[j],gap=(a.th+b.th)/2+40;if(Math.abs(a.x-b.x)<(a.tw+b.tw)/2+18&&Math.abs(a.y-b.y)<gap){const direction=a.y<=b.y?1:-1,shift=(gap-Math.abs(a.y-b.y))/2;a.y-=direction*shift;b.y+=direction*shift;a.y=Math.max(a.th/2+12,Math.min(h-a.th/2-12,a.y));b.y=Math.max(b.th/2+12,Math.min(h-b.th/2-12,b.y))}}
   placements.forEach(p=>{for(const b of obstacles){const right=b.right-stageBox.left,top=b.top-stageBox.top,bottom=b.bottom-stageBox.top;if(p.x-p.tw/2<right+24&&p.y+p.th/2>top-24&&p.y-p.th/2<bottom+24)p.x=Math.min(w-p.tw/2-12,right+p.tw/2+30)}});
   placements.forEach(({tag,i,q,side,tw,x,y})=>{tag.style.transform=`translate3d(${x.toFixed(2)}px,${y.toFixed(2)}px,0) translate(-50%,-50%)`;tag.style.opacity='.94';const edge=x-(x>=q.x?1:-1)*tw*.5,elbow=(edge+q.x)*.5;ctx.beginPath();ctx.moveTo(q.x,q.y);ctx.lineTo(elbow,y);ctx.lineTo(edge,y);ctx.strokeStyle='rgba(142,184,38,.52)';ctx.lineWidth=.9;ctx.stroke();ctx.beginPath();ctx.arc(q.x,q.y,2.7,0,Math.PI*2);ctx.fillStyle='#8EB826';ctx.fill();tag.dataset.orbit=String(i+1);tag.dataset.anchor=`${q.x.toFixed(1)},${q.y.toFixed(1)}`});
   stage.classList.add('is-ready');stage.dataset.renderer='point-cloud';stage.dataset.phase=t.toFixed(2);stage.dataset.hover=hover.toFixed(2);if(!reduced.matches)frame=requestAnimationFrame(paint);
  }
  function start(){if(!frame&&visible&&!document.hidden)frame=requestAnimationFrame(paint)}
  function resize(){const b=stage.getBoundingClientRect();w=b.width;h=b.height;dpr=Math.min(devicePixelRatio,1.6);canvas.width=Math.round(w*dpr);canvas.height=Math.round(h*dpr);start()}
  hero.addEventListener('pointermove',e=>{if(!fine.matches||reduced.matches)return;const b=hero.getBoundingClientRect(),s=stage.getBoundingClientRect();tx=(e.clientX-b.left)/b.width*2-1;ty=(e.clientY-b.top)/b.height*2-1;mx=e.clientX-s.left;my=e.clientY-s.top;const D=dimensions();hoverTarget=Math.hypot(mx-D.cx,my-D.cy)<D.r*1.08?1:0},{passive:true});hero.addEventListener('pointerleave',()=>{tx=ty=0;hoverTarget=0});
  new ResizeObserver(resize).observe(stage);new IntersectionObserver(e=>{visible=e[0].isIntersecting;if(visible)start();else{cancelAnimationFrame(frame);frame=0}},{threshold:.01}).observe(hero);document.addEventListener('visibilitychange',()=>{cancelAnimationFrame(frame);frame=0;start()});reduced.addEventListener('change',()=>{cancelAnimationFrame(frame);frame=0;tx=ty=0;hover=hoverTarget=0;start()});resize();start();
 });
})();





(()=>{
const reduced=matchMedia('(prefers-reduced-motion:reduce)');
document.querySelectorAll('.sector-row').forEach(row=>{
 const canvas=document.createElement('canvas');canvas.className='sector-flow';canvas.setAttribute('aria-hidden','true');row.prepend(canvas);const ctx=canvas.getContext('2d');if(!ctx)return;
 let w=1,h=1,dpr=1,x=0,y=0,tx=0,ty=0,vx=0,vy=0,alpha=0,active=false,raf=0,last=0,time=0;
 function resize(){const b=row.getBoundingClientRect();w=b.width;h=b.height;dpr=Math.min(devicePixelRatio,1.5);canvas.width=Math.round(w*dpr);canvas.height=Math.round(h*dpr);}
 new ResizeObserver(resize).observe(row);
 function edgeCurve(width,lift){ctx.beginPath();ctx.moveTo(x-width*.5,h-1.5);ctx.bezierCurveTo(x-width*.22,h-1.5-lift,x+width*.2,h-1.5-lift*.65,x+width*.5,h-1.5);}
 function paint(now){raf=0;const dt=Math.min((now-last)/1000||.016,.05);last=now;time+=dt;const damping=1-Math.exp(-dt*22),oldX=x,oldY=y;x+=(tx-x)*damping;y+=(ty-y)*damping;vx+=(Math.max(-20,Math.min(20,(x-oldX)/dt/60))-vx)*(1-Math.exp(-dt*10));vy+=(Math.max(-16,Math.min(16,(y-oldY)/dt/60))-vy)*(1-Math.exp(-dt*10));alpha+=((active?1:0)-alpha)*(1-Math.exp(-dt*(active?14:7)));
  ctx.setTransform(dpr,0,0,dpr,0,0);ctx.clearRect(0,0,w,h);if(alpha<.008&&!active)return;
  const width=Math.min(w*.58,400+Math.abs(vx)*7),lift=3+Math.sin(time*1.3)*1.2+Math.min(3,Math.abs(vy)*.2),center=Math.max(0,Math.min(1,x/w)),left=Math.max(0,Math.min(1,(x-width*.5)/w)),right=Math.max(0,Math.min(1,(x+width*.5)/w));
  ctx.save();ctx.globalAlpha=alpha;const edge=ctx.createLinearGradient(0,0,w,0);edge.addColorStop(0,'#ffffff10');edge.addColorStop(left,'#ffffff18');edge.addColorStop(center,'#ffffffb8');edge.addColorStop(right,'#ffffff18');edge.addColorStop(1,'#ffffff10');ctx.strokeStyle=edge;ctx.lineWidth=1;ctx.beginPath();ctx.moveTo(0,h-1.2);ctx.lineTo(w,h-1.2);ctx.stroke();
  const local=ctx.createLinearGradient(x-width*.5,0,x+width*.5,0);local.addColorStop(0,'#ffffff00');local.addColorStop(.25,'#ffffff0b');local.addColorStop(.5,'#ffffff55');local.addColorStop(.75,'#ffffff0b');local.addColorStop(1,'#ffffff00');ctx.strokeStyle=local;ctx.lineCap='round';
  ctx.filter='blur(13px)';ctx.lineWidth=28;edgeCurve(width,lift);ctx.stroke();ctx.filter='blur(4px)';ctx.lineWidth=6;edgeCurve(width,lift);ctx.stroke();ctx.filter='blur(.4px)';ctx.lineWidth=1.1;edgeCurve(width,lift);ctx.stroke();ctx.restore();
  if(!document.hidden)raf=requestAnimationFrame(paint);
 }
 function start(){if(!raf){last=performance.now();raf=requestAnimationFrame(paint);}}
 row.addEventListener('pointerenter',e=>{if(reduced.matches||e.pointerType==='touch')return;const b=row.getBoundingClientRect();x=tx=e.clientX-b.left;y=ty=e.clientY-b.top;active=true;start();},{passive:true});
 row.addEventListener('pointermove',e=>{if(reduced.matches||e.pointerType==='touch')return;const b=row.getBoundingClientRect();tx=e.clientX-b.left;ty=e.clientY-b.top;active=true;start();},{passive:true});
 row.addEventListener('pointerleave',()=>{active=false;start();});
 document.addEventListener('visibilitychange',()=>{if(document.hidden){cancelAnimationFrame(raf);raf=0;active=false;alpha=0;ctx.clearRect(0,0,canvas.width,canvas.height);}});
 reduced.addEventListener('change',()=>{cancelAnimationFrame(raf);raf=0;active=false;alpha=0;ctx.clearRect(0,0,canvas.width,canvas.height);});resize();
});
})();

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

