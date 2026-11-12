/* Ricerca e Sviluppo — hero art (WebGL gyroid specimen) and small layout helpers, ported
   from the approved concept. Loaded only on this page. */
(()=>{
 const reduced=matchMedia('(prefers-reduced-motion:reduce)'),fine=matchMedia('(hover:hover) and (pointer:fine)');
 /* Hero art (WebGL): a sphere carved from a gyroid lattice — the structure used in materials
    research and advanced manufacturing — lit from within by a lime core. The lattice slowly
    evolves (scale, thickness, flow) and turns towards the pointer. */
 document.querySelectorAll('.research-stage').forEach(stage=>{
  const hero=stage.closest('.immersive-hero'),canvas=stage.querySelector('canvas');
  const gl=canvas.getContext('webgl',{alpha:true,premultipliedAlpha:true,antialias:false,depth:false,powerPreference:'high-performance'});
  if(!gl){stage.classList.add('no-webgl');return}
  const FS=`precision highp float;
uniform vec2 uRes;uniform float uTime;uniform vec2 uRot;
const vec3 LIME=vec3(.557,.722,.149);
mat2 rot(float a){float c=cos(a),s=sin(a);return mat2(c,-s,s,c);}
vec3 P(vec3 p){p.xz*=rot(uRot.x);p.yz*=rot(uRot.y);return p;}
float gyr(vec3 p,float s){p*=s;return dot(sin(p),cos(p.yzx))/s;}
float SC;
vec2 map(vec3 p){
 p=P(p);
 float sph=length(p)-1.25;
 float g=abs(gyr(p+vec3(0.,uTime*.05,uTime*.03),SC))-(.026+.012*sin(uTime*.25+p.y*1.6));
 float lat=max(sph,g*.7);
 float core=length(p)-.22;
 return core<lat?vec2(core,2.):vec2(lat,abs(lat-sph)<.003?1.:0.);
}
vec3 nrm(vec3 p){vec2 e=vec2(.0015,0.);return normalize(vec3(map(p+e.xyy).x-map(p-e.xyy).x,map(p+e.yxy).x-map(p-e.yxy).x,map(p+e.yyx).x-map(p-e.yyx).x));}
float ao(vec3 p,vec3 n){float o=0.,w=1.;for(int i=1;i<5;i++){float h=.05*float(i);o+=(h-map(p+n*h).x)*w;w*=.62;}return clamp(1.-o*2.6,0.,1.);}
void main(){
 SC=3.3+.35*sin(uTime*.12);
 vec2 uv=(gl_FragCoord.xy-.5*uRes)/min(uRes.x,uRes.y);
 vec3 ro=vec3(0.,0.,5.4),rd=normalize(vec3(uv,-1.05));
 float t=0.,glow=0.;vec2 h=vec2(1.,0.);bool hit=false;
 // start at the bounding sphere
 float b=dot(ro,rd),c=dot(ro,ro)-1.6129,disc=b*b-c;
 if(disc>0.){t=max(0.,-b-sqrt(disc));
  for(int i=0;i<110;i++){vec3 p=ro+rd*t;h=map(p);float cd=length(p)-.22;glow+=exp(-max(cd,0.)*3.2)*.02;if(h.x<.0012){hit=true;break;}t+=h.x*.8;if(t>8.)break;}
 }
 vec3 col=vec3(0.);float a=0.;
 if(hit){vec3 p=ro+rd*t,n=nrm(p),q=P(p);float r=length(q);
  vec3 L=normalize(-p);
  float inner=(.25+.75*max(dot(n,L),0.))*exp(-r*1.5)*4.2;
  float key=max(dot(n,normalize(vec3(-.55,.75,.6))),0.);
  float o=ao(p,n);
  float fr=pow(1.-max(dot(n,-rd),0.),4.);
  vec3 cc=vec3(.035,.04,.033)*(.35+.65*key)*o;
  cc+=LIME*inner*o;
  cc+=vec3(.75,.82,.68)*fr*.18*o;
  cc+=vec3(1.)*pow(max(dot(reflect(rd,n),normalize(vec3(-.55,.75,.6))),0.),90.)*.25*o;
  if(h.y>1.5){cc=mix(LIME*1.6,vec3(1.,1.,.85),.35)*(.7+.3*max(dot(n,-rd),0.));}
  else if(h.y>.5){cc=mix(LIME,vec3(.95,1.,.8),.28)*(.55+.45*key)*1.15+LIME*inner*.3;}
  col=cc;a=1.;}
 // faint glass shell around the specimen
 if(disc>0.){float tt=-b-sqrt(disc);vec3 sp=ro+rd*tt,sn=normalize(sp);float rim=pow(1.-max(dot(sn,-rd),0.),3.5);vec3 shell=mix(vec3(.8,.85,.75),LIME,.5)*rim*.38+vec3(1.)*pow(max(dot(reflect(rd,sn),normalize(vec3(-.55,.75,.6))),0.),80.)*.6;col+=shell;a=max(a,min(1.,rim*.38+.0));}
 vec3 g=LIME*min(glow,1.2)*.75;col=col+g*(1.-a);a=max(a,min(glow*.75,1.));
 col=col/(1.+col*.25);
 gl_FragColor=vec4(col,a);
}`;
  const prog=program(gl,FS);if(!prog){stage.classList.add('no-webgl');return}
  const uRes=gl.getUniformLocation(prog,'uRes'),uTime=gl.getUniformLocation(prog,'uTime'),uRot=gl.getUniformLocation(prog,'uRot');
  let w=1,h=1,t=0,last=0,raf=0,visible=true,px=0,py=0,tx=0,ty=0;
  function resize(){const r=stage.getBoundingClientRect();w=Math.max(1,r.width);h=Math.max(1,r.height);const cap=w<700?520:760,s=Math.min((devicePixelRatio||1)*.85,cap/Math.max(w,h));canvas.width=Math.round(w*s);canvas.height=Math.round(h*s);gl.viewport(0,0,canvas.width,canvas.height);start()}
  function start(){if(!raf&&visible&&!document.hidden)raf=requestAnimationFrame(frame)}
  function frame(now){raf=0;if(!visible||document.hidden)return;if(!reduced.matches&&now-last<33){raf=requestAnimationFrame(frame);return}
   const dt=Math.min(.06,(now-last)/1000||0);last=now;if(!reduced.matches)t+=dt;else t=8;px+=(tx-px)*.05;py+=(ty-py)*.05;
   gl.useProgram(prog);gl.uniform2f(uRes,canvas.width,canvas.height);gl.uniform1f(uTime,t);gl.uniform2f(uRot,t*.07+px*.6,.32+py*.35);
   gl.clearColor(0,0,0,0);gl.clear(gl.COLOR_BUFFER_BIT);gl.drawArrays(gl.TRIANGLES,0,3);
   stage.classList.add('is-ready');stage.dataset.renderer='gyroid-specimen';
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

