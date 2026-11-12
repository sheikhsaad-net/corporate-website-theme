/* Soluzioni Culturali Creative — hero statue/VR-headset reveal, topographic
   background lines and small layout helpers, ported from the approved concept.
   Loaded only on this page. */
(()=>{'use strict';
const hero=document.querySelector('.vr-hero');if(!hero)return;
const object=hero.querySelector('.vr-object'),layers=hero.querySelector('.vr-device-layers'),image=layers.querySelector('.vr-headset'),hit=hero.querySelector('.vr-hit-area');
const reduced=matchMedia('(prefers-reduced-motion:reduce)'),mobile=matchMedia('(max-width:760px)').matches;
const settings={scanDuration:5.5,trailSeconds:2.5,cursorFactor:.28,idleCursorFactor:.045,mouseLead:.90,revealDiameter:.22};
hero.dataset.fluidSettings=JSON.stringify(settings);
const canvas=document.createElement('canvas');canvas.className='vr-fluid-canvas';layers.append(canvas);
const gl=canvas.getContext('webgl2',{alpha:true,antialias:false,premultipliedAlpha:false,powerPreference:'low-power'});
if(!gl||!gl.getExtension('EXT_color_buffer_float')){hero.dataset.renderer='static-wireframe';canvas.remove();return;}
const vertex=`#version 300 es
in vec2 position;out vec2 uv;void main(){uv=position*.5+.5;gl_Position=vec4(position,0.,1.);}`;
const noise=`float hash(vec3 p){p=fract(p*.3183099+vec3(.13,.37,.71));p*=17.;return fract(p.x*p.y*p.z*(p.x+p.y+p.z));}
float noise3(vec3 p){vec3 i=floor(p),f=fract(p);f=f*f*(3.-2.*f);return mix(mix(mix(hash(i),hash(i+vec3(1,0,0)),f.x),mix(hash(i+vec3(0,1,0)),hash(i+vec3(1,1,0)),f.x),f.y),mix(mix(hash(i+vec3(0,0,1)),hash(i+vec3(1,0,1)),f.x),mix(hash(i+vec3(0,1,1)),hash(i+vec3(1)),f.x),f.y),f.z);}
float fbm(vec3 p){return .57*noise3(p)+.28*noise3(p*2.03)+.15*noise3(p*4.09);}`;
function program(v,f){const p=gl.createProgram();for(const [type,src]of [[gl.VERTEX_SHADER,v],[gl.FRAGMENT_SHADER,f]]){const s=gl.createShader(type);gl.shaderSource(s,src);gl.compileShader(s);if(!gl.getShaderParameter(s,gl.COMPILE_STATUS))throw Error(gl.getShaderInfoLog(s));gl.attachShader(p,s);}gl.linkProgram(p);if(!gl.getProgramParameter(p,gl.LINK_STATUS))throw Error(gl.getProgramInfoLog(p));return p;}
function frag(body){return `#version 300 es\nprecision highp float;in vec2 uv;out vec4 color;uniform sampler2D state,pressure,divergence,photo;uniform vec2 texel,cursor,force;uniform float dt,time,injection,revealRadius,dyeDecay;${noise}\nvoid main(){${body}}`;}
try{
// Back-trace correction adapted from the user's FluidReveal source, retaining
// a separate persistent density field and soft material compositing.
const advect=program(vertex,frag(`vec2 back=uv-texture(state,uv).xy*dt;vec2 error=(back+texture(state,back).xy*dt-uv)*.5;vec2 corrected=uv-error;vec4 s=texture(state,corrected-texture(state,corrected).xy*dt);vec2 v=s.xy*exp(-1.3*dt);float d=s.z*exp(-dyeDecay*dt);vec2 q=(uv-cursor)*vec2(.75,1.);q+=vec2(fbm(vec3(uv*12.,time*.18)),fbm(vec3(uv*12.+5.,time*.18)))*.038-.019;float angle=atan(q.y,q.x);float radius=revealRadius+sin(angle*3.+time*.27)*.012+cos(angle*5.-time*.15)*.008;float g=exp(-dot(q,q)/(radius*radius*.52))*injection;v+=force*g*dt*1.5;d=min(1.35,max(d,g*1.1)+g*dt*.65);color=vec4(clamp(v,vec2(-.55),vec2(.55)),d,1.);`));
const divergence=program(vertex,frag(`float l=texture(state,uv-vec2(texel.x,0)).x,r=texture(state,uv+vec2(texel.x,0)).x,b=texture(state,uv-vec2(0,texel.y)).y,t=texture(state,uv+vec2(0,texel.y)).y;color=vec4(.5*((r-l)+(t-b)),0,0,1);`));
const pressure=program(vertex,frag(`float l=texture(pressure,uv-vec2(texel.x,0)).x,r=texture(pressure,uv+vec2(texel.x,0)).x,b=texture(pressure,uv-vec2(0,texel.y)).x,t=texture(pressure,uv+vec2(0,texel.y)).x;color=vec4((l+r+b+t-texture(divergence,uv).x)*.25,0,0,1);`));
const project=program(vertex,frag(`vec4 s=texture(state,uv);float l=texture(pressure,uv-vec2(texel.x,0)).x,r=texture(pressure,uv+vec2(texel.x,0)).x,b=texture(pressure,uv-vec2(0,texel.y)).x,t=texture(pressure,uv+vec2(0,texel.y)).x;s.xy-=vec2(r-l,t-b)*.5;color=s;`));
const material=program(vertex,frag(`vec2 fitted=uv;if(uv.x>.64)fitted.x=.64+(uv.x-.64)/1.30;vec4 p=texture(photo,fitted);float d=texture(state,uv).z;float edge=fbm(vec3(uv*25.,time*.15))*.12;float reveal=smoothstep(.11+edge,.57+edge,d);float lum=dot(p.rgb,vec3(.2126,.7152,.0722));vec3 physical=mix(vec3(lum),p.rgb,.88)*.76;physical+=vec3(.557,.722,.149)*reveal*.02;float rear=smoothstep(.865,.94,uv.x)*smoothstep(.52,.60,uv.y)*(1.-smoothstep(.79,.87,uv.y));physical*=1.-rear*.75;color=vec4(physical,p.a*reveal*.96*(1.-rear));`));
const quad=gl.createBuffer();gl.bindBuffer(gl.ARRAY_BUFFER,quad);gl.bufferData(gl.ARRAY_BUFFER,new Float32Array([-1,-1,1,-1,-1,1,-1,1,1,-1,1,1]),gl.STATIC_DRAW);
const sw=mobile?72:96,sh=mobile?96:128;
function target(){const texture=gl.createTexture();gl.bindTexture(gl.TEXTURE_2D,texture);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_MIN_FILTER,gl.LINEAR);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_MAG_FILTER,gl.LINEAR);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_WRAP_S,gl.CLAMP_TO_EDGE);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_WRAP_T,gl.CLAMP_TO_EDGE);gl.texImage2D(gl.TEXTURE_2D,0,gl.RGBA16F,sw,sh,0,gl.RGBA,gl.HALF_FLOAT,null);const f=gl.createFramebuffer();gl.bindFramebuffer(gl.FRAMEBUFFER,f);gl.framebufferTexture2D(gl.FRAMEBUFFER,gl.COLOR_ATTACHMENT0,gl.TEXTURE_2D,texture,0);if(gl.checkFramebufferStatus(gl.FRAMEBUFFER)!==gl.FRAMEBUFFER_COMPLETE)throw Error('Float render target unavailable');gl.clearColor(0,0,0,0);gl.clear(gl.COLOR_BUFFER_BIT);return {texture,f};}
let fluid=[target(),target()],press=[target(),target()];const div=target();
function uniform(p,name,value){const l=gl.getUniformLocation(p,name);if(l===null)return;if(Array.isArray(value))gl.uniform2f(l,...value);else gl.uniform1f(l,value);}
function pass(p,out,textures,values={}){gl.bindFramebuffer(gl.FRAMEBUFFER,out?out.f:null);gl.viewport(0,0,out?sw:canvas.width,out?sh:canvas.height);gl.useProgram(p);gl.bindBuffer(gl.ARRAY_BUFFER,quad);const a=gl.getAttribLocation(p,'position');gl.enableVertexAttribArray(a);gl.vertexAttribPointer(a,2,gl.FLOAT,false,0,0);let i=0;for(const [name,texture]of Object.entries(textures)){gl.activeTexture(gl.TEXTURE0+i);gl.bindTexture(gl.TEXTURE_2D,texture);gl.uniform1i(gl.getUniformLocation(p,name),i++);}uniform(p,'texel',[1/sw,1/sh]);for(const [name,value]of Object.entries(values))uniform(p,name,value);gl.drawArrays(gl.TRIANGLES,0,6);gl.disableVertexAttribArray(a);}
const photo=gl.createTexture();gl.bindTexture(gl.TEXTURE_2D,photo);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_MIN_FILTER,gl.LINEAR);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_MAG_FILTER,gl.LINEAR);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_WRAP_S,gl.CLAMP_TO_EDGE);gl.texParameteri(gl.TEXTURE_2D,gl.TEXTURE_WRAP_T,gl.CLAMP_TO_EDGE);
let particleProgram,particleBuffer,particleCount=0;
function prepareImage(){if(!image.complete||!image.naturalWidth)return;gl.bindTexture(gl.TEXTURE_2D,photo);gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL,true);gl.texImage2D(gl.TEXTURE_2D,0,gl.RGBA,gl.RGBA,gl.UNSIGNED_BYTE,image);gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL,false);
 const sample=document.createElement('canvas');sample.width=216;sample.height=288;const c=sample.getContext('2d');c.drawImage(image,0,0,216,288);const pixels=c.getImageData(0,0,216,288).data,points=[];
 for(let y=6;y<138;y+=3)for(let x=10;x<205;x+=3)if(pixels[(y*216+x)*4+3]>160)points.push([x/216,1-y/288]);
 const data=[];particleCount=mobile?90:170;for(let i=0;i<particleCount;i++){const p=points[Math.floor(Math.random()*points.length)]||[.4,.7];data.push(...p,Math.random(),Math.random());}
 particleBuffer=gl.createBuffer();gl.bindBuffer(gl.ARRAY_BUFFER,particleBuffer);gl.bufferData(gl.ARRAY_BUFFER,new Float32Array(data),gl.STATIC_DRAW);
 particleProgram=program(`#version 300 es\nprecision highp float;in vec4 seed;uniform float time,dpr;uniform vec2 size;uniform sampler2D state;out float alpha;${noise}
 vec3 potential(vec3 p){return vec3(noise3(p),noise3(p+vec3(13,5,7)),noise3(p+vec3(2,19,11)));}
 vec3 curl(vec3 p){float e=.10;vec3 dx=potential(p+vec3(e,0,0))-potential(p-vec3(e,0,0)),dy=potential(p+vec3(0,e,0))-potential(p-vec3(0,e,0)),dz=potential(p+vec3(0,0,e))-potential(p-vec3(0,0,e));return vec3(dy.z-dz.y,dz.x-dx.z,dx.y-dy.x)/(2.*e);}
 void main(){float life=11.+seed.z*8.,age=fract(time/life+seed.w),travel=age*life;vec3 field=curl(vec3(seed.xy*4.,seed.z*7.+time*.045));vec2 p=seed.xy+vec2((seed.z-.5)*.045, .0025)*travel+field.xy*.023*sin(age*2.2);float depth=(seed.z-.5)*.22+field.z*.03;vec2 drift=(p-vec2(.5,.68))*(1.+depth*.18);p=vec2(.5,.68)+drift;float reveal=texture(state,seed.xy).z;alpha=smoothstep(0.,.10,age)*(1.-smoothstep(.55,1.,age))*(.14+min(reveal,1.)*.23);gl_Position=vec4(p*2.-1.,0,1);gl_PointSize=(.80+pow(seed.z,4.)*1.4)*dpr;}`,`#version 300 es\nprecision highp float;in float alpha;out vec4 color;void main(){float r=length(gl_PointCoord-.5)*2.;float a=(1.-smoothstep(.10,1.,r))*alpha;color=vec4(mix(vec3(.557,.722,.149),vec3(.83),.4),a);}`);
 hero.dataset.particles=String(particleCount);hero.dataset.ready='true';start();}
