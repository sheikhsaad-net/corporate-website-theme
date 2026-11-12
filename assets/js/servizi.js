/* Servizi page — hero art (WebGL liquid convergence), sector-row light flow and small
   layout helpers, ported from the approved concept. Loaded only on /servizi/. */
(()=>{
 const reduced=matchMedia('(prefers-reduced-motion: reduce)'),fine=matchMedia('(hover:hover) and (pointer:fine)');
 /* Hero art (WebGL): "Competenze diverse. Un unico progetto."
    Five liquid-chrome drops (the competences) orbit a central form (the project), slowly flow
    into it and merge into a single shape, then separate again. Labels follow the drops. */
 document.querySelectorAll('.orb-stage').forEach(stage=>{
  const hero=stage.closest('.immersive-hero'),canvas=stage.querySelector('canvas');
  const gl=canvas.getContext('webgl',{alpha:true,premultipliedAlpha:true,antialias:false,depth:false,powerPreference:'high-performance'});
  if(!gl){stage.classList.add('no-webgl');return}
  const FS=`precision highp float;
uniform vec2 uRes;uniform vec4 uB[6];
const vec3 LIME=vec3(.557,.722,.149);
float smin(float a,float b,float k){float h=clamp(.5+.5*(b-a)/k,0.,1.);return mix(b,a,h)-k*h*(1.-h);}
float map(vec3 p){float d=length(p-uB[0].xyz)-uB[0].w;
 for(int i=1;i<6;i++)d=smin(d,length(p-uB[i].xyz)-uB[i].w,.5);
 return d;}
vec3 nrm(vec3 p){vec2 e=vec2(.0012,0.);return normalize(vec3(map(p+e.xyy)-map(p-e.xyy),map(p+e.yxy)-map(p-e.yxy),map(p+e.yyx)-map(p-e.yyx)));}
vec3 env(vec3 r){
 vec3 c=vec3(.01,.012,.009);
 c+=vec3(.9,.93,.86)*smoothstep(-.05,.95,r.y)*.42;
 c+=vec3(1.)*pow(max(dot(r,normalize(vec3(-.8,.35,.5))),0.),140.)*.9;
 c+=vec3(.85,.9,.8)*pow(max(dot(r,normalize(vec3(-.8,.35,.5))),0.),7.)*.22;
 c+=vec3(1.)*exp(-abs(r.y-.05)*22.)*.28;
 c+=LIME*pow(max(dot(r,normalize(vec3(.85,-.45,.3))),0.),2.)*1.35;
 c+=LIME*pow(max(dot(r,normalize(vec3(.2,-1.,.1))),0.),3.)*.6;
 return c;}
void main(){
 vec2 uv=(gl_FragCoord.xy-.5*uRes)/min(uRes.x,uRes.y);
 vec3 ro=vec3(0.,0.,5.),rd=normalize(vec3(uv,-1.));
 float t=0.,d=1.,glow=0.;bool hit=false;
 for(int i=0;i<90;i++){vec3 p=ro+rd*t;d=map(p);glow+=exp(-max(d,0.)*7.)*.011;if(d<.0015){hit=true;break;}t+=d*.92;if(t>8.)break;}
 vec3 col=vec3(0.);float a=0.;
 if(hit){vec3 p=ro+rd*t,n=nrm(p),r=reflect(rd,n);
  float fr=pow(1.-max(dot(n,-rd),0.),3.);
  float near=0.;for(int i=0;i<6;i++){float q=length(p-uB[i].xyz)-uB[i].w;near+=exp(-max(q,0.)*9.);}
  float sch=.18+.82*pow(1.-max(dot(n,-rd),0.),5.);
  vec3 c=vec3(.01,.012,.009)+env(r)*sch*1.25;
  c+=vec3(1.,1.,.96)*pow(max(dot(r,normalize(vec3(-.45,.75,.5))),0.),260.)*1.1;
  c+=LIME*fr*.22;
  c+=LIME*smoothstep(1.15,1.9,near)*.28*(1.-fr);
  col=c;a=1.;}
 vec3 halo=LIME*min(glow,1.)*.85;
 col=col*a+halo*(1.-a);a=max(a,min(glow,1.)*.85);
 col=col/(1.+col*.3);
 gl_FragColor=vec4(col,a);
}`;
  const prog=program(gl,FS);if(!prog){stage.classList.add('no-webgl');return}
  const uRes=gl.getUniformLocation(prog,'uRes'),uB=gl.getUniformLocation(prog,'uB');
  const tags=[...stage.querySelectorAll('.orb-tag')],N=5,B=new Float32Array(24);
  let w=1,h=1,t=0,last=0,raf=0,visible=true,px=0,py=0,tx=0,ty=0,tagW=[],tagH=[];
  const ease=x=>x*x*(3-2*x);
  function resize(){const r=stage.getBoundingClientRect();w=Math.max(1,r.width);h=Math.max(1,r.height);const cap=w<700?560:860,s=Math.min((devicePixelRatio||1)*.9,cap/Math.max(w,h));canvas.width=Math.round(w*s);canvas.height=Math.round(h*s);gl.viewport(0,0,canvas.width,canvas.height);tagW=tags.map(g=>g.offsetWidth||110);tagH=tags.map(g=>g.offsetHeight||34);start()}
  function start(){if(!raf&&visible&&!document.hidden)raf=requestAnimationFrame(frame)}
  // same camera as the shader: eye at z=5, focal 1, scale = min(w,h)
  function toScreen(x,y,z){const m=Math.min(w,h),k=1/(5-z);return [w/2+x*k*m,h/2-y*k*m]}
  function pose(i,a,radius,s){const yaw=px*.35,pitch=.42+py*.18;let x=Math.cos(a)*radius,y=Math.sin(t*.5+i*1.7)*.14*s,z=Math.sin(a)*radius;let c=Math.cos(yaw),q=Math.sin(yaw);[x,z]=[x*c+z*q,z*c-x*q];c=Math.cos(pitch);q=Math.sin(pitch);[y,z]=[y*c-z*q,y*q+z*c];return [x,y,z]}
  function frame(now){raf=0;if(!visible||document.hidden)return;if(!reduced.matches&&now-last<33){raf=requestAnimationFrame(frame);return}
   const dt=Math.min(.06,(now-last)/1000||0);last=now;if(!reduced.matches)t+=dt;else t=6.3;px+=(tx-px)*.05;py+=(ty-py)*.05;
   const s=ease(.5-.5*Math.cos(t*.3+Math.PI*.9)),radius=.5+1.0*s;
   B[0]=0;B[1]=Math.sin(t*.6)*.04;B[2]=0;B[3]=.6+.05*(1-s)+.015*Math.sin(t*1.3);
   const pts=[];
   for(let i=0;i<N;i++){const a=t*.2+i/N*Math.PI*2,p=pose(i,a,radius,s),o=4*(i+1);B[o]=p[0];B[o+1]=p[1];B[o+2]=p[2];B[o+3]=.34+.03*Math.sin(t*.9+i*2.1);pts.push({i,a,p})}
   gl.useProgram(prog);gl.uniform2f(uRes,canvas.width,canvas.height);gl.uniform4fv(uB,B);gl.clearColor(0,0,0,0);gl.clear(gl.COLOR_BUFFER_BIT);gl.drawArrays(gl.TRIANGLES,0,3);
   // labels sit on the outer orbit, outside the drops, and dim while everything merges
   pts.forEach(({i,a})=>{const tg=tags[i];if(!tg)return;const o=pose(i,a,Math.max(radius,1.05),1),[sx,sy]=toScreen(o[0],o[1],o[2]),[cx,cy]=toScreen(0,0,0),dx=sx-cx,dy=sy-cy,l=Math.hypot(dx,dy)||1,ux=dx/l,uy=dy/l,tw=tagW[i],th=tagH[i],rs=.37/(5-o[2])*Math.min(w,h)+12;
    let X=sx+ux*(rs+tw/2)-tw/2,Y=sy+uy*(rs*.75+th/2)-th/2;X=Math.max(2,Math.min(w-tw-2,X));Y=Math.max(2,Math.min(h-th-2,Y));
    const depth=(o[2]+1.5)/3;tg.style.transform=`translate(${X.toFixed(1)}px,${Y.toFixed(1)}px)`;tg.style.opacity=((.35+.65*depth)*(.4+.6*s)).toFixed(2)});
   stage.classList.add('is-ready');stage.dataset.renderer='liquid-convergence';
   if(!reduced.matches)raf=requestAnimationFrame(frame);
  }
  hero.addEventListener('pointermove',e=>{if(e.pointerType==='touch'||reduced.matches||!fine.matches)return;const b=stage.getBoundingClientRect();tx=Math.max(-1,Math.min(1,(e.clientX-b.left)/b.width*2-1));ty=Math.max(-1,Math.min(1,(e.clientY-b.top)/b.height*2-1));start()});
  hero.addEventListener('pointerleave',()=>{tx=ty=0});
  canvas.addEventListener('webglcontextlost',e=>{e.preventDefault();cancelAnimationFrame(raf);raf=0});
  new ResizeObserver(resize).observe(stage);
  new IntersectionObserver(([en])=>{visible=en.isIntersecting;if(visible)start();else{cancelAnimationFrame(raf);raf=0}},{threshold:.01}).observe(hero);
  document.addEventListener('visibilitychange',()=>{cancelAnimationFrame(raf);raf=0;start()});
  reduced.addEventListener('change',()=>{cancelAnimationFrame(raf);raf=0;tx=ty=0;start()});
  resize();
 });
 function program(gl,fs){
  const mk=(type,src)=>{const s=gl.createShader(type);gl.shaderSource(s,src);gl.compileShader(s);if(!gl.getShaderParameter(s,gl.COMPILE_STATUS)){console.warn(gl.getShaderInfoLog(s));return null}return s};
  const v=mk(gl.VERTEX_SHADER,'attribute vec2 p;void main(){gl_Position=vec4(p,0.,1.);}'),f=mk(gl.FRAGMENT_SHADER,fs);if(!v||!f)return null;
  const p=gl.createProgram();gl.attachShader(p,v);gl.attachShader(p,f);gl.linkProgram(p);if(!gl.getProgramParameter(p,gl.LINK_STATUS))return null;gl.useProgram(p);
  const b=gl.createBuffer();gl.bindBuffer(gl.ARRAY_BUFFER,b);gl.bufferData(gl.ARRAY_BUFFER,new Float32Array([-1,-1,3,-1,-1,3]),gl.STATIC_DRAW);
  const l=gl.getAttribLocation(p,'p');gl.enableVertexAttribArray(l);gl.vertexAttribPointer(l,2,gl.FLOAT,false,0,0);return p;
 }
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

