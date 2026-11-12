/* Ricerca e Sviluppo — hero network visual and small layout helpers, ported
   from the approved concept. Loaded only on this page. */
// Due texture allineate. Il mouse rivela localmente il medesimo materiale wireframe.
function makeCursorStatueLayers(image){
 const width=image.naturalWidth,height=image.naturalHeight,split=Math.round(width*.48),wireElement=image.parentElement.querySelector('.statue-wire-source'),sample=document.createElement('canvas'),mask=document.createElement('canvas'),field=document.createElement('canvas');for(const c of [sample,mask,field]){c.width=width;c.height=height}
 const s=sample.getContext('2d',{willReadFrequently:true});s.drawImage(image,0,0);const raw=s.getImageData(0,0,width,height),pixels=raw.data,particles=[];
 for(let y=6;y<height;y+=12)for(let x=split+8;x<width;x+=12){const i=(y*width+x)*4;if(pixels[i+1]>42&&pixels[i+1]>pixels[i]*1.08&&pixels[i+1]>pixels[i+2]*1.1)particles.push({x,y,seed:particles.length})}
 tintStatuePixels(raw,false);s.putImageData(raw,0,0);
 return {image:sample,wire:null,wireElement,mask,field,width,height,split,particles};
}
function tintStatuePixels(imageData,all){const d=imageData.data;for(let i=0;i<d.length;i+=4){if(all||(d[i+1]>d[i]*1.06&&d[i+1]>d[i+2]*1.12&&d[i+1]-d[i]>6)){const shade=Math.min(1,d[i+1]/184);d[i]=Math.round(142*shade);d[i+1]=Math.round(184*shade);d[i+2]=Math.round(38*shade)}}}
function paintCursorStatue(ctx,layers,w,h,x,y,t,mx,my,inside){
 const {image,mask,field,width,height,split,particles,wireElement}=layers;
 if(!layers.wire&&wireElement?.complete&&wireElement.naturalWidth){const wire=document.createElement('canvas');wire.width=width;wire.height=height;const wc=wire.getContext('2d',{willReadFrequently:true});wc.drawImage(wireElement,0,0,width,height);const pixels=wc.getImageData(0,0,width,height);tintStatuePixels(pixels,true);wc.putImageData(pixels,0,0);layers.wire=wire}
 const wire=layers.wire,scale=Math.max(w/width,h/height)*1.055,dw=width*scale,dh=height*scale,ox=(w-dw)/2+x*10,oy=(h-dh)/2+y*8+Math.sin(t*.35)*2;
 ctx.drawImage(image,ox,oy,dw,dh);const sx=(mx-ox)/scale,sy=(my-oy)/scale,radius=Math.min(195,Math.min(w,h)*.34),sr=radius/scale,ready=!!wire,reveal=inside&&ready&&sx-sr*1.3<split&&sx+sr*1.3>0&&sy+sr*1.3>0&&sy-sr*1.3<height;
 // Pennellata organica: lobi ellittici asimmetrici, sfumati fino al centro.
 // Nessun cerchio netto, bordo lente o rivelazione globale temporizzata.
 if(reveal){const f=field.getContext('2d');f.clearRect(0,0,width,height);f.globalCompositeOperation='screen';const lobes=[[-.31,-.10,.92,.52,-.32,.90],[.32,-.03,.61,.79,.30,.72],[.06,.37,.76,.47,-.54,.65],[-.03,-.36,.52,.62,.16,.58]];
  lobes.forEach(([lx,ly,rx,ry,angle,opacity],i)=>{const dx=Math.sin(t*.28+i*1.7)*.035,dy=Math.cos(t*.23+i)*.035;f.save();f.translate(sx+(lx+dx)*sr,sy+(ly+dy)*sr);f.rotate(angle+Math.sin(t*.18+i)*.045);f.scale(rx*sr,ry*sr);const grad=f.createRadialGradient(0,0,0,0,0,1);grad.addColorStop(0,`rgba(255,255,255,${opacity})`);grad.addColorStop(.25,`rgba(255,255,255,${opacity*.84})`);grad.addColorStop(.62,`rgba(255,255,255,${opacity*.23})`);grad.addColorStop(1,'rgba(255,255,255,0)');f.fillStyle=grad;f.fillRect(-1,-1,2,2);f.restore()});f.globalCompositeOperation='source-over';
  const m=mask.getContext('2d');m.clearRect(0,0,width,height);m.globalCompositeOperation='source-over';m.drawImage(wire,0,0,width,height);m.globalCompositeOperation='destination-in';m.drawImage(field,0,0);m.globalCompositeOperation='source-over';ctx.save();ctx.beginPath();ctx.rect(ox,oy,split*scale,dh);ctx.clip();ctx.globalAlpha=.94;ctx.drawImage(mask,ox,oy,dw,dh);ctx.restore()}
 // La metà destra conserva la texture originale, con punti e filamenti reattivi.
 ctx.save();ctx.translate(ox,oy);ctx.scale(scale,scale);ctx.beginPath();ctx.rect(split+35,0,width-split-35,height);ctx.clip();
 for(let row=0;row<height;row+=14){const sh=Math.min(14,height-row),shift=Math.sin(row*.014+t*.65)*3.2+x*3;ctx.drawImage(image,split+35,row,width-split-35,sh,split+35+shift,row,width-split-35,sh)}
 for(const p of particles){const vx=p.x-sx,vy=p.y-sy,dist=Math.hypot(vx,vy),near=inside?Math.pow(Math.max(0,1-dist/sr),2):0,push=near*9,dx=Math.sin(t*.7+p.y*.012)*3.5+x*5+vx/(dist||1)*push,dy=Math.cos(t*.5+p.x*.012)*2.5+y*3+vy/(dist||1)*push;ctx.fillStyle=`rgba(142,184,38,${near>.04?.25+near*.55:.18+.18*Math.sin(t+p.seed*.35)})`;ctx.beginPath();ctx.arc(p.x+dx,p.y+dy,(p.seed%13===0?1.5:.75)+near*.6,0,Math.PI*2);ctx.fill();if(p.seed%17===0){ctx.strokeStyle='rgba(142,184,38,.16)';ctx.lineWidth=.6;ctx.beginPath();ctx.moveTo(p.x+dx,p.y+dy);ctx.lineTo(p.x+dx+20+Math.sin(t+p.seed)*8,p.y+dy);ctx.stroke()}}
 ctx.restore();return {active:reveal,ready,sx,sy,radius};
}