let raf=0,visible=true,last=0,time=0,lastMove=performance.now(),pointer=[.4,.69],smooth=[.4,.69],previous=[.4,.69],inside=false,touch=false,key=false,px=0,py=0,idleMix=0,scanStart=0,scanDuration=settings.scanDuration,scanCount=0;
const waypoint=()=>[.16+Math.random()*.54,.60+Math.random()*.20];
let curve=[[.4,.69],waypoint(),waypoint(),waypoint()];
function resize(){const b=layers.getBoundingClientRect(),d=Math.min(devicePixelRatio,1.5);canvas.width=Math.max(1,Math.round(b.width*d));canvas.height=Math.max(1,Math.round(b.height*d));start();}
function start(){if(!raf&&visible&&!document.hidden&&hero.dataset.ready==='true')raf=requestAnimationFrame(draw);}
function draw(now){raf=0;if(!visible||document.hidden)return;if(now-last<32&&!reduced.matches){raf=requestAnimationFrame(draw);return;}const dt=Math.min(.05,Math.max(.001,(now-last)/1000));last=now;if(!reduced.matches)time+=dt;
 const idle=!reduced.matches&&(now-lastMove>2000),blend=1-Math.exp(-dt*(idle?1.8:28));idleMix+=(Number(idle)-idleMix)*blend;
 if(time-scanStart>scanDuration){const end=curve[3],tangent=end.map((v,i)=>v+(v-curve[2][i])*.55);curve=[end,tangent,waypoint(),waypoint()];scanStart=time;scanDuration=settings.scanDuration;scanCount++;}
 const u=Math.min(1,(time-scanStart)/scanDuration),auto=[0,1].map(i=>(1-u)**3*curve[0][i]+3*(1-u)**2*u*curve[1][i]+3*(1-u)*u*u*curve[2][i]+u**3*curve[3][i]);
 // The whole hero steers a virtual field over the device; the pointer does
 // not need to intersect the small opaque headset image to reveal it.
 if(inside&&!key){const b=layers.getBoundingClientRect();pointer=[Math.max(.045,Math.min(.95,(px-b.left)/b.width)),Math.max(.53,Math.min(.995,1-(py-b.top)/b.height))];}
 const target=pointer.map((p,i)=>p*(1-idleMix)+auto[i]*idleMix),factor=idle?settings.idleCursorFactor:settings.cursorFactor,ease=1-Math.pow(1-factor,dt*60);previous=[...smooth];smooth=smooth.map((p,i)=>p+(target[i]-p)*ease);
 const force=smooth.map((p,i)=>Math.max(-.18,Math.min(.18,(p-previous[i])/dt*.8)));
 // The fresh material tracks the current pointer; only the trailing field
 // keeps inertia. Near the device, coordinates are genuinely one-to-one.
 const revealCursor=(!idle&&(inside||key||touch))?smooth.map((p,i)=>p*(1-settings.mouseLead)+target[i]*settings.mouseLead):smooth;
 const wireTime=reduced.matches?1:Math.min(1,time/1.65),sweep=(time%settings.scanDuration)/settings.scanDuration;
 layers.style.setProperty('--wire-front',`${(wireTime*65).toFixed(2)}%`);layers.style.setProperty('--wire-sweep',`${(2+sweep*48).toFixed(2)}%`);layers.style.setProperty('--wire-sweep-alpha',reduced.matches?'0':String(.22*Math.sin(sweep*Math.PI)));
 const injection=reduced.matches?(inside||key||touch?1:0):Math.max(idleMix,(inside||key||touch)?1:0);
 gl.disable(gl.BLEND);pass(advect,fluid[1],{state:fluid[0].texture},{dt:reduced.matches?.35:dt,time,cursor:revealCursor,force,injection,revealRadius:settings.revealDiameter*.5,dyeDecay:Math.log(1.35/.11)/settings.trailSeconds});fluid.reverse();pass(divergence,div,{state:fluid[0].texture});
 for(let i=0;i<10;i++){pass(pressure,press[1],{pressure:press[0].texture,divergence:div.texture});press.reverse();}
 pass(project,fluid[1],{state:fluid[0].texture,pressure:press[0].texture});fluid.reverse();
 gl.bindFramebuffer(gl.FRAMEBUFFER,null);gl.clearColor(0,0,0,0);gl.clear(gl.COLOR_BUFFER_BIT);pass(material,null,{state:fluid[0].texture,photo},{time});
 if(particleProgram&&!reduced.matches){gl.useProgram(particleProgram);gl.bindBuffer(gl.ARRAY_BUFFER,particleBuffer);const loc=gl.getAttribLocation(particleProgram,'seed');gl.enableVertexAttribArray(loc);gl.vertexAttribPointer(loc,4,gl.FLOAT,false,0,0);uniform(particleProgram,'time',time);uniform(particleProgram,'dpr',Math.min(devicePixelRatio,1.5));gl.activeTexture(gl.TEXTURE0);gl.bindTexture(gl.TEXTURE_2D,fluid[0].texture);gl.uniform1i(gl.getUniformLocation(particleProgram,'state'),0);gl.enable(gl.BLEND);gl.blendFunc(gl.SRC_ALPHA,gl.ONE);gl.drawArrays(gl.POINTS,0,particleCount);gl.disable(gl.BLEND);gl.disableVertexAttribArray(loc);}
 const parallax=reduced.matches?0:(pointer[0]-.5)*4;object.style.transform=`translate3d(calc(-50% + ${parallax.toFixed(2)}px),0,0)`;
 hero.dataset.renderer='webgl2-fluid-2.5d';hero.dataset.interactionScope='whole-hero';hero.dataset.mode=reduced.matches?'reduced':idle?'idle-scan':inside?'pointer':'trail';hero.dataset.scanCount=String(scanCount);hero.dataset.phase=time.toFixed(2);hero.dataset.revealX=revealCursor[0].toFixed(3);hero.dataset.revealY=revealCursor[1].toFixed(3);hero.dataset.trackingError=Math.hypot(revealCursor[0]-target[0],revealCursor[1]-target[1]).toFixed(4);hero.dataset.headset=injection>.1?'fluid-reveal':'wireframe';
 if(!reduced.matches)raf=requestAnimationFrame(draw);
}
function move(e){px=e.clientX;py=e.clientY;const b=hero.getBoundingClientRect();inside=px>=b.left&&px<=b.right&&py>=b.top&&py<=b.bottom;key=false;idleMix=0;lastMove=performance.now();start();}
hero.addEventListener('pointermove',move,{passive:true});hero.addEventListener('pointerleave',()=>{inside=false;lastMove=performance.now();start();});
hit.addEventListener('focus',()=>{key=hit.matches(':focus-visible');lastMove=performance.now();start();});hit.addEventListener('blur',()=>{key=false;start();});hit.addEventListener('pointerdown',e=>{if(e.pointerType==='touch'){e.preventDefault();move(e);touch=!touch;inside=touch;start();}});
hit.addEventListener('keydown',e=>{if(e.key==='Escape'){inside=key=touch=false;hit.blur();start();}});
new ResizeObserver(resize).observe(layers);new IntersectionObserver(e=>{visible=e[0].isIntersecting;if(visible){last=performance.now();start();}else{cancelAnimationFrame(raf);raf=0;}},{threshold:.01}).observe(hero);
document.addEventListener('visibilitychange',()=>{cancelAnimationFrame(raf);raf=0;last=performance.now();start();});reduced.addEventListener('change',()=>{cancelAnimationFrame(raf);raf=0;start();});canvas.addEventListener('webglcontextlost',e=>{e.preventDefault();cancelAnimationFrame(raf);hero.dataset.renderer='context-lost';});
image.addEventListener('load',prepareImage,{once:true});resize();if(image.complete)prepareImage();
}catch(error){hero.dataset.renderer='static-wireframe';hero.dataset.renderError=error.message;canvas.remove();console.error('VR 2.5D:',error);}
})();



