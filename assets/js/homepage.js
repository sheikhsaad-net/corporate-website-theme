(function () {
	'use strict';

	var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	var header = document.getElementById('ih-header');
	var burger = document.getElementById('ih-burger');
	var nav = document.getElementById('ih-nav');

	if (header) {
		// Stay transparent over the pinned hero; go dark once the content
		// below starts covering it (or after a small scroll on other pages).
		var heroForHeader = document.getElementById('ih-hero');
		var onScroll = function () {
			var threshold = 10;
			// Most #ih-hero variants are about one screen tall (the pinned
			// homepage hero at ≥901px, the single-product pages' photo
			// hero), so waiting for the whole thing to scroll past before
			// going solid is the right call there. But at mobile widths
			// .ih-hero (template-prodotti.php) drops the position:sticky
			// pinning and stacks all 4 product slides + the badges (plus,
			// at ≥721px, the CTA row) well past one screen's height —
			// waiting for all of that left the header transparent for a
			// long stretch of ordinary content, overlapping it unreadably
			// (the CTA row, then the "260+ Licenze installate" badges
			// right after it). Capping at one screen tells those two
			// cases apart by actual rendered height rather than
			// hardcoding a breakpoint or hero id/class here — a hero
			// taller than the viewport is, by definition, more than can
			// be "waited out" the way a single pinned screen can.
			if (heroForHeader) {
				var heroHeight = heroForHeader.offsetHeight;
				threshold = heroHeight <= window.innerHeight
					? heroHeight - header.offsetHeight - 40
					: 10;
			}
			header.classList.toggle('is-scrolled', window.scrollY > threshold);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onScroll, { passive: true });
		onScroll();
	}

	if (burger && nav) {
		burger.addEventListener('click', function () {
			var isOpen = nav.classList.toggle('is-open');
			burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}

	// Mobile nav accordion — each parent item's submenu (Prodotti's mega
	// grid, plain dropdowns) starts collapsed and only that item's caret
	// (see Immensive_Nav_Walker in functions.php) opens/closes it; tapping
	// the item's own label still follows its link. display:none on desktop
	// keeps the caret out of the tab order and unclickable there, so this
	// never fires outside the mobile accordion.
	if (nav) {
		var navCarets = nav.querySelectorAll('.menu-item-has-children > a > .ih-nav__caret');
		var toggleSubmenu = function (caret) {
			var item = caret.closest('.menu-item-has-children');
			if (!item) {
				return;
			}
			var isOpen = item.classList.toggle('is-submenu-open');
			caret.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		};
		Array.prototype.forEach.call(navCarets, function (caret) {
			caret.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				toggleSubmenu(caret);
			});
			caret.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					e.stopPropagation();
					toggleSubmenu(caret);
				}
			});
		});
	}

	// Scroll-reveal.
	var revealEls = document.querySelectorAll('.ih-reveal');
	if ('IntersectionObserver' in window && revealEls.length) {
		var revealObserver = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						revealObserver.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.15 }
		);
		revealEls.forEach(function (el) {
			revealObserver.observe(el);
		});
	} else {
		revealEls.forEach(function (el) {
			el.classList.add('is-visible');
		});
	}

	// Animated stat counters.
	var counters = document.querySelectorAll('.ih-stat__number');
	if ('IntersectionObserver' in window && counters.length) {
		var animateCounter = function (el) {
			var target = parseInt(el.getAttribute('data-count'), 10) || 0;
			var suffix = el.getAttribute('data-suffix') || '';
			// data-format="it" groups thousands the Italian way (20.000).
			var format = el.getAttribute('data-format') || '';
			var duration = 1400;
			var start = null;

			var step = function (timestamp) {
				if (start === null) {
					start = timestamp;
				}
				var progress = Math.min((timestamp - start) / duration, 1);
				var eased = 1 - Math.pow(1 - progress, 3);
				var value = Math.floor(eased * target);

				if (suffix === 'K') {
					el.textContent = Math.floor(value / 1000) + suffix;
				} else if (format === 'it') {
					el.textContent = value.toLocaleString('it-IT');
				} else {
					el.textContent = value;
				}

				if (progress < 1) {
					window.requestAnimationFrame(step);
				}
			};

			window.requestAnimationFrame(step);
		};

		var counterObserver = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						animateCounter(entry.target);
						counterObserver.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.5 }
		);
		counters.forEach(function (el) {
			counterObserver.observe(el);
		});
	}

	// Showcase — sticky stacking cards. Stacking itself is pure CSS
	// (position: sticky per card). This just shrinks/dims a card a touch as
	// the next one slides up to cover it, for a subtle "deck" depth.
	var showcase = document.getElementById('ih-showcase');
	var stack = document.getElementById('ih-showcase-stack');

	if (showcase && stack && !prefersReduced) {
		var stackCards = stack.querySelectorAll('.ih-acc');
		var stackTicking = false;

		var applyStack = function () {
			stackTicking = false;
			if (window.innerWidth <= 820) {
				for (var j = 0; j < stackCards.length; j++) {
					stackCards[j].style.transform = '';
					stackCards[j].style.filter = '';
				}
				return;
			}
			for (var i = 0; i < stackCards.length - 1; i++) {
				var rect = stackCards[i].getBoundingClientRect();
				var next = stackCards[i + 1].getBoundingClientRect();
				// How close the next card's top has risen to this card's top,
				// normalised by this card's height: 0 = far below, 1 = covering.
				var d = (next.top - rect.top) / rect.height;
				var p = 1 - Math.min(Math.max(d, 0), 1);
				stackCards[i].style.transform = 'scale(' + (1 - p * 0.05).toFixed(4) + ')';
				stackCards[i].style.filter = 'brightness(' + (1 - p * 0.28).toFixed(3) + ')';
			}
			// Top card of the deck (last one) never gets covered.
			var last = stackCards[stackCards.length - 1];
			if (last) {
				last.style.transform = '';
				last.style.filter = '';
			}
		};

		var onStackScroll = function () {
			if (!stackTicking) {
				stackTicking = true;
				window.requestAnimationFrame(applyStack);
			}
		};

		window.addEventListener('scroll', onStackScroll, { passive: true });
		window.addEventListener('resize', onStackScroll, { passive: true });
		applyStack();
	}

	// Hero product slider — expanding cards with theme color + autoplay.
	var heroEl = document.getElementById('ih-hero');
	var sliderEl = document.getElementById('ih-slider');

	if (heroEl && sliderEl) {
		var slides = sliderEl.querySelectorAll('.ih-slide');
		var heroNum = document.getElementById('ih-hero-num');
		var heroCurrent = 0;
		var heroTimer = null;
		var HERO_INTERVAL = 5000;

		var heroActivate = function (idx) {
			if (idx === heroCurrent) {
				return;
			}
			heroCurrent = idx;

			for (var i = 0; i < slides.length; i++) {
				var isActive = i === idx;
				slides[i].classList.toggle('is-active', isActive);
				if (isActive) {
					var bar = slides[i].querySelector('.ih-slide__progress');
					if (bar) {
						bar.style.animation = 'none';
						void bar.offsetWidth;
						bar.style.animation = '';
					}
					heroEl.style.setProperty('--ih-theme', slides[i].getAttribute('data-color'));
				}
			}

			if (heroNum) {
				heroNum.textContent = String(idx + 1).padStart(2, '0');
			}
		};

		var heroNext = function () {
			heroActivate((heroCurrent + 1) % slides.length);
		};

		var heroStart = function () {
			if (!prefersReduced) {
				heroTimer = window.setInterval(heroNext, HERO_INTERVAL);
			}
		};

		var heroRestart = function () {
			window.clearInterval(heroTimer);
			heroStart();
		};

		Array.prototype.forEach.call(slides, function (slide, i) {
			slide.addEventListener('click', function (e) {
				// Let the CTA link work normally on the active slide.
				if (slide.classList.contains('is-active') && e.target.closest('.ih-slide__cta')) {
					return;
				}
				heroActivate(i);
				heroRestart();
			});
			slide.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					heroActivate(i);
					heroRestart();
				}
			});
		});

		sliderEl.addEventListener('mouseenter', function () {
			window.clearInterval(heroTimer);
		});
		// heroRestart, not heroStart: heroStart() doesn't clear any existing
		// interval first, so if a click (which calls heroRestart) happened
		// while the mouse was over the slider, leaving would stack a SECOND
		// interval on top of the one heroRestart already started — both
		// firing heroNext() every 5s but offset, making the slider visibly
		// advance faster than the intended wait.
		sliderEl.addEventListener('mouseleave', heroRestart);

		heroStart();
	}

	// "Pensati per ogni realtà" — sticky heading fade/scale + card parallax.
	var realities = document.getElementById('ih-realities');
	if (realities && !prefersReduced) {
		var rHeading = realities.querySelector('.ih-realities__heading');
		var rCards = realities.querySelectorAll('.ih-reality-card');
		var ticking = false;

		var applyRealities = function () {
			var rect = realities.getBoundingClientRect();
			var vh = window.innerHeight || document.documentElement.clientHeight;
			var total = rect.height - vh;
			var scrolled = Math.min(Math.max(-rect.top, 0), total > 0 ? total : 0);
			var p = total > 0 ? scrolled / total : 0;

			if (rHeading) {
				rHeading.style.transform = 'scale(' + (1 + p * 0.14).toFixed(4) + ')';
				rHeading.style.opacity = (1 - p * 0.72).toFixed(3);
			}

			for (var i = 0; i < rCards.length; i++) {
				// Alternating parallax depth so cards drift at different rates.
				var dir = i === 1 ? 1 : -1;
				var depth = i === 1 ? 34 : 22;
				rCards[i].style.setProperty('--ih-parallax', (p * depth * dir).toFixed(1) + 'px');
			}

			ticking = false;
		};

		var onRealScroll = function () {
			if (!ticking) {
				ticking = true;
				window.requestAnimationFrame(applyRealities);
			}
		};

		window.addEventListener('scroll', onRealScroll, { passive: true });
		window.addEventListener('resize', onRealScroll, { passive: true });
		applyRealities();
	}

	// "Perché fare formazione" — sticky heading scale/fade, same effect as
	// the realities heading above.
	var why = document.getElementById('ih-why');
	if (why && !prefersReduced) {
		var whyIntro = why.querySelector('.ih-why__intro');
		var whyTicking = false;

		var applyWhy = function () {
			var rect = why.getBoundingClientRect();
			var vh = window.innerHeight || document.documentElement.clientHeight;
			var total = rect.height - vh;
			var scrolled = Math.min(Math.max(-rect.top, 0), total > 0 ? total : 0);
			var p = total > 0 ? scrolled / total : 0;

			if (whyIntro) {
				whyIntro.style.transform = 'scale(' + (1 + p * 0.14).toFixed(4) + ')';
				whyIntro.style.opacity = (1 - p * 0.72).toFixed(3);
			}

			whyTicking = false;
		};

		var onWhyScroll = function () {
			if (!whyTicking) {
				whyTicking = true;
				window.requestAnimationFrame(applyWhy);
			}
		};

		window.addEventListener('scroll', onWhyScroll, { passive: true });
		window.addEventListener('resize', onWhyScroll, { passive: true });
		applyWhy();
	}

	// Pinned section headings — sticky head scale/fade (and optional blur),
	// same effect as the homepage realities heading. `scale` is the extra
	// growth at full progress; `blur` the max blur in px.
	var pinnedHeads = [
		{ section: 'ih-sistema', head: '.ih-sistema__head', scale: 0.14, blur: 0 },
		{ section: 'ih-come-funziona', head: '.ih-pfunziona__head', scale: 0.14, blur: 0 },
		{ section: 'ih-tco', head: '.ih-tco__head', scale: 0.14, blur: 0 },
		{ section: 'ih-wr', head: '.ih-wr__headwrap', scale: 0.24, blur: 8 },
		{ section: 'ih-missione', head: '.ih-mission__headwrap', scale: 0.24, blur: 8 },
	];
	pinnedHeads.forEach(function (cfg) {
		var section = document.getElementById(cfg.section);
		if (!section || prefersReduced) {
			return;
		}
		var headEl = section.querySelector(cfg.head);
		if (!headEl) {
			return;
		}
		var ticking2 = false;

		var applyHead = function () {
			var vh = window.innerHeight || document.documentElement.clientHeight;
			var p;
			if (cfg.mode === 'pass') {
				// Compact (non-pinned) section: the heading grows/fades as it
				// rises from mid-viewport up past the top.
				var hr = headEl.getBoundingClientRect();
				p = (vh * 0.5 - hr.top) / (vh * 0.5);
			} else {
				var rect = section.getBoundingClientRect();
				var total = rect.height - vh;
				var scrolled = Math.min(Math.max(-rect.top, 0), total > 0 ? total : 0);
				p = total > 0 ? scrolled / total : 0;
			}
			p = Math.min(Math.max(p, 0), 1);

			headEl.style.transform = 'scale(' + (1 + p * cfg.scale).toFixed(4) + ')';
			headEl.style.opacity = (1 - p * 0.72).toFixed(3);
			if (cfg.blur) {
				headEl.style.filter = 'blur(' + (p * cfg.blur).toFixed(2) + 'px)';
			}

			ticking2 = false;
		};

		var onHeadScroll = function () {
			if (!ticking2) {
				ticking2 = true;
				window.requestAnimationFrame(applyHead);
			}
		};

		window.addEventListener('scroll', onHeadScroll, { passive: true });
		window.addEventListener('resize', onHeadScroll, { passive: true });
		applyHead();
	});

	// "PIANI" comparison table — cursor-following glare on the glass panel
	// and a slow scroll drift on the giant half-hidden heading.
	var ptPanel = document.getElementById('ih-pianitab-panel');
	if (ptPanel) {
		var ptGlareTicking = false;
		var ptMX = 0;
		var ptMY = 0;

		ptPanel.addEventListener('mousemove', function (e) {
			var rect = ptPanel.getBoundingClientRect();
			ptMX = e.clientX - rect.left;
			ptMY = e.clientY - rect.top;
			if (!ptGlareTicking) {
				ptGlareTicking = true;
				window.requestAnimationFrame(function () {
					ptGlareTicking = false;
					ptPanel.style.setProperty('--mx', ptMX.toFixed(0) + 'px');
					ptPanel.style.setProperty('--my', ptMY.toFixed(0) + 'px');
				});
			}
		}, { passive: true });
	}

	// "Soluzioni di acquisto" cards — the same cursor-following glare as the
	// PIANI glass panel, but tracked per card instead of on one big panel.
	var solCards = document.querySelectorAll('.ih-psol__card');
	Array.prototype.forEach.call(solCards, function (card) {
		var solTicking = false;
		var solMX = 0;
		var solMY = 0;

		card.addEventListener('mousemove', function (e) {
			var rect = card.getBoundingClientRect();
			solMX = e.clientX - rect.left;
			solMY = e.clientY - rect.top;
			if (!solTicking) {
				solTicking = true;
				window.requestAnimationFrame(function () {
					solTicking = false;
					card.style.setProperty('--mx', solMX.toFixed(0) + 'px');
					card.style.setProperty('--my', solMY.toFixed(0) + 'px');
				});
			}
		}, { passive: true });
	});

	// "Confronta i Modelli" Lite/Pro cards — same cursor-following glare
	// trick as .ih-psol__card above, tracked per hit-area so only the
	// hovered column's card glows.
	var pcompHits = document.querySelectorAll('.ih-pcomp__hit');
	Array.prototype.forEach.call(pcompHits, function (hit) {
		var pcTicking = false;
		var pcMX = 0;
		var pcMY = 0;

		hit.addEventListener('mousemove', function (e) {
			var rect = hit.getBoundingClientRect();
			pcMX = e.clientX - rect.left;
			pcMY = e.clientY - rect.top;
			if (!pcTicking) {
				pcTicking = true;
				window.requestAnimationFrame(function () {
					pcTicking = false;
					hit.style.setProperty('--mx', pcMX.toFixed(0) + 'px');
					hit.style.setProperty('--my', pcMY.toFixed(0) + 'px');
				});
			}
		}, { passive: true });
	});

	var ptSection = document.getElementById('ih-piani');
	if (ptSection && !prefersReduced) {
		var ptHeading = ptSection.querySelector('.ih-pianitab__heading');
		var ptTicking = false;

		var applyPianitab = function () {
			ptTicking = false;
			if (!ptHeading) {
				return;
			}
			var rect = ptSection.getBoundingClientRect();
			var vh = window.innerHeight || document.documentElement.clientHeight;
			// 0 when the section enters the viewport bottom, 1 when it leaves
			// at the top — the heading drifts up slower than the scroll.
			var p = (vh - rect.top) / (vh + rect.height);
			p = Math.min(Math.max(p, 0), 1);
			ptHeading.style.transform = 'translateY(' + ((0.5 - p) * 110).toFixed(1) + 'px)';
		};

		var onPianitabScroll = function () {
			if (!ptTicking) {
				ptTicking = true;
				window.requestAnimationFrame(applyPianitab);
			}
		};

		window.addEventListener('scroll', onPianitabScroll, { passive: true });
		window.addEventListener('resize', onPianitabScroll, { passive: true });
		applyPianitab();
	}

	// Page hero (e.g. Piani) — mouse parallax on the gradient. Listens on the
	// window (so it tracks even over the fixed header) and moves the gradient
	// toward the cursor. The continuous aurora runs on the ::before/::after
	// layers, so this only nudges the container — the two never fight over
	// `transform`.
	var pheroBg = document.querySelector('.ih-phero__bg');
	var pheroSection = pheroBg ? pheroBg.closest('.ih-phero') : null;

	if (pheroBg && pheroSection && !prefersReduced) {
		var pheroPxTicking = false;
		var pheroTX = 0;
		var pheroTY = 0;
		var PHERO_MAX = 170; // total edge-to-edge travel of the gradient (px)

		var pheroClamp = function (v) {
			return v < -0.5 ? -0.5 : v > 0.5 ? 0.5 : v;
		};

		var onPheroMove = function (e) {
			var rect = pheroSection.getBoundingClientRect();
			// Ignore once the hero has scrolled well out of view.
			if (rect.bottom < 0) {
				return;
			}
			pheroTX = pheroClamp((e.clientX - rect.left) / rect.width - 0.5) * PHERO_MAX;
			pheroTY = pheroClamp((e.clientY - rect.top) / rect.height - 0.5) * PHERO_MAX;
			if (!pheroPxTicking) {
				pheroPxTicking = true;
				window.requestAnimationFrame(function () {
					pheroPxTicking = false;
					pheroBg.style.transform = 'translate3d(' + pheroTX.toFixed(1) + 'px, ' + pheroTY.toFixed(1) + 'px, 0)';
				});
			}
		};

		window.addEventListener('mousemove', onPheroMove, { passive: true });
	}

	// TCO calculator — "istituto / centro" toggle.
	var tcoHiddenStruttura = document.getElementById('tco-tipo-struttura');
	var tcoToggle = tcoHiddenStruttura ? tcoHiddenStruttura.closest('.ih-tco__field').querySelector('.ih-tco__toggle') : null;
	var tcoRowCentro = document.getElementById('tco-row-centro');
	var tcoRowIstituto = document.getElementById('tco-row-istituto');

	var tcoApplyStrutturaVisibility = function (value) {
		var isIstituto = value === 'istituto';
		if (tcoRowCentro) {
			tcoRowCentro.hidden = isIstituto;
		}
		if (tcoRowIstituto) {
			tcoRowIstituto.hidden = !isIstituto;
		}
	};

	if (tcoToggle) {
		var tcoOpts = tcoToggle.querySelectorAll('.ih-tco__toggle-opt');
		tcoToggle.addEventListener('click', function (e) {
			var opt = e.target.closest('.ih-tco__toggle-opt');
			if (!opt) {
				return;
			}
			tcoOpts.forEach(function (o) {
				o.classList.toggle('is-active', o === opt);
				o.setAttribute('aria-checked', o === opt ? 'true' : 'false');
			});
			if (tcoHiddenStruttura) {
				tcoHiddenStruttura.value = opt.getAttribute('data-value');
			}
			tcoApplyStrutturaVisibility(opt.getAttribute('data-value'));
		});
		tcoApplyStrutturaVisibility(tcoHiddenStruttura ? tcoHiddenStruttura.value : 'istituto');
	}

	// TCO calculator — "possiedi già un laboratorio?" toggle.
	var tcoLabToggle = document.querySelector('#tco-row-istituto .ih-tco__toggle');
	if (tcoLabToggle) {
		var tcoLabHidden = document.getElementById('tco-ha-laboratorio');
		var tcoLabOpts = tcoLabToggle.querySelectorAll('.ih-tco__toggle-opt');
		tcoLabToggle.addEventListener('click', function (e) {
			var opt = e.target.closest('.ih-tco__toggle-opt');
			if (!opt) {
				return;
			}
			tcoLabOpts.forEach(function (o) {
				o.classList.toggle('is-active', o === opt);
				o.setAttribute('aria-checked', o === opt ? 'true' : 'false');
			});
			if (tcoLabHidden) {
				tcoLabHidden.value = opt.getAttribute('data-value');
			}
		});
	}

	// Product page "Dotazione" — PRO/LITE switch swaps the visible panel.
	var pdotaSwitch = document.querySelector('.ih-pdota__switch');
	if (pdotaSwitch) {
		var pdotaThumb = pdotaSwitch.querySelector('.ih-pdota__switch-thumb');
		var pdotaOpts = pdotaSwitch.querySelectorAll('.ih-pdota__switch-opt');
		var pdotaPanels = document.querySelectorAll('.ih-pdota__panel');
		pdotaSwitch.addEventListener('click', function (e) {
			var opt = e.target.closest('.ih-pdota__switch-opt');
			if (!opt) {
				return;
			}
			var version = opt.getAttribute('data-version');
			var index = Array.prototype.indexOf.call(pdotaOpts, opt);
			pdotaOpts.forEach(function (o) {
				o.classList.toggle('is-active', o === opt);
				o.setAttribute('aria-selected', o === opt ? 'true' : 'false');
			});
			if (pdotaThumb) {
				// Generic for any option count — translateX(N%) moves by N
				// times the thumb's own width, so this works whether the
				// switch has 2 tiers (Weld/Firefighter) or 3 (Forklift).
				pdotaThumb.style.transform = 'translateX(' + (index * 100) + '%)';
			}
			pdotaPanels.forEach(function (panel) {
				panel.hidden = panel.getAttribute('data-version-panel') !== version;
			});
		});
	}

	// Product page "Confronta i modelli" — Funzionalità/Hardware switch.
	var compSwitch = document.getElementById('ih-comp-switch');
	if (compSwitch) {
		var compThumb = compSwitch.querySelector('.ih-pcomp__switch-thumb');
		var compOpts = compSwitch.querySelectorAll('.ih-pcomp__switch-opt');
		var compPanels = document.querySelectorAll('.ih-pcomp__panel');
		compSwitch.addEventListener('click', function (e) {
			var opt = e.target.closest('.ih-pcomp__switch-opt');
			if (!opt) {
				return;
			}
			var key = opt.getAttribute('data-comp');
			var index = Array.prototype.indexOf.call(compOpts, opt);
			compOpts.forEach(function (o) {
				o.classList.toggle('is-active', o === opt);
				o.setAttribute('aria-selected', o === opt ? 'true' : 'false');
			});
			if (compThumb) {
				compThumb.style.transform = index === 0 ? 'translateX(0)' : 'translateX(100%)';
			}
			compPanels.forEach(function (panel) {
				panel.hidden = panel.getAttribute('data-comp-panel') !== key;
			});
		});
	}

	// Product page "Scoprilo nel dettaglio" — pills crossfade the stage image.
	var dettStage = document.getElementById('ih-dett');
	if (dettStage) {
		var dettPills = dettStage.querySelectorAll('.ih-pdett__pill');
		var dettSlides = dettStage.querySelectorAll('.ih-pdett__slide');
		var dettCurrent = 0;
		var dettTimer = null;
		var DETT_INTERVAL = 4000;

		var dettActivate = function (idx) {
			dettCurrent = idx;
			dettPills.forEach(function (p, i) {
				p.classList.toggle('is-active', i === idx);
				p.setAttribute('aria-selected', i === idx ? 'true' : 'false');
			});
			dettSlides.forEach(function (slide, i) {
				slide.classList.toggle('is-active', i === idx);
			});
		};

		var dettStart = function () {
			// Always clear first: mouseleave and the pill click both call this,
			// and a bare setInterval here stacked a second timer on top of the
			// running one (hover -> click -> leave), so slides skipped ahead.
			window.clearInterval(dettTimer);
			if (!prefersReduced && dettSlides.length > 1) {
				dettTimer = window.setInterval(function () {
					dettActivate((dettCurrent + 1) % dettSlides.length);
				}, DETT_INTERVAL);
			}
		};

		var dettStop = function () {
			window.clearInterval(dettTimer);
		};

		dettStage.addEventListener('click', function (e) {
			var pill = e.target.closest('.ih-pdett__pill');
			if (!pill) {
				return;
			}
			dettActivate(Array.prototype.indexOf.call(dettPills, pill));
			// Restart the clock so the user's pick gets a full interval.
			dettStop();
			dettStart();
		});

		// Pause while the user is reading/hovering the stage.
		dettStage.addEventListener('mouseenter', dettStop);
		dettStage.addEventListener('mouseleave', dettStart);

		dettStart();
	}

	// Scroll-snap carousel (testimonials, "casi reali"). The track is a native
	// scroll-snap scroller, so swipe/drag/keyboard already work — this only
	// wires the arrows and keeps the progress bar in sync with scroll position.
	var initSnapCarousel = function (opts) {
		var viewport = document.getElementById(opts.viewport);
		if (!viewport) {
			return;
		}
		var bar = document.getElementById(opts.bar);
		var navs = document.querySelectorAll(opts.nav);
		var cards = viewport.querySelectorAll(opts.card);
		var ticking = false;

		var step = function () {
			if (!cards.length) {
				return viewport.clientWidth;
			}
			var first = cards[0].getBoundingClientRect();
			// Card width plus the flex gap, so one click advances exactly one card.
			var gap = 0;
			if (cards.length > 1) {
				gap = cards[1].getBoundingClientRect().left - first.right;
			}
			return first.width + gap;
		};

		var sync = function () {
			ticking = false;
			var max = viewport.scrollWidth - viewport.clientWidth;
			var p = max > 0 ? viewport.scrollLeft / max : 0;
			if (bar) {
				// The thumb is one card's share of the track, slid along by p.
				var share = cards.length ? 100 / cards.length : 100;
				bar.style.width = share + '%';
				bar.style.left = (p * (100 - share)) + '%';
			}
			navs.forEach(function (btn) {
				var dir = parseInt(btn.getAttribute('data-dir'), 10);
				btn.disabled = dir < 0 ? viewport.scrollLeft <= 1 : viewport.scrollLeft >= max - 1;
			});
		};

		navs.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var dir = parseInt(btn.getAttribute('data-dir'), 10) || 1;
				viewport.scrollBy({ left: dir * step(), behavior: prefersReduced ? 'auto' : 'smooth' });
			});
		});

		viewport.addEventListener('scroll', function () {
			if (!ticking) {
				ticking = true;
				window.requestAnimationFrame(sync);
			}
		}, { passive: true });
		window.addEventListener('resize', sync, { passive: true });
		sync();
	};

	initSnapCarousel({ viewport: 'ih-testi-viewport', bar: 'ih-testi-bar', nav: '.ih-testi__nav', card: '.ih-testi__card' });
	initSnapCarousel({ viewport: 'ih-casi-viewport', bar: 'ih-casi-bar', nav: '.ih-casi__nav', card: '.ih-casi__card' });

	// FAQ accordion — one item open at a time, smooth grid-rows expand.
	var faqItems = document.querySelectorAll('.ih-faq__item');
	if (faqItems.length) {
		Array.prototype.forEach.call(faqItems, function (item) {
			var q = item.querySelector('.ih-faq__q');
			if (!q) {
				return;
			}
			q.addEventListener('click', function () {
				var isOpen = item.classList.contains('is-open');
				Array.prototype.forEach.call(faqItems, function (other) {
					other.classList.remove('is-open');
					var ob = other.querySelector('.ih-faq__q');
					if (ob) {
						ob.setAttribute('aria-expanded', 'false');
					}
				});
				if (!isOpen) {
					item.classList.add('is-open');
					q.setAttribute('aria-expanded', 'true');
				}
			});
		});
	}
	// Split hero (Home) — pointer/focus state for the two halves.
	// CSS does all the animating; this only stamps .is-active on the half
	// being engaged and .is-dim on the other, plus .is-engaged on the
	// section so it knows to leave the resting 50/50 split. Done in JS
	// rather than with :has() so keyboard focus behaves exactly like hover.
	var splitHero = document.querySelector('.ih-splithero');
	if (splitHero) {
		var splitSides = splitHero.querySelectorAll('.ih-splithero__side');
		var setSplitState = function (activeSide) {
			splitHero.classList.toggle('is-engaged', !!activeSide);
			Array.prototype.forEach.call(splitSides, function (side) {
				side.classList.toggle('is-active', side === activeSide);
				side.classList.toggle('is-dim', !!activeSide && side !== activeSide);
			});
		};

		Array.prototype.forEach.call(splitSides, function (side) {
			side.addEventListener('mouseenter', function () {
				setSplitState(side);
			});
			side.addEventListener('focus', function () {
				setSplitState(side);
			});
			side.addEventListener('blur', function () {
				setSplitState(null);
			});
		});

		splitHero.addEventListener('mouseleave', function () {
			if (!splitHero.querySelector('.ih-splithero__side:focus-visible')) {
				setSplitState(null);
			}
		});
	}

	// Project slider hero (Altri Servizi) — .ih-shero.
	// CSS owns the split-vertical wipe; this only tracks the index, stamps
	// .is-current / .is-leaving and sets data-dir so the CSS knows which way
	// the halves travel. Autoplay pauses on hover, focus and when the hero
	// scrolls out of view.
	var sHero = document.querySelector('.ih-shero');
	if (sHero) {
		var sSlides = [].slice.call(sHero.querySelectorAll('.ih-shero__slide'));
		var sCopies = [].slice.call(sHero.querySelectorAll('.ih-shero__copy'));
		var sCount = sHero.querySelector('.ih-shero__count-cur');
		var sPrev = sHero.querySelector('.ih-shero__nav--prev');
		var sNext = sHero.querySelector('.ih-shero__nav--next');
		var sIndex = 0;
		var sBusy = false;
		var sTimer = null;
		var sPaused = false;
		var S_DURATION = 950; // must match the .ih-shero__half transition
		var S_INTERVAL = 7000;

		var sGoTo = function (target, dir) {
			if (sBusy || sSlides.length < 2) {
				return;
			}
			target = (target + sSlides.length) % sSlides.length;
			if (target === sIndex) {
				return;
			}
			sBusy = true;
			sHero.setAttribute('data-dir', dir);

			var leaving = sSlides[sIndex];
			var entering = sSlides[target];

			// Force a reflow between setting the direction and moving the
			// slides, so the incoming halves are parked on the correct side
			// before their transition starts. Without it a direction change
			// makes them animate from wherever the previous direction left
			// them.
			void sHero.offsetHeight;

			leaving.classList.remove('is-current');
			leaving.classList.add('is-leaving');
			leaving.setAttribute('aria-hidden', 'true');
			entering.classList.add('is-current');
			entering.setAttribute('aria-hidden', 'false');

			sCopies[sIndex].classList.remove('is-current');
			sCopies[target].classList.add('is-current');

			if (sCount) {
				sCount.textContent = (target + 1 < 10 ? '0' : '') + (target + 1);
			}

			sIndex = target;
			window.setTimeout(function () {
				leaving.classList.remove('is-leaving');
				sBusy = false;
			}, S_DURATION);
		};

		var sStop = function () {
			if (sTimer) {
				window.clearInterval(sTimer);
				sTimer = null;
			}
		};

		var sStart = function () {
			sStop();
			if (prefersReduced || sPaused || sSlides.length < 2) {
				return;
			}
			sTimer = window.setInterval(function () {
				sGoTo(sIndex + 1, 'next');
			}, S_INTERVAL);
		};

		if (sPrev) {
			sPrev.addEventListener('click', function () {
				sGoTo(sIndex - 1, 'prev');
				sStart();
			});
		}
		if (sNext) {
			sNext.addEventListener('click', function () {
				sGoTo(sIndex + 1, 'next');
				sStart();
			});
		}

		sHero.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowLeft') {
				sGoTo(sIndex - 1, 'prev');
				sStart();
			} else if (e.key === 'ArrowRight') {
				sGoTo(sIndex + 1, 'next');
				sStart();
			}
		});

		// Horizontal swipe on touch.
		var sTouchX = null;
		sHero.addEventListener('touchstart', function (e) {
			sTouchX = e.touches[0].clientX;
		}, { passive: true });
		sHero.addEventListener('touchend', function (e) {
			if (sTouchX === null) {
				return;
			}
			var dx = e.changedTouches[0].clientX - sTouchX;
			sTouchX = null;
			if (Math.abs(dx) > 45) {
				sGoTo(sIndex + (dx < 0 ? 1 : -1), dx < 0 ? 'next' : 'prev');
				sStart();
			}
		});

		sHero.addEventListener('mouseenter', function () {
			sPaused = true;
			sStop();
		});
		sHero.addEventListener('mouseleave', function () {
			sPaused = false;
			sStart();
		});
		sHero.addEventListener('focusin', function () {
			sPaused = true;
			sStop();
		});
		sHero.addEventListener('focusout', function () {
			if (!sHero.contains(document.activeElement)) {
				sPaused = false;
				sStart();
			}
		});

		// Don't burn frames animating a hero that's scrolled past.
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				if (entries[0].isIntersecting) {
					sStart();
				} else {
					sStop();
				}
			}, { threshold: 0.2 }).observe(sHero);
		} else {
			sStart();
		}
	}

	// Portfolio archive — client-side filtering.
	// Groups are static bars, not accordions: nothing opens or closes here.
	// Sector filters hide individual cards,
	// technology filters hide whole panels; a panel with no visible cards
	// left hides itself too. No filters active means show everything.
	var pfRoot = document.getElementById('ih-portfolio');
	if (pfRoot) {
		var pfPanels = [].slice.call(pfRoot.querySelectorAll('.ih-pfp'));
		var pfFilters = [].slice.call(pfRoot.querySelectorAll('.ih-pf__filter'));
		var pfReset = pfRoot.querySelector('.ih-pf__reset');
		var pfNoResults = pfRoot.querySelector('.ih-pf__noresults');

		// The card's bottom bar is a backdrop-filter frost, so its colour
		// follows the artwork for free — but text colour can't. Sample the
		// strip the bar sits over and stamp .is-light when it's bright, so
		// the title flips to dark text there. Uploads are same-origin, so
		// the canvas isn't tainted; the try/catch is there in case artwork
		// is ever served from elsewhere, in which case the default white
		// text stands.
		var pfTintCard = function (card) {
			var img = card.querySelector('.ih-pfc__media img');
			var bar = card.querySelector('.ih-pfc__title');
			if (!img || !bar) {
				return;
			}

			var measure = function () {
				if (!img.naturalWidth) {
					return;
				}
				try {
					var w = 24;
					var h = 8;
					var canvas = document.createElement('canvas');
					canvas.width = w;
					canvas.height = h;
					var ctx = canvas.getContext('2d');

					// Same share of the image that the bar covers on screen.
					var frac = (bar.offsetHeight / card.offsetHeight) || 0.22;
					var sh = Math.max(1, Math.round(img.naturalHeight * frac));
					var sy = img.naturalHeight - sh;

					ctx.drawImage(img, 0, sy, img.naturalWidth, sh, 0, 0, w, h);

					var data = ctx.getImageData(0, 0, w, h).data;
					var total = 0;
					for (var i = 0; i < data.length; i += 4) {
						total += 0.2126 * data[i] + 0.7152 * data[i + 1] + 0.0722 * data[i + 2];
					}
					var lum = total / (data.length / 4);
					card.classList.toggle('is-light', lum > 140);
				} catch (e) {
					// Tainted canvas — keep the default white text.
				}
			};

			if (img.complete) {
				measure();
			} else {
				img.addEventListener('load', measure, { once: true });
			}
		};

		[].slice.call(pfRoot.querySelectorAll('.ih-pfc')).forEach(pfTintCard);

		var pfActive = function (group) {
			return pfFilters.filter(function (b) {
				return b.getAttribute('aria-pressed') === 'true' &&
					b.closest('.ih-pf__filters').getAttribute('data-filter-group') === group;
			}).map(function (b) {
				return b.getAttribute('data-slug');
			});
		};

		var pfApply = function () {
			var settori = pfActive('settore');
			var tecnologie = pfActive('tecnologia');
			var anyVisible = false;

			pfPanels.forEach(function (panel) {
				var cards = [].slice.call(panel.querySelectorAll('.ih-pfc'));
				var shown = 0;

				cards.forEach(function (card) {
					var slugs = (card.getAttribute('data-settori') || '').split(' ');
					var settoreOk = !settori.length || settori.some(function (s) {
						return slugs.indexOf(s) !== -1;
					});
					// Technologies live on each card (the panels are hand-made
					// groups, not one panel per technology).
					var techSlugs = (card.getAttribute('data-tecnologie') || '').split(' ');
					var techOk = !tecnologie.length || tecnologie.some(function (t) {
						return techSlugs.indexOf(t) !== -1;
					});
					var visible = techOk && settoreOk;
					card.classList.toggle('is-filtered', !visible);
					if (visible) {
						shown++;
					}
				});

				var panelVisible = shown > 0;
				panel.classList.toggle('is-filtered', !panelVisible);
				if (panelVisible) {
					anyVisible = true;
				}
			});

			if (pfNoResults) {
				pfNoResults.hidden = anyVisible;
			}
			if (pfReset) {
				pfReset.hidden = !(settori.length || tecnologie.length);
			}
		};

		pfFilters.forEach(function (btn) {
			btn.addEventListener('click', function () {
				btn.setAttribute('aria-pressed', btn.getAttribute('aria-pressed') === 'true' ? 'false' : 'true');
				pfApply();
			});
		});

		if (pfReset) {
			pfReset.addEventListener('click', function () {
				pfFilters.forEach(function (b) {
					b.setAttribute('aria-pressed', 'false');
				});
				pfApply();
			});
		}

		// Deep-link a filter in: a project page's taxonomy pills
		// (single-immensive_work.php) link here as ?settore=slug or
		// ?tecnologia=slug instead of to the term archive, so the pill lands
		// the visitor on this page with that same filter already pressed.
		var pfParams = new URLSearchParams(window.location.search);
		var pfLinked = false;
		['settore', 'tecnologia'].forEach(function (group) {
			var slug = pfParams.get(group);
			if (!slug) {
				return;
			}
			var btn = pfFilters.filter(function (b) {
				return b.getAttribute('data-slug') === slug &&
					b.closest('.ih-pf__filters').getAttribute('data-filter-group') === group;
			})[0];
			if (btn) {
				btn.setAttribute('aria-pressed', 'true');
				pfLinked = true;
			}
		});
		if (pfLinked) {
			pfApply();
			pfRoot.scrollIntoView({ block: 'start' });
		}
	}

	// "Torna indietro" links: go back to the previous page when there is one
	// (same-site referrer), otherwise the link's own href (home) applies.
	Array.prototype.forEach.call(document.querySelectorAll('[data-history-back]'), function (link) {
		link.addEventListener('click', function (e) {
			var sameSite = document.referrer && document.referrer.indexOf(window.location.origin) === 0;
			if (sameSite && window.history.length > 1) {
				e.preventDefault();
				window.history.back();
			}
		});
	});

	// Contact form (Contatti page) — AJAX submit to admin-ajax.php instead of
	// a native POST, so the page doesn't reload and can show inline status.
	// window.immensiveContact is localized in functions.php's immensive_scripts().
	var contactForm = document.getElementById('ih-cont-form');
	if (contactForm && window.immensiveContact) {
		var cfStatus = document.getElementById('ih-cont-form-status');
		var cfSubmit = contactForm.querySelector('.ih-cont-form__submit');

		var cfSetStatus = function (message, isError) {
			if (!cfStatus) {
				return;
			}
			cfStatus.textContent = message;
			cfStatus.hidden = !message;
			cfStatus.classList.toggle('is-error', !!isError);
			cfStatus.classList.toggle('is-success', !isError && !!message);
		};

		contactForm.addEventListener('submit', function (e) {
			e.preventDefault();

			var formData = new FormData(contactForm);
			formData.append('action', 'immensive_contact_form');
			formData.append('nonce', window.immensiveContact.nonce);

			if (cfSubmit) {
				cfSubmit.disabled = true;
			}
			cfSetStatus('', false);

			fetch(window.immensiveContact.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				body: formData
			})
				.then(function (res) {
					return res.json();
				})
				.then(function (json) {
					if (json && json.success) {
						cfSetStatus((json.data && json.data.message) || 'Grazie! Ti risponderemo al più presto.', false);
						contactForm.reset();
					} else {
						cfSetStatus((json && json.data && json.data.message) || 'Invio non riuscito. Riprova più tardi.', true);
					}
				})
				.catch(function () {
					cfSetStatus('Invio non riuscito. Controlla la connessione e riprova.', true);
				})
				.finally(function () {
					if (cfSubmit) {
						cfSubmit.disabled = false;
					}
				});
		});
	}

	// Demo request popup (product pages' "Richiedi Demo" CTA) —
	// template-parts/demo-modal.php + immensive_handle_demo_form() in
	// functions.php. Same AJAX-submit pattern as the Contatti form above,
	// just against a different action/nonce so it always mails
	// info@immensive.it regardless of the form's originating page.
	var demoModal = document.getElementById('ih-demo-modal');
	if (demoModal) {
		var demoOpeners = document.querySelectorAll('[data-demo-modal-open]');
		var demoClosers = demoModal.querySelectorAll('[data-modal-close]');
		var demoForm = document.getElementById('ih-demo-form');
		var demoStatus = document.getElementById('ih-demo-form-status');
		var demoSubmit = demoForm ? demoForm.querySelector('.ih-cont-form__submit') : null;
		var demoLastFocus = null;

		var demoOpen = function () {
			demoLastFocus = document.activeElement;
			demoModal.classList.add('is-open');
			demoModal.setAttribute('aria-hidden', 'false');
			document.body.classList.add('ih-modal-open');
			var firstField = demoForm ? demoForm.querySelector('.ih-field__input:not([tabindex="-1"])') : null;
			if (firstField) {
				firstField.focus();
			}
		};

		var demoClose = function () {
			demoModal.classList.remove('is-open');
			demoModal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('ih-modal-open');
			if (demoLastFocus && typeof demoLastFocus.focus === 'function') {
				demoLastFocus.focus();
			}
		};

		demoOpeners.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				demoOpen();
			});
		});

		demoClosers.forEach(function (el) {
			el.addEventListener('click', demoClose);
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && demoModal.classList.contains('is-open')) {
				demoClose();
			}
		});

		var demoSetStatus = function (message, isError) {
			if (!demoStatus) {
				return;
			}
			demoStatus.textContent = message;
			demoStatus.hidden = !message;
			demoStatus.classList.toggle('is-error', !!isError);
			demoStatus.classList.toggle('is-success', !isError && !!message);
		};

		if (demoForm && window.immensiveContact) {
			demoForm.addEventListener('submit', function (e) {
				e.preventDefault();

				var formData = new FormData(demoForm);
				formData.append('action', 'immensive_demo_form');
				formData.append('nonce', window.immensiveContact.demoNonce);

				if (demoSubmit) {
					demoSubmit.disabled = true;
				}
				demoSetStatus('', false);

				fetch(window.immensiveContact.ajaxUrl, {
					method: 'POST',
					credentials: 'same-origin',
					body: formData
				})
					.then(function (res) {
						return res.json();
					})
					.then(function (json) {
						if (json && json.success) {
							demoSetStatus((json.data && json.data.message) || 'Grazie! Ti risponderemo al più presto.', false);
							demoForm.reset();
						} else {
							demoSetStatus((json && json.data && json.data.message) || 'Invio non riuscito. Riprova più tardi.', true);
						}
					})
					.catch(function () {
						demoSetStatus('Invio non riuscito. Controlla la connessione e riprova.', true);
					})
					.finally(function () {
						if (demoSubmit) {
							demoSubmit.disabled = false;
						}
					});
			});
		}
	}

	// Project gallery lightbox + video popup (single-immensive_work.php).
	// Progressive enhancement over the plain <img>/<video> markup the client
	// fills in via the editor — .ih-pj__content's own CSS already lays out
	// the gallery grid and video tiles; this just wires up the click-to-
	// enlarge / click-to-play behaviour on top of it.
	var lightbox = document.getElementById('ih-lightbox');
	if (lightbox) {
		var lbOverlay  = lightbox.querySelector('.ih-lightbox__overlay');
		var lbImg      = lightbox.querySelector('.ih-lightbox__img');
		var lbCaption  = lightbox.querySelector('.ih-lightbox__caption');
		var lbCounter  = lightbox.querySelector('.ih-lightbox__counter');
		var lbPrev     = lightbox.querySelector('.ih-lightbox__nav--prev');
		var lbNext     = lightbox.querySelector('.ih-lightbox__nav--next');
		var lbCloseEls = lightbox.querySelectorAll('[data-lightbox-close]');
		var lbItems    = [];
		var lbIndex    = 0;
		var lbLastFocus = null;

		var lbRender = function () {
			var item = lbItems[lbIndex];
			if (!item) {
				return;
			}
			lbImg.src = item.src;
			lbImg.alt = item.alt || '';
			if (lbCaption) {
				lbCaption.textContent = item.caption || '';
				lbCaption.hidden = !item.caption;
			}
			if (lbCounter) {
				lbCounter.textContent = (lbIndex + 1) + ' / ' + lbItems.length;
			}
			var multi = lbItems.length > 1;
			if (lbPrev) { lbPrev.hidden = !multi; }
			if (lbNext) { lbNext.hidden = !multi; }
		};

		var lbOpen = function (items, startIndex) {
			lbItems = items;
			lbIndex = startIndex;
			lbLastFocus = document.activeElement;
			lbRender();
			lightbox.classList.add('is-open');
			lightbox.setAttribute('aria-hidden', 'false');
			document.body.classList.add('ih-lightbox-open');
		};

		var lbClose = function () {
			lightbox.classList.remove('is-open');
			lightbox.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('ih-lightbox-open');
			lbImg.src = '';
			if (lbLastFocus && typeof lbLastFocus.focus === 'function') {
				lbLastFocus.focus();
			}
		};

		var lbStep = function (dir) {
			if (!lbItems.length) {
				return;
			}
			lbIndex = (lbIndex + dir + lbItems.length) % lbItems.length;
			lbRender();
		};

		lbCloseEls.forEach(function (el) {
			el.addEventListener('click', lbClose);
		});
		if (lbPrev) { lbPrev.addEventListener('click', function () { lbStep(-1); }); }
		if (lbNext) { lbNext.addEventListener('click', function () { lbStep(1); }); }

		document.addEventListener('keydown', function (e) {
			if (!lightbox.classList.contains('is-open')) {
				return;
			}
			if (e.key === 'Escape') { lbClose(); }
			if (e.key === 'ArrowLeft') { lbStep(-1); }
			if (e.key === 'ArrowRight') { lbStep(1); }
		});

		// Swipe between images on touch devices.
		var lbTouchX = null;
		lightbox.addEventListener('touchstart', function (e) {
			lbTouchX = e.changedTouches[0].clientX;
		}, { passive: true });
		lightbox.addEventListener('touchend', function (e) {
			if (lbTouchX === null) {
				return;
			}
			var dx = e.changedTouches[0].clientX - lbTouchX;
			if (Math.abs(dx) > 40) {
				lbStep(dx < 0 ? 1 : -1);
			}
			lbTouchX = null;
		}, { passive: true });

		// Every gallery in the post content gets its own slide set, keyed off
		// its images at bind time — clicking image 3 of a 5-image gallery
		// opens the lightbox already on slide 3 of 5, not slide 3 of "every
		// image on the page".
		var galleries = document.querySelectorAll('.ih-pj__content .wp-block-gallery, .ih-pj__content .gallery');
		galleries.forEach(function (gallery) {
			var imgs = Array.prototype.slice.call(gallery.querySelectorAll('img'));
			var items = imgs.map(function (img) {
				var figure  = img.closest('figure');
				var caption = figure ? figure.querySelector('figcaption, .gallery-caption') : null;
				return {
					src: img.currentSrc || img.src,
					alt: img.alt,
					caption: caption ? caption.textContent.trim() : ''
				};
			});
			imgs.forEach(function (img, i) {
				var link = img.closest('a');
				if (link) {
					link.addEventListener('click', function (e) {
						e.preventDefault();
					});
				}
				img.addEventListener('click', function () {
					lbOpen(items, i);
				});
			});
		});
	}

	var videoModal = document.getElementById('ih-video-modal');
	if (videoModal) {
		var vmVideo    = videoModal.querySelector('video');
		var vmFrame    = videoModal.querySelector('iframe');
		var vmCloseEls = videoModal.querySelectorAll('[data-video-modal-close]');
		var vmLastFocus = null;

		// Self-hosted files (.mp4/.webm/...) play in the <video>; anything
		// else (a YouTube/Vimeo URL from data-video-src) is treated as an
		// embed and goes in the <iframe> instead — a project's video section
		// can freely mix uploaded clips and linked embeds.
		var vmEmbedUrl = function (src) {
			var yt = src.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w-]+)/);
			if (yt) {
				return 'https://www.youtube.com/embed/' + yt[1] + '?autoplay=1&rel=0';
			}
			var vimeo = src.match(/vimeo\.com\/(\d+)/);
			if (vimeo) {
				return 'https://player.vimeo.com/video/' + vimeo[1] + '?autoplay=1';
			}
			return null;
		};

		var vmClose = function () {
			videoModal.classList.remove('is-open');
			videoModal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('ih-video-modal-open');
			if (vmVideo) {
				vmVideo.pause();
				vmVideo.removeAttribute('src');
				vmVideo.load();
				vmVideo.hidden = false;
			}
			if (vmFrame) {
				vmFrame.src = '';
				vmFrame.hidden = true;
			}
			if (vmLastFocus && typeof vmLastFocus.focus === 'function') {
				vmLastFocus.focus();
			}
		};

		var vmOpen = function (src) {
			vmLastFocus = document.activeElement;
			var embed = vmEmbedUrl(src);
			if (embed && vmFrame) {
				if (vmVideo) {
					vmVideo.hidden = true;
				}
				vmFrame.hidden = false;
				vmFrame.src = embed;
			} else if (vmVideo) {
				vmVideo.hidden = false;
				vmVideo.src = src;
				vmVideo.currentTime = 0;
				vmVideo.play().catch(function () {});
			}
			videoModal.classList.add('is-open');
			videoModal.setAttribute('aria-hidden', 'false');
			document.body.classList.add('ih-video-modal-open');
		};

		vmCloseEls.forEach(function (el) {
			el.addEventListener('click', vmClose);
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && videoModal.classList.contains('is-open')) {
				vmClose();
			}
		});

		document.querySelectorAll('.ih-pj__video[data-video-src]').forEach(function (tile) {
			tile.addEventListener('click', function () {
				vmOpen(tile.getAttribute('data-video-src'));
			});
		});
	}

})();