(()=>{
 const reduced=matchMedia('(prefers-reduced-motion:reduce)'),fine=matchMedia('(hover:hover) and (pointer:fine)');
 document.querySelectorAll('.culture-stage,.research-stage').forEach(stage=>{
  const hero=stage.closest('.immersive-hero'),canvas=stage.querySelector('canvas'),ctx=canvas.getContext('2d'),img=stage.querySelector('img'),culture=stage.classList.contains('culture-stage');if(!ctx)return;
  let w=1,h=1,dpr=1,t=0,last=0,raf=0,visible=true,x=0,y=0,tx=0,ty=0,active=0,aim=0,mx=0,my=0,morph=0,statueLayers=null;
  const nodes=Array.from({length:24},(_,i)=>{const a=i*2.39996,y=1-2*(i+.5)/24,r=Math.sqrt(1-y*y);return {x:Math.cos(a)*r,y,z:Math.sin(a)*r,size:i%5===0?1.5:1}});
  function start(){if(!raf&&visible&&!document.hidden)raf=requestAnimationFrame(draw)}
  function resize(){const r=stage.getBoundingClientRect();w=r.width;h=r.height;dpr=Math.min(devicePixelRatio,1.5);canvas.width=Math.round(w*dpr);canvas.height=Math.round(h*dpr);start()}
  function draw(now){raf=0;if(!visible||document.hidden)return;if(now-last<33&&!reduced.matches){raf=requestAnimationFrame(draw);return}const dt=Math.min(.05,(now-last)/1000);last=now;if(!reduced.matches)t+=dt;x+=(tx-x)*.05;y+=(ty-y)*.05;active+=(aim-active)*.08;ctx.setTransform(dpr,0,0,dpr,0,0);ctx.clearRect(0,0,w,h);
   if(culture){if(img.complete&&img.naturalWidth){if(!statueLayers)statueLayers=makeCursorStatueLayers(img);const state=paintCursorStatue(ctx,statueLayers,w,h,x,y,t,mx,my,aim===1);stage.classList.add('is-ready');stage.dataset.renderer='statue-cursor-reveal';stage.dataset.reveal=state.active?'1':'0';stage.dataset.wireReady=String(state.ready);stage.dataset.revealX=state.sx.toFixed(1);stage.dataset.revealY=state.sy.toFixed(1)}}
   else{const r=Math.min(w*.37,h*.34),cx=w*.51,cy=h*.48,angle=t*.10+x*.15;const pts=nodes.map(n=>{const xx=n.x*Math.cos(angle)+n.z*Math.sin(angle),zz=n.z*Math.cos(angle)-n.x*Math.sin(angle),yy=n.y*Math.cos(.2+y*.1)-zz*Math.sin(.2+y*.1),s=3.7/(3.7-zz);return {x:cx+xx*r*s,y:cy+yy*r*s,z:zz,s,base:n}});
    const glow=ctx.createRadialGradient(cx,cy,10,cx,cy,r*1.5);glow.addColorStop(0,'rgba(142,184,38,.07)');glow.addColorStop(1,'rgba(142,184,38,0)');ctx.fillStyle=glow;ctx.fillRect(0,0,w,h);
    for(let i=0;i<pts.length;i++)for(let j=i+1;j<pts.length;j++){const a=pts[i],b=pts[j],dist=Math.hypot(a.base.x-b.base.x,a.base.y-b.base.y,a.base.z-b.base.z);if(dist>.91)continue;ctx.strokeStyle=`rgba(142,184,38,${.13+Math.max(0,a.z+b.z)*.10})`;ctx.lineWidth=.8;ctx.beginPath();ctx.moveTo(a.x,a.y);ctx.lineTo(b.x,b.y);ctx.stroke();const f=(t*.16+i*.13+j*.07)%1;ctx.fillStyle='rgba(142,184,38,.85)';ctx.beginPath();ctx.arc(a.x+(b.x-a.x)*f,a.y+(b.y-a.y)*f,1.7,0,Math.PI*2);ctx.fill()}
    pts.sort((a,b)=>a.z-b.z);for(const p of pts){const near=Math.max(0,1-Math.hypot(p.x-mx,p.y-my)/140)*active,sz=(12+p.base.size*8)*p.s*(1+near*.30);ctx.beginPath();for(let k=0;k<=6;k++){const a=k/6*Math.PI*2+t*.025;const xx=p.x+Math.cos(a)*sz,yy=p.y+Math.sin(a)*sz;if(!k)ctx.moveTo(xx,yy);else ctx.lineTo(xx,yy)}const fill=ctx.createLinearGradient(p.x-sz,p.y-sz,p.x+sz,p.y+sz);fill.addColorStop(0,`rgba(142,184,38,${.13+near*.35})`);fill.addColorStop(1,'rgba(142,184,38,.4)');ctx.fillStyle=fill;ctx.fill();ctx.strokeStyle=`rgba(142,184,38,${.35+Math.max(0,p.z)*.4+near*.25})`;ctx.lineWidth=1;ctx.stroke();ctx.beginPath();ctx.arc(p.x,p.y,2.3*p.s,0,Math.PI*2);ctx.fillStyle=near>.1?'#eef5df':'#8EB826';ctx.fill()}
    stage.dataset.renderer='research-network';stage.classList.add('is-ready');
   }
   stage.dataset.hover=active.toFixed(2);stage.dataset.phase=t.toFixed(2);if(!reduced.matches)raf=requestAnimationFrame(draw);
  }
  function pointer(e){if(e.pointerType==='touch')return;const b=stage.getBoundingClientRect();mx=e.clientX-b.left;my=e.clientY-b.top;tx=reduced.matches?0:mx/w*2-1;ty=reduced.matches?0:my/h*2-1;aim=mx>=0&&mx<=w&&my>=0&&my<=h?1:0;start()}hero.addEventListener('pointermove',pointer,{passive:true});hero.addEventListener('mousemove',pointer,{passive:true});hero.addEventListener('pointerleave',()=>{tx=ty=aim=0;start()});hero.addEventListener('mouseleave',()=>{tx=ty=aim=0;start()});hero.addEventListener('pointerdown',e=>{if(culture&&e.pointerType==='touch'&&!e.target.closest('a,button')){aim=aim?0:1;start()}},{passive:true});img?.addEventListener('load',start);stage.querySelector('.statue-wire-source')?.addEventListener('load',start);new ResizeObserver(resize).observe(stage);new IntersectionObserver(e=>{visible=e[0].isIntersecting;if(visible)start();else{cancelAnimationFrame(raf);raf=0}},{threshold:.01}).observe(hero);document.addEventListener('visibilitychange',()=>{cancelAnimationFrame(raf);raf=0;start()});reduced.addEventListener('change',()=>{cancelAnimationFrame(raf);raf=0;tx=ty=aim=active=0;start()});resize();start();
 });
 document.querySelectorAll('.tech-selector').forEach(list=>{const tabs=[...list.querySelectorAll('[role=tab]')];function select(tab){tabs.forEach(t=>{const on=t===tab;t.setAttribute('aria-selected',String(on));t.tabIndex=on?0:-1;document.getElementById(t.getAttribute('aria-controls')).hidden=!on})}tabs.forEach((tab,i)=>{tab.addEventListener('click',()=>select(tab));tab.addEventListener('keydown',e=>{let next;if(e.key==='ArrowRight')next=(i+1)%tabs.length;if(e.key==='ArrowLeft')next=(i+tabs.length-1)%tabs.length;if(e.key==='Home')next=0;if(e.key==='End')next=tabs.length-1;if(next!==undefined){e.preventDefault();select(tabs[next]);tabs[next].focus()}})})});
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

