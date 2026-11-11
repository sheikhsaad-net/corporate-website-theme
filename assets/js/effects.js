/**
 * Immensive — interaction polish.
 *
 * Small, dependency-free effects layered on top of homepage.js:
 *   1. scroll progress bar
 *   2. animated topographic contour lines behind the contact CTA band
 *   3. tilt + cursor glare on cards
 *   4. magnetic pull on buttons
 *   5. back-to-top ring, staggered reveals, pointer spotlight on dark bands
 *
 * The contour-line and glass-glare ideas are inspired by the ReactDrops
 * catalogue (reactdrops.dev); this is an independent vanilla implementation.
 * Pointer effects are skipped on touch devices and everything animated is
 * skipped (or drawn once) under prefers-reduced-motion.
 */
(function () {
	'use strict';

	var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var finePointer = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;

	/* ---- 1. Scroll progress bar ---- */
	(function () {
		var bar = document.createElement('div');
		bar.className = 'ih-progress';
		bar.setAttribute('aria-hidden', 'true');
		document.body.appendChild(bar);
		var ticking = false;
		function update() {
			ticking = false;
			var max = document.documentElement.scrollHeight - window.innerHeight;
			var p = max > 0 ? Math.min(1, Math.max(0, window.pageYOffset / max)) : 0;
			bar.style.transform = 'scaleX(' + p + ')';
		}
		function onScroll() {
			if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
		}
		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onScroll);
		update();
	})();

	/* ---- 2. Topographic contour lines (contact CTA band) ---- */
	(function () {
		var host = document.querySelector('.ih-contact__glow');
		if (!host) { return; }
		var canvas = document.createElement('canvas');
		canvas.className = 'ih-topo';
		host.appendChild(canvas);
		var ctx = canvas.getContext('2d');
		if (!ctx) { return; }

		var CELL = 16;
		var LEVELS = 9;
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
				ctx.strokeStyle = accent ? 'rgba(142,184,38,0.55)' : 'rgba(255,255,255,0.13)';
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

	/* ---- 5. Split-word heading reveal ----
	   Words slide up out of a mask when the heading scrolls into view. Only
	   text nodes are wrapped, so <br> and inline spans keep working. */
	(function () {
		if (reduced || !('IntersectionObserver' in window)) { return; }
		var sel = '.ih-sccprog__heading, .ih-sccwhat__heading, .ih-sccwho__heading, .ih-stats__title, .ih-testi__heading, .ih-inflow__heading, .ih-faq__heading, .ih-casi__heading, .ih-why__title, .ih-contact .ih-heading, .ih-showcase--static .ih-heading, .ih-norma__title, .ih-rshero__title, .ih-works__heading, .ih-successi__heading';
		// Every other section heading on the site: any h2 named *__heading,
		// *__title, *-heading, or the generic .ih-heading.
		sel += ', h2[class*="__heading"], h2[class*="__title"], h2[class*="-heading"], h2.ih-heading, .ih-wr__title, .ih-phero--riv .ih-phero__title';
		var skip = '.ih-popup, .ih-modal, #ih-demo-modal, #ih-video-modal, [data-no-split]';
		var heads = Array.prototype.filter.call(document.querySelectorAll(sel), function (el) {
			return !el.closest(skip) && !/group-title|__name|entry-title|widget-title/.test(el.className);
		});
		if (!heads.length) { return; }
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
			});
		}, { threshold: 0.35 });

		heads.forEach(function (el) {
			var idx = 0;
			var walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null);
			var nodes = [];
			while (walker.nextNode()) { nodes.push(walker.currentNode); }
			nodes.forEach(function (node) {
				var parts = node.nodeValue.split(/(\s+)/);
				if (parts.length === 1 && !parts[0].trim()) { return; }
				var frag = document.createDocumentFragment();
				parts.forEach(function (part) {
					if (!part) { return; }
					if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(part)); return; }
					var outer = document.createElement('span');
					outer.className = 'ih-split-word';
					var inner = document.createElement('span');
					inner.style.setProperty('--i', idx++);
					inner.textContent = part;
					outer.appendChild(inner);
					frag.appendChild(outer);
				});
				node.parentNode.replaceChild(frag, node);
			});
			el.classList.add('ih-split');
			io.observe(el);
		});
	})();

	/* ---- 5b. Intro text under headings: soft fade-up when it scrolls in ---- */
	(function () {
		if (reduced || !('IntersectionObserver' in window)) { return; }
		var sel = 'p[class*="__sub"], p[class*="__lead"], p[class*="__intro"], p[class*="__eyebrow"], p[class*="__tagline"], .ih-section-intro, .ih-wr__desc';
		var skip = '.ih-popup, .ih-modal, #ih-demo-modal, #ih-video-modal, [data-no-split]';
		var els = Array.prototype.filter.call(document.querySelectorAll(sel), function (el) {
			return !el.closest(skip);
		});
		if (!els.length) { return; }
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
			});
		}, { threshold: 0.2 });
		els.forEach(function (el) {
			el.classList.add('ih-fx-fade');
			io.observe(el);
		});
	})();

	/* ---- 6. Soft parallax on card photos ---- */
	(function () {
		if (reduced) { return; }
		var imgs = Array.prototype.slice.call(document.querySelectorAll('.ih-reality-card > img, .ih-esplora-card > img'));
		if (!imgs.length) { return; }
		var ticking = false;
		function update() {
			ticking = false;
			var vh = window.innerHeight;
			imgs.forEach(function (img) {
				var r = img.parentElement.getBoundingClientRect();
				if (r.bottom < -50 || r.top > vh + 50) { return; }
				var p = (r.top + r.height / 2 - vh / 2) / vh; // -1..1 around centre
				img.style.translate = '0 ' + (p * -14).toFixed(1) + 'px';
			});
		}
		function onScroll() {
			if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
		}
		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onScroll);
		update();
	})();

	/* ---- 7. Page transitions ---- */
	(function () {
		if (reduced) { return; }
		document.addEventListener('click', function (e) {
			var a = e.target.closest && e.target.closest('a[href]');
			if (!a || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) { return; }
			if (a.target && a.target !== '_self') { return; }
			if (a.hasAttribute('download')) { return; }
			var url;
			try { url = new URL(a.href, window.location.href); } catch (err) { return; }
			if (url.origin !== window.location.origin) { return; }
			if (url.pathname === window.location.pathname && url.search === window.location.search) { return; }
			if (/^(mailto|tel):/i.test(a.getAttribute('href'))) { return; }
			e.preventDefault();
			document.body.classList.add('ih-leaving');
			window.setTimeout(function () { window.location.href = url.href; }, 220);
		});
		/* back/forward cache restores the page with the leaving state still set */
		window.addEventListener('pageshow', function () { document.body.classList.remove('ih-leaving'); });
	})();

	/* ---- 9. Back-to-top button with progress ring ---- */
	(function () {
		var btn = document.createElement('button');
		btn.type = 'button';
		btn.className = 'ih-totop';
		btn.setAttribute('aria-label', 'Torna su');
		btn.innerHTML = '<svg viewBox="0 0 50 50" aria-hidden="true"><circle class="ih-totop__track" cx="25" cy="25" r="23"/><circle class="ih-totop__bar" cx="25" cy="25" r="23"/></svg>'
			+ '<svg class="ih-totop__arrow" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5M5 12l7-7 7 7"/></svg>';
		document.body.appendChild(btn);
		var bar = btn.querySelector('.ih-totop__bar');
		var ticking = false;
		function update() {
			ticking = false;
			var max = document.documentElement.scrollHeight - window.innerHeight;
			var p = max > 0 ? Math.min(1, Math.max(0, window.pageYOffset / max)) : 0;
			bar.style.strokeDashoffset = (144.5 * (1 - p)).toFixed(1);
			btn.classList.toggle('is-on', window.pageYOffset > window.innerHeight * 0.8);
		}
		window.addEventListener('scroll', function () {
			if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
		}, { passive: true });
		btn.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
		});
		update();
	})();

	/* ---- 10. Staggered reveal of sibling blocks ---- */
	(function () {
		if (reduced) { return; }
		var seen = [];
		document.querySelectorAll('.ih-reveal').forEach(function (el) {
			var parent = el.parentElement;
			if (!parent || seen.indexOf(parent) !== -1 || parent.classList.contains('ih-choose__list')) { return; }
			seen.push(parent);
			var kids = Array.prototype.filter.call(parent.children, function (c) { return c.classList.contains('ih-reveal'); });
			if (kids.length < 2) { return; }
			kids.forEach(function (k, i) {
				if (!k.style.transitionDelay) { k.style.transitionDelay = (Math.min(i, 5) * 0.08).toFixed(2) + 's'; }
			});
		});
	})();

	if (!finePointer || reduced) { return; }

	/* ---- 3. Tilt + glare on cards ---- */
	(function () {
		var sel = '.ih-reality-card, .ih-why-card, .ih-esplora-card, .ih-tool, .ih-acc--innov, .ih-acc--mission';
		document.querySelectorAll(sel).forEach(function (card) {
			var glare = document.createElement('span');
			glare.className = 'ih-fx-glare';
			glare.setAttribute('aria-hidden', 'true');
			card.appendChild(glare);
			card.classList.add('ih-fx-card');
			var MAX = 5; // degrees
			card.addEventListener('pointermove', function (e) {
				var r = card.getBoundingClientRect();
				var px = (e.clientX - r.left) / r.width;
				var py = (e.clientY - r.top) / r.height;
				var dx = px - 0.5, dy = py - 0.5;
				var mag = Math.min(1, Math.hypot(dx, dy) * 2);
				/* rotate about the axis perpendicular to the pointer offset */
				card.style.rotate = (-dy).toFixed(3) + ' ' + dx.toFixed(3) + ' 0 ' + (mag * MAX).toFixed(2) + 'deg';
				card.style.setProperty('--mx', (px * 100).toFixed(1) + '%');
				card.style.setProperty('--my', (py * 100).toFixed(1) + '%');
			});
			card.addEventListener('pointerleave', function () {
				card.style.rotate = '';
			});
		});
	})();

	/* ---- 12. Light beam following the pointer on every button ---- */
	(function () {
		document.querySelectorAll('.ih-btn').forEach(function (btn) {
			btn.classList.add('has-beam');
			btn.addEventListener('pointermove', function (e) {
				var r = btn.getBoundingClientRect();
				btn.style.setProperty('--bx', (e.clientX - r.left).toFixed(0) + 'px');
				btn.style.setProperty('--by', (e.clientY - r.top).toFixed(0) + 'px');
			});
		});
	})();

	/* ---- 13. Flowing wave lines behind the "Innova il tuo modo di insegnare" band ---- */
	(function () {
		document.querySelectorAll('.ih-pteach--flow').forEach(function (band) {
			var canvas = document.createElement('canvas');
			canvas.className = 'ih-wave';
			canvas.setAttribute('aria-hidden', 'true');
			band.insertBefore(canvas, band.firstChild);
			var ctx = canvas.getContext('2d');
			if (!ctx) { return; }
			var hex = (getComputedStyle(band).getPropertyValue('--pc') || '#69ceeb').trim().replace('#', '');
			if (hex.length === 3) { hex = hex.replace(/(.)/g, '$1$1'); }
			var rgb = [parseInt(hex.substr(0, 2), 16) || 105, parseInt(hex.substr(2, 2), 16) || 206, parseInt(hex.substr(4, 2), 16) || 235];
			var LINES = 11, w = 0, h = 0, dpr = 1, raf = 0, running = false;
			var ptr = { x: -9999, y: -9999, tx: -9999, ty: -9999, p: 0, tp: 0 };

			function resize() {
				var r = band.getBoundingClientRect();
				dpr = Math.min(window.devicePixelRatio || 1, 2);
				w = Math.max(1, Math.round(r.width));
				h = Math.max(1, Math.round(r.height));
				canvas.width = w * dpr;
				canvas.height = h * dpr;
				ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			}

			function draw(t) {
				ctx.clearRect(0, 0, w, h);
				ctx.lineWidth = 1;
				ctx.lineJoin = 'round';
				for (var i = 0; i < LINES; i++) {
					var k = i / (LINES - 1);
					var base = h * (0.14 + k * 0.72);
					/* Near-parallel ribbons: one shared wave, tiny per-line offset, so lines never tangle. */
					var ph = t * 0.35 + i * 0.09;
					var alpha = 0.10 + 0.20 * Math.sin(k * Math.PI);
					var g = ctx.createLinearGradient(0, 0, w, 0);
					g.addColorStop(0, 'rgba(' + rgb + ',' + (alpha * 0.8).toFixed(3) + ')');
					g.addColorStop(0.5, 'rgba(255,255,255,' + (alpha * 0.9).toFixed(3) + ')');
					g.addColorStop(1, 'rgba(' + rgb + ',' + (alpha * 0.8).toFixed(3) + ')');
					ctx.strokeStyle = g;
					ctx.beginPath();
					for (var x = -10; x <= w + 10; x += 10) {
						var u = x / w;
						var y = base + Math.sin(u * 3.4 + ph) * h * 0.07 + Math.sin(u * 7 - ph * 0.8) * h * 0.012 * (0.4 + k);
						if (ptr.p > 0.01) {
							var dx = x - ptr.x, dy = y - ptr.y;
							var f = Math.exp(-(dx * dx) / 42000 - (dy * dy) / 90000) * ptr.p;
							y += dy * f * 0.32;
						}
						if (x === -10) { ctx.moveTo(x, y); } else { ctx.lineTo(x, y); }
					}
					ctx.stroke();
				}
				if (ptr.p > 0.01) {
					var rg = ctx.createRadialGradient(ptr.x, ptr.y, 0, ptr.x, ptr.y, 200);
					rg.addColorStop(0, 'rgba(' + rgb + ',' + (0.16 * ptr.p).toFixed(3) + ')');
					rg.addColorStop(1, 'rgba(' + rgb + ',0)');
					ctx.fillStyle = rg;
					ctx.fillRect(0, 0, w, h);
				}
			}

			var start = performance.now();
			function frame(now) {
				if (!running) { return; }
				ptr.x += (ptr.tx - ptr.x) * 0.14;
				ptr.y += (ptr.ty - ptr.y) * 0.14;
				ptr.p += (ptr.tp - ptr.p) * 0.08;
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

			if (finePointer && !reduced) {
				band.addEventListener('pointermove', function (e) {
					var r = band.getBoundingClientRect();
					ptr.tx = e.clientX - r.left;
					ptr.ty = e.clientY - r.top;
					if (ptr.x < -9000) { ptr.x = ptr.tx; ptr.y = ptr.ty; }
					ptr.tp = 1;
				});
				band.addEventListener('pointerleave', function () { ptr.tp = 0; });
			}

			resize();
			draw(0);
			window.addEventListener('resize', function () { resize(); draw((performance.now() - start) / 1000); });
			if ('IntersectionObserver' in window) {
				new IntersectionObserver(function (entries) { setRunning(entries[0].isIntersecting); }, { threshold: 0 }).observe(band);
			} else {
				setRunning(true);
			}
		});
	})();

	/* ---- 11. Pointer spotlight on dark bands ---- */
	(function () {
		document.querySelectorAll('.ih-psol--hero, .ih-contact').forEach(function (band) {
			var spot = document.createElement('span');
			spot.className = 'ih-spot';
			spot.setAttribute('aria-hidden', 'true');
			band.appendChild(spot);
			band.addEventListener('pointermove', function (e) {
				var r = band.getBoundingClientRect();
				spot.style.setProperty('--sx', (e.clientX - r.left).toFixed(0) + 'px');
				spot.style.setProperty('--sy', (e.clientY - r.top).toFixed(0) + 'px');
				spot.classList.add('is-on');
			});
			band.addEventListener('pointerleave', function () { spot.classList.remove('is-on'); });
		});
	})();
})();