/* Adapted from Immensive beta effects.js: topographic contact lines. */
(()=>{const reduced=matchMedia('(prefers-reduced-motion: reduce)').matches,finePointer=matchMedia('(hover:hover) and (pointer:fine)').matches;
	/* ---- 2. Topographic contour lines (contact CTA band) ---- */
	(function () {
		var host = document.querySelector('.vr-background-lines');
		if (!host) { return; }
		var canvas = document.createElement('canvas');
		canvas.className = 'ih-topo';
		host.appendChild(canvas);
		var ctx = canvas.getContext('2d');
		if (!ctx) { return; }

		var CELL = 16;
		var LEVELS = 11;
		var w = 0, h = 0, cols = 0, rows = 0, dpr = 1;
		var field = null;
		var running = false, visible = false, raf = 0;
		var pointer = { x: -9999, y: -9999, tx: -9999, ty: -9999 };

		function resize() {
			var r = host.getBoundingClientRect();
			dpr = Math.min(window.devicePixelRatio || 1, 2);
			w = Math.max(1, Math.round(r.width));
			h = Math.max(1, Math.round(r.height));
			canvas.width = w * dpr;
			canvas.height = h * dpr;
			canvas.style.width = w + 'px';
			canvas.style.height = h + 'px';
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			cols = Math.ceil(w / CELL) + 1;
			rows = Math.ceil(h / CELL) + 1;
			field = new Float32Array(cols * rows);
		}

		/* A cheap smooth scalar field: layered, drifting sine waves. */
		function sample(x, y, t) {
			var v = Math.sin(x * 0.0072 + t * 0.35) * 0.9
				+ Math.sin(y * 0.0095 - t * 0.28 + Math.sin(x * 0.0031 + t * 0.2) * 1.6) * 0.8
				+ Math.sin((x + y) * 0.0049 + t * 0.22) * 0.7
				+ Math.sin(Math.hypot(x - w * 0.5, y - h * 0.5) * 0.0085 - t * 0.4) * 0.6;
			var dx = x - pointer.x, dy = y - pointer.y;
			var d2 = dx * dx + dy * dy;
			if (d2 < 52000) { v += (1 - d2 / 52000) * 1.35; }
			return v;
		}

		function lerpEdge(a, b, level) {
			return (level - a) / (b - a);
		}

		function draw(t) {
			ctx.clearRect(0, 0, w, h);
			var i, j;
			for (j = 0; j < rows; j++) {
				for (i = 0; i < cols; i++) {
					field[j * cols + i] = sample(i * CELL, j * CELL, t);
				}
			}
			ctx.lineWidth = 1;
			for (var l = 0; l < LEVELS; l++) {
				var level = -2.8 + l * 0.62;
				var accent = l % 3 === 0;
				ctx.strokeStyle = accent ? 'rgba(142,184,38,0.26)' : 'rgba(255,255,255,0.10)';
				ctx.beginPath();
				for (j = 0; j < rows - 1; j++) {
					for (i = 0; i < cols - 1; i++) {
						var a = field[j * cols + i];
						var b = field[j * cols + i + 1];
						var c = field[(j + 1) * cols + i + 1];
						var d = field[(j + 1) * cols + i];
						var idx = (a > level ? 8 : 0) | (b > level ? 4 : 0) | (c > level ? 2 : 0) | (d > level ? 1 : 0);
						if (idx === 0 || idx === 15) { continue; }
						var x0 = i * CELL, y0 = j * CELL;
						var top = [x0 + lerpEdge(a, b, level) * CELL, y0];
						var right = [x0 + CELL, y0 + lerpEdge(b, c, level) * CELL];
						var bottom = [x0 + lerpEdge(d, c, level) * CELL, y0 + CELL];
						var left = [x0, y0 + lerpEdge(a, d, level) * CELL];
						var segs;
						switch (idx) {
							case 1: case 14: segs = [[left, bottom]]; break;
							case 2: case 13: segs = [[bottom, right]]; break;
							case 3: case 12: segs = [[left, right]]; break;
							case 4: case 11: segs = [[top, right]]; break;
							case 5: segs = [[left, top], [bottom, right]]; break;
							case 6: case 9: segs = [[top, bottom]]; break;
							case 7: case 8: segs = [[left, top]]; break;
							case 10: segs = [[top, right], [left, bottom]]; break;
							default: segs = [];
						}
						for (var s = 0; s < segs.length; s++) {
							ctx.moveTo(segs[s][0][0], segs[s][0][1]);
							ctx.lineTo(segs[s][1][0], segs[s][1][1]);
						}
					}
				}
				ctx.stroke();
			}
		}

		var start = performance.now();
		function frame(now) {
			if (!running) { return; }
			pointer.x += (pointer.tx - pointer.x) * 0.12;
			pointer.y += (pointer.ty - pointer.y) * 0.12;
			draw((now - start) / 1000);
			raf = window.requestAnimationFrame(frame);
		}
		function setRunning(on) {
			if (on && !running && !reduced) {
				running = true;
				raf = window.requestAnimationFrame(frame);
			} else if (!on && running) {
				running = false;
				window.cancelAnimationFrame(raf);
			}
		}

		resize();
		draw(0);
		window.addEventListener('resize', function () { resize(); draw((performance.now() - start) / 1000); });

		if (finePointer && !reduced) {
			var band = host.parentElement;
			band.addEventListener('pointermove', function (e) {
				var r = host.getBoundingClientRect();
				pointer.tx = e.clientX - r.left;
				pointer.ty = e.clientY - r.top;
				if (pointer.x < -9000) { pointer.x = pointer.tx; pointer.y = pointer.ty; }
			});
			band.addEventListener('pointerleave', function () { pointer.tx = pointer.ty = -9999; });
		}

		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				visible = entries[0].isIntersecting;
				setRunning(visible && !document.hidden);
			}, { rootMargin: '80px' }).observe(host);
			document.addEventListener('visibilitychange', function () { setRunning(visible && !document.hidden); });
		}
	})();


})();
(()=>{
const hero=document.querySelector('.vr-hero'),host=hero?.querySelector('.vr-background-lines');if(!host)return;
const canvas=document.createElement('canvas');canvas.className='vr-background-reveal';host.append(canvas);const ctx=canvas.getContext('2d');if(!ctx)return;
const reduced=matchMedia('(prefers-reduced-motion:reduce)'),mask=document.createElement('canvas');const sw=96,sh=72;mask.width=sw;mask.height=sh;const m=mask.getContext('2d'),pixels=m.createImageData(sw,sh);let a=new Float32Array(sw*sh),b=new Float32Array(sw*sh),w=1,h=1,last=0,time=0,raf=0,visible=true,inside=false,lastMove=0,x=.5,y=.4,tx=.5,ty=.4;
function resize(){const r=hero.getBoundingClientRect();w=r.width;h=r.height;canvas.width=Math.round(w);canvas.height=Math.round(h);start();}
function start(){if(!raf&&visible&&!document.hidden&&!reduced.matches)raf=requestAnimationFrame(draw);}
function draw(now){raf=0;if(!visible||document.hidden||reduced.matches)return;if(now-last<40){raf=requestAnimationFrame(draw);return;}const dt=Math.min(.06,(now-last)/1000);last=now;time+=dt;
 let inject=inside&&now-lastMove<2000;
 if(hero.dataset.mode==='idle-scan'){const obj=hero.querySelector('.vr-device-layers').getBoundingClientRect(),r=hero.getBoundingClientRect();tx=(obj.left+Number(hero.dataset.revealX)*obj.width-r.left)/w;ty=(obj.top+(1-Number(hero.dataset.revealY))*obj.height-r.top)/h;inject=true;}
 const ease=1-Math.exp(-dt*16);x+=(tx-x)*ease;y+=(ty-y)*ease;
 const decay=Math.exp(-dt*1.15);
 for(let j=0;j<sh;j++)for(let i=0;i<sw;i++){const u=i/sw,v=j/sh,dx=Math.sin(v*9+time*.18)*.35,dy=Math.cos(u*8-time*.21)*.30,si=Math.max(0,Math.min(sw-1,Math.round(i-dx))),sj=Math.max(0,Math.min(sh-1,Math.round(j-dy)));let value=a[sj*sw+si]*decay;
  if(inject){const qx=(u-x)*(w/h),qy=v-y,r=.17+.018*Math.sin(Math.atan2(qy,qx)*3+time*.2),warp=.016*Math.sin(u*19+v*12+time*.25);const g=Math.exp(-((qx+warp)**2+(qy-warp*.7)**2)/(r*r*.50));value=Math.min(1,Math.max(value,g*.9));}
  b[j*sw+i]=value;const p=(j*sw+i)*4;pixels.data[p]=154;pixels.data[p+1]=180;pixels.data[p+2]=102;pixels.data[p+3]=Math.round(value*24);
 }
 [a,b]=[b,a];m.putImageData(pixels,0,0);ctx.clearRect(0,0,w,h);ctx.filter='blur(22px)';ctx.drawImage(mask,0,0,w,h);ctx.filter='none';hero.dataset.backgroundReveal='fluid-trail';raf=requestAnimationFrame(draw);
}
hero.addEventListener('pointermove',e=>{const r=hero.getBoundingClientRect();tx=(e.clientX-r.left)/w;ty=(e.clientY-r.top)/h;inside=true;lastMove=performance.now();start();},{passive:true});hero.addEventListener('pointerleave',()=>{inside=false;});
new ResizeObserver(resize).observe(hero);new IntersectionObserver(e=>{visible=e[0].isIntersecting;if(visible){last=performance.now();start();}else{cancelAnimationFrame(raf);raf=0;}},{threshold:.01}).observe(hero);document.addEventListener('visibilitychange',()=>{cancelAnimationFrame(raf);raf=0;last=performance.now();start();});reduced.addEventListener('change',()=>{cancelAnimationFrame(raf);raf=0;ctx.clearRect(0,0,w,h);start();});resize();
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

