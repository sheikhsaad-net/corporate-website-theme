/* "Prenota una call" popup — UI only (nothing is sent yet).
   template-parts/booking-modal.php + assets/css/booking.css.
   Flow: date (today or later) -> free 30-minute slots -> details form -> confirmation.

   Time zones: the team's availability is defined in Europe/Rome. The visitor sees the same
   moments converted into the zone they choose (default: the visitor's own zone), so the calendar day,
   the list of slots and the confirmation always speak the visitor's local time. */
(function () {
	'use strict';

	var root = document.getElementById('ih-booking');
	if (!root) { return; }

	var reduced = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
	var MONTHS = ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'];
	var WEEKDAYS = ['domenica', 'lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato'];
	var MAX_MONTHS_AHEAD = 6;
	var HOME_TZ = 'Europe/Rome';
	var POPULAR = ['Europe/Rome', 'Europe/London', 'Europe/Berlin', 'America/New_York', 'America/Chicago', 'America/Los_Angeles', 'America/Sao_Paulo', 'Asia/Dubai', 'Asia/Kolkata', 'Asia/Singapore', 'Asia/Tokyo', 'Australia/Sydney'];

	var dialog = root.querySelector('.ih-bk__dialog');
	var views = {};
	root.querySelectorAll('[data-view]').forEach(function (v) { views[v.getAttribute('data-view')] = v; });
	var stepItems = root.querySelectorAll('.ih-bk__steps li[data-step]');
	var stepBar = root.querySelector('.ih-bk__steps-bar i');
	var daysEl = root.querySelector('[data-bk-days]');
	var monthEl = root.querySelector('[data-bk-month]');
	var prevBtn = root.querySelector('[data-bk-prev]');
	var nextBtn = root.querySelector('[data-bk-next]');
	var slotsEl = root.querySelector('[data-bk-slots]');
	var emptyEl = root.querySelector('[data-bk-empty]');
	var form = root.querySelector('[data-bk-form]');
	var errorEl = root.querySelector('[data-bk-error]');

	var metaTz = root.querySelector('.ih-bk__meta-tz');
	var tzOpenBtn = root.querySelector('[data-bk-tz-open]');
	var tzPanel = root.querySelector('[data-bk-tz-panel]');
	var tzSearch = root.querySelector('[data-bk-tz-search]');
	var tzList = root.querySelector('[data-bk-tz-list]');
	var h24Input = root.querySelector('[data-bk-h24]');
	var tzEmpty = root.querySelector('[data-bk-tz-empty]');
	var tzDetectBtn = root.querySelector('[data-bk-tz-detect]');

	var deviceTz = (function () { try { return Intl.DateTimeFormat().resolvedOptions().timeZone || ''; } catch (e) { return ''; } })();
	var tz = (deviceTz && validZone(deviceTz)) ? deviceTz : HOME_TZ; // visitor's own zone by default
	var today = new Date(); // calendar date "today" in the chosen zone (only y/m/d are used)
	var viewMonth = new Date();
	var state = { date: null, ms: null, view: 'date' };
	var lastFocus = null;
	var h24 = true;
	var clockTimer = null;

	function pad(n) { return (n < 10 ? '0' : '') + n; }
	function sameDay(a, b) { return a && b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
	function longDate(d) { return WEEKDAYS[d.getDay()] + ' ' + d.getDate() + ' ' + MONTHS[d.getMonth()] + ' ' + d.getFullYear(); }

	/* ---------- Time zone maths (Intl only, no libraries) ---------- */
	var fmtCache = {};
	function formatter(zone) {
		if (!fmtCache[zone]) {
			fmtCache[zone] = new Intl.DateTimeFormat('en-US', { timeZone: zone, hourCycle: 'h23', year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric' });
		}
		return fmtCache[zone];
	}
	function partsOf(ms, zone) {
		var o = {};
		formatter(zone).formatToParts(new Date(ms)).forEach(function (p) { if (p.type !== 'literal') { o[p.type] = +p.value; } });
		return { y: o.year, m: o.month - 1, d: o.day, h: o.hour % 24, min: o.minute };
	}
	function offsetMin(ms, zone) {
		var p = partsOf(ms, zone);
		return Math.round((Date.UTC(p.y, p.m, p.d, p.h, p.min) - Math.floor(ms / 60000) * 60000) / 60000);
	}
	function zonedToMs(y, m, d, h, min, zone) {
		var guess = Date.UTC(y, m, d, h, min);
		var o1 = offsetMin(guess, zone);
		var ms = guess - o1 * 60000;
		var o2 = offsetMin(ms, zone);
		if (o2 !== o1) { ms = guess - o2 * 60000; }
		return ms;
	}
	function offsetLabel(ms, zone) {
		var o = offsetMin(ms, zone);
		var a = Math.abs(o);
		return 'UTC' + (o < 0 ? '−' : '+') + pad(Math.floor(a / 60)) + ':' + pad(a % 60);
	}
	function zoneTitle(zone) { return zone.replace(/_/g, ' '); }
	function validZone(zone) { try { formatter(zone); return true; } catch (e) { return false; } }
	function fmtHM(h, min) {
		if (h24) { return pad(h) + ':' + pad(min); }
		return ((h % 12) || 12) + ':' + pad(min) + ' ' + (h < 12 ? 'AM' : 'PM');
	}
	function timeOf(ms, zone) { var p = partsOf(ms, zone); return fmtHM(p.h, p.min); }
	function dateIn(ms, zone) { var p = partsOf(ms, zone); return new Date(p.y, p.m, p.d); }
	function nowDateIn(zone) { return dateIn(Date.now(), zone); }

	/* ---------- Availability (demo data, stable per moment) ----------
	   Team hours in Rome: 09:00-13:00 and 14:00-18:00, a slot every 30 minutes. Some slots are
	   "taken" so the list looks real; slots that are already past / within 30 minutes are dropped. */
	function hash(str) {
		var h = 2166136261;
		for (var i = 0; i < str.length; i++) { h ^= str.charCodeAt(i); h = Math.imul(h, 16777619); }
		return h >>> 0;
	}
	function slotsFor(date) {
		var out = [];
		var limit = Date.now() + 30 * 60000;
		for (var off = -1; off <= 1; off++) {
			var rome = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate() + off));
			var ry = rome.getUTCFullYear(), rm = rome.getUTCMonth(), rd = rome.getUTCDate();
			[[540, 780], [840, 1080]].forEach(function (range) {
				for (var m = range[0]; m < range[1]; m += 30) {
					if (hash(ry + '-' + rm + '-' + rd + ':' + m) % 100 < 26) { continue; } // taken
					var ms = zonedToMs(ry, rm, rd, Math.floor(m / 60), m % 60, HOME_TZ);
					if (ms <= limit) { continue; }
					if (!sameDay(dateIn(ms, tz), date)) { continue; }
					out.push(ms);
				}
			});
		}
		return out.sort(function (a, b) { return a - b; });
	}
	function groupOf(ms) {
		var h = partsOf(ms, tz).h;
		return h < 6 ? 'Notte' : h < 12 ? 'Mattina' : h < 18 ? 'Pomeriggio' : 'Sera';
	}
	function rangeLabel(ms) { return timeOf(ms, tz) + ' – ' + timeOf(ms + 30 * 60000, tz); }
	function romeNote(ms) { return tz === HOME_TZ ? '' : timeOf(ms, HOME_TZ) + ' a Roma'; }

	/* ---------- Calendar ---------- */
	function renderCalendar() {
		var y = viewMonth.getFullYear();
		var mo = viewMonth.getMonth();
		monthEl.innerHTML = MONTHS[mo] + ' <small>' + y + '</small>';
		var first = new Date(y, mo, 1);
		var lead = (first.getDay() + 6) % 7; // Monday first
		var total = new Date(y, mo + 1, 0).getDate();
		var html = '';
		var i;
		for (i = 0; i < lead; i++) { html += '<span class="ih-bk__day ih-bk__day--blank" aria-hidden="true"></span>'; }
		for (i = 1; i <= total; i++) {
			var d = new Date(y, mo, i);
			var past = d < today;
			var cls = 'ih-bk__day';
			if (sameDay(d, today)) { cls += ' is-today'; }
			if (sameDay(d, state.date)) { cls += ' is-selected'; }
			html += '<button type="button" role="gridcell" class="' + cls + '" data-d="' + i + '" style="--i:' + (lead + i) + '"' +
				(past ? ' disabled' : '') + ' aria-label="' + longDate(d) + '">' + i + '</button>';
		}
		daysEl.innerHTML = html;
		var minMonth = new Date(today.getFullYear(), today.getMonth(), 1);
		var maxMonth = new Date(today.getFullYear(), today.getMonth() + MAX_MONTHS_AHEAD, 1);
		prevBtn.disabled = viewMonth <= minMonth;
		nextBtn.disabled = viewMonth >= maxMonth;
	}

	daysEl.addEventListener('click', function (e) {
		var btn = e.target.closest('.ih-bk__day[data-d]');
		if (!btn || btn.disabled) { return; }
		state.date = new Date(viewMonth.getFullYear(), viewMonth.getMonth(), +btn.getAttribute('data-d'));
		state.ms = null;
		daysEl.querySelectorAll('.is-selected').forEach(function (n) { n.classList.remove('is-selected'); });
		btn.classList.add('is-selected');
		setTimeout(function () { renderSlots(); go('time'); }, reduced ? 0 : 260);
	});
	daysEl.addEventListener('keydown', function (e) {
		var delta = { ArrowLeft: -1, ArrowRight: 1, ArrowUp: -7, ArrowDown: 7 }[e.key];
		if (!delta) { return; }
		var btns = [].slice.call(daysEl.querySelectorAll('.ih-bk__day[data-d]:not(:disabled)'));
		var idx = btns.indexOf(document.activeElement);
		if (idx < 0) { return; }
		var next = btns[Math.max(0, Math.min(btns.length - 1, idx + delta))];
		if (next) { e.preventDefault(); next.focus(); }
	});
	prevBtn.addEventListener('click', function () { viewMonth = new Date(viewMonth.getFullYear(), viewMonth.getMonth() - 1, 1); renderCalendar(); });
	nextBtn.addEventListener('click', function () { viewMonth = new Date(viewMonth.getFullYear(), viewMonth.getMonth() + 1, 1); renderCalendar(); });

	/* ---------- Slots ---------- */
	function renderSlots() {
		var d = state.date;
		root.querySelector('[data-bk-date-label]').textContent = longDate(d);
		var list = slotsFor(d);
		var count = list.length;
		root.querySelector('[data-bk-count]').textContent = count
			? count + (count === 1 ? ' orario disponibile' : ' orari disponibili') + ' · 30 minuti · ' + zoneTitle(tz)
			: '';
		var groups = {};
		var order = ['Notte', 'Mattina', 'Pomeriggio', 'Sera'];
		list.forEach(function (ms) { (groups[groupOf(ms)] = groups[groupOf(ms)] || []).push(ms); });
		var html = '';
		var n = 0;
		order.forEach(function (g) {
			if (!groups[g]) { return; }
			html += '<div class="ih-bk__slot-group"><h4>' + g + '</h4><div class="ih-bk__slot-grid">';
			groups[g].forEach(function (ms) {
				html += '<button type="button" class="ih-bk__slot' + (ms === state.ms ? ' is-selected' : '') + '" data-ms="' + ms + '" style="--i:' + (n++) + '">' + timeOf(ms, tz) + '</button>';
			});
			html += '</div></div>';
		});
		slotsEl.innerHTML = html;
		slotsEl.hidden = !count;
		emptyEl.hidden = !!count;
	}

	function fillSummary() {
		root.querySelector('[data-bk-sum-date]').textContent = longDate(state.date);
		var line = root.querySelector('[data-bk-sum-time]');
		var note = romeNote(state.ms);
		line.innerHTML = rangeLabel(state.ms) + ' · ' + zoneTitle(tz) + ' · 30 min' + (note ? '<span class="ih-bk__rome">' + note + '</span>' : '');
	}

	slotsEl.addEventListener('click', function (e) {
		var btn = e.target.closest('.ih-bk__slot');
		if (!btn) { return; }
		slotsEl.querySelectorAll('.is-selected').forEach(function (n) { n.classList.remove('is-selected'); });
		btn.classList.add('is-selected');
		state.ms = +btn.getAttribute('data-ms');
		fillSummary();
		setTimeout(function () { go('form'); }, reduced ? 0 : 260);
	});
	root.querySelector('[data-bk-next-day]').addEventListener('click', function () {
		var n = new Date(state.date.getFullYear(), state.date.getMonth(), state.date.getDate() + 1);
		state.date = n;
		viewMonth = new Date(n.getFullYear(), n.getMonth(), 1);
		renderCalendar();
		renderSlots();
	});

	/* ---------- Step navigation ---------- */
	var order = ['date', 'time', 'form', 'done'];
	function go(name) {
		var from = state.view;
		if (from === name) { return; }
		var forward = order.indexOf(name) > order.indexOf(from);
		Object.keys(views).forEach(function (k) {
			var v = views[k];
			if (k === name) {
				v.classList.remove('is-left');
				v.classList.add('is-active');
				v.scrollTop = 0;
			} else {
				v.classList.remove('is-active');
				v.classList.toggle('is-left', forward && order.indexOf(k) < order.indexOf(name));
			}
		});
		state.view = name;
		root.setAttribute('data-step', name);
		root.classList.toggle('is-done', name === 'done');
		var idx = Math.min(order.indexOf(name), 2);
		stepItems.forEach(function (li, i) {
			li.classList.toggle('is-current', name !== 'done' && i === idx);
			li.classList.toggle('is-done', name === 'done' || i < idx);
		});
		if (stepBar) { stepBar.style.transform = 'scaleX(' + (name === 'done' ? 1 : [0.12, 0.5, 0.82][idx]) + ')'; }
		var target = views[name].querySelector('.ih-bk__slot, .ih-bk__day.is-selected, .ih-bk__day.is-today:not(:disabled), input, button');
		if (target && name !== 'done') { setTimeout(function () { target.focus({ preventScroll: true }); }, reduced ? 0 : 380); }
	}
	root.addEventListener('click', function (e) {
		var back = e.target.closest('[data-bk-to]');
		if (back) { go(back.getAttribute('data-bk-to')); }
	});

	/* ---------- Time zone picker (compact dropdown from the link in the left panel) ---------- */
	var zoneNodes = [];
	function allZones() {
		var list = [];
		try { list = Intl.supportedValuesOf('timeZone').slice(); } catch (e) { list = []; }
		if (!list.length) { list = POPULAR.concat(['Europe/Madrid', 'Europe/Paris', 'Europe/Athens', 'Europe/Moscow', 'Africa/Cairo', 'Africa/Johannesburg', 'Asia/Karachi', 'Asia/Bangkok', 'Asia/Shanghai', 'Asia/Seoul', 'Pacific/Auckland', 'America/Toronto', 'America/Mexico_City', 'America/Denver', 'America/Anchorage', 'Pacific/Honolulu']); }
		['UTC', HOME_TZ, deviceTz].forEach(function (z) { if (z && list.indexOf(z) < 0 && validZone(z)) { list.push(z); } });
		list = list.filter(validZone).sort();
		// most used zones first, then everything else alphabetically
		var first = POPULAR.filter(function (z) { return list.indexOf(z) > -1; });
		if (deviceTz && validZone(deviceTz) && first.indexOf(deviceTz) < 0) { first.unshift(deviceTz); }
		return first.concat(list.filter(function (z) { return first.indexOf(z) < 0; }));
	}
	function buildZoneList() {
		if (zoneNodes.length) { return; }
		var now = Date.now();
		var frag = document.createDocumentFragment();
		allZones().forEach(function (z) {
			var li = document.createElement('li');
			var parts = z.split('/');
			var city = zoneTitle(parts[parts.length - 1]);
			var region = parts.length > 1 ? zoneTitle(parts.slice(0, -1).join(' / ')) : '';
			var off = offsetLabel(now, z);
			var b = document.createElement('button');
			b.type = 'button';
			b.className = 'ih-bk__tzitem';
			b.setAttribute('data-tz', z);
			b.setAttribute('role', 'option');
			b.innerHTML = '<span><b></b><i></i></span><small></small>';
			b.querySelector('b').textContent = city;
			b.querySelector('i').textContent = (region ? region + ' · ' : '') + off;
			li.appendChild(b);
			li._search = (city + ' ' + region + ' ' + z + ' ' + off).toLowerCase();
			li._small = b.querySelector('small');
			li._zone = z;
			frag.appendChild(li);
			zoneNodes.push(li);
		});
		tzList.appendChild(frag);
	}
	function paintZoneTimes() {
		var now = Date.now();
		zoneNodes.forEach(function (li) { li._small.textContent = timeOf(now, li._zone); });
	}
	function markCurrentZone() {
		tzList.querySelectorAll('.ih-bk__tzitem').forEach(function (n) {
			var on = n.getAttribute('data-tz') === tz;
			n.classList.toggle('is-current', on);
			n.setAttribute('aria-selected', on ? 'true' : 'false');
		});
	}
	function filterZones() {
		var q = tzSearch.value.trim().toLowerCase().replace(/_/g, ' ');
		var shown = 0;
		zoneNodes.forEach(function (li) {
			var hit = !q || li._search.indexOf(q) > -1;
			li.hidden = !hit;
			if (hit) { shown++; }
		});
		tzEmpty.hidden = !!shown;
	}
	function placeTzPanel() {
		var dlg = dialog.getBoundingClientRect();
		var btn = tzOpenBtn.getBoundingClientRect();
		var top = btn.bottom - dlg.top + 10;
		tzPanel.style.top = top + 'px';
		tzPanel.style.maxHeight = Math.max(240, Math.min(430, dlg.height - top - 14)) + 'px';
	}
	function openTzPanel() {
		buildZoneList();
		tzSearch.value = '';
		filterZones();
		markCurrentZone();
		paintZoneTimes();
		tzDetectBtn.querySelector('[data-bk-tz-detected]').textContent = deviceTz ? '(' + zoneTitle(deviceTz.split('/').pop()) + ')' : '';
		tzDetectBtn.hidden = !deviceTz || !validZone(deviceTz) || deviceTz === tz;
		tzPanel.hidden = false;
		placeTzPanel();
		tzOpenBtn.setAttribute('aria-expanded', 'true');
		var cur = tzList.querySelector('.is-current');
		setTimeout(function () {
			tzSearch.focus({ preventScroll: true });
			if (cur) { tzList.scrollTop = Math.max(0, cur.parentNode.offsetTop - 80); }
		}, reduced ? 0 : 120);
	}
	function closeTzPanel(refocus) {
		tzPanel.hidden = true;
		tzOpenBtn.setAttribute('aria-expanded', 'false');
		if (refocus) { tzOpenBtn.focus({ preventScroll: true }); }
	}
	function updateClock() {
		var el = root.querySelector('[data-bk-tz-now]');
		if (el) { el.textContent = '(' + timeOf(Date.now(), tz) + ')'; }
		if (!tzPanel.hidden) { paintZoneTimes(); }
	}
	function paintZone() {
		root.querySelector('[data-bk-tz-name]').textContent = zoneTitle(tz);
		updateClock();
	}
	function refreshTimes() {
		paintZone();
		if (state.view === 'time' && state.date) { renderSlots(); }
		else if (state.view === 'form' && state.ms) { fillSummary(); }
	}
	function setZone(zone) {
		if (!validZone(zone)) { return; }
		var changed = zone !== tz;
		var keepMs = state.ms;
		tz = zone;
		paintZone();
		if (changed) {
			metaTz.classList.remove('is-changed');
			void metaTz.offsetWidth;
			metaTz.classList.add('is-changed');
			today = nowDateIn(tz);
			// keep the picked moment; otherwise keep the picked day when it is still bookable
			if (keepMs) { state.date = dateIn(keepMs, tz); }
			else if (state.date && state.date < today) { state.date = null; }
			var base = state.date || today;
			viewMonth = new Date(base.getFullYear(), base.getMonth(), 1);
			renderCalendar();
			if (state.view === 'time') {
				if (state.date) { renderSlots(); } else { go('date'); }
			} else if (state.view === 'form' && keepMs) {
				fillSummary();
			}
		}
		closeTzPanel(true);
		markCurrentZone();
	}
	tzOpenBtn.addEventListener('click', function (e) { e.stopPropagation(); if (tzPanel.hidden) { openTzPanel(); } else { closeTzPanel(true); } });
	tzSearch.addEventListener('input', filterZones);
	tzDetectBtn.addEventListener('click', function () { if (deviceTz) { setZone(deviceTz); } });
	h24Input.addEventListener('change', function () { h24 = h24Input.checked; refreshTimes(); paintZoneTimes(); });
	tzList.addEventListener('click', function (e) {
		var it = e.target.closest('[data-tz]');
		if (it) { setZone(it.getAttribute('data-tz')); }
	});
	// a click anywhere else inside the popup closes the dropdown
	dialog.addEventListener('click', function (e) {
		if (!tzPanel.hidden && !tzPanel.contains(e.target) && !tzOpenBtn.contains(e.target)) { closeTzPanel(false); }
	});

	/* ---------- Form (visual validation + fake confirmation) ---------- */
	form.addEventListener('change', function (e) {
		if (e.target.tagName === 'SELECT') { e.target.parentNode.classList.toggle('has-value', !!e.target.value); }
	});
	form.addEventListener('input', function (e) {
		var f = e.target.closest('.ih-bk__field');
		if (f) { f.classList.remove('is-invalid'); }
	});
	form.addEventListener('submit', function (e) {
		e.preventDefault();
		var ok = true;
		var firstBad = null;
		form.querySelectorAll('[required]').forEach(function (el) {
			var good = el.type === 'checkbox' ? el.checked : (el.type === 'email' ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim()) : el.value.trim().length > 1);
			var wrap = el.closest('.ih-bk__field') || el.closest('.ih-bk__privacy');
			if (wrap) {
				wrap.classList.remove('is-invalid');
				if (!good) { void wrap.offsetWidth; wrap.classList.add('is-invalid'); }
			}
			if (!good) { ok = false; if (!firstBad) { firstBad = el; } }
		});
		errorEl.hidden = ok;
		if (!ok) { if (firstBad) { firstBad.focus({ preventScroll: false }); } return; }

		var submit = form.querySelector('.ih-bk__submit');
		submit.classList.add('is-sending');
		setTimeout(function () {
			submit.classList.remove('is-sending');
			var name = form.elements.nome.value.trim();
			var note = romeNote(state.ms);
			root.querySelector('[data-bk-done-topic]').textContent = root.getAttribute('data-topic');
			root.querySelector('[data-bk-done-date]').textContent = longDate(state.date);
			root.querySelector('[data-bk-done-time]').innerHTML = rangeLabel(state.ms) + ' · ' + zoneTitle(tz) + (note ? '<span class="ih-bk__rome">' + note + '</span>' : '');
			root.querySelector('[data-bk-done-who]').textContent = name + ' · ' + form.elements.email.value.trim();
			go('done');
			confetti();
		}, reduced ? 0 : 900);
	});

	function confetti() {
		if (reduced) { return; }
		var box = root.querySelector('[data-bk-burst]');
		var colors = ['#8eb826', '#b4d95a', '#ffffff', '#69ceeb', '#d9e8a8'];
		var html = '';
		for (var i = 0; i < 34; i++) {
			var a = Math.random() * Math.PI * 2;
			var dist = 110 + Math.random() * 170;
			html += '<i style="--x:' + Math.round(Math.cos(a) * dist) + 'px;--y:' + Math.round(Math.sin(a) * dist - 40) + 'px;--r:' + Math.round(Math.random() * 720 - 360) + 'deg;--d:' + (0.05 + Math.random() * 0.25).toFixed(2) + 's;--c:' + colors[i % colors.length] + '"></i>';
		}
		box.innerHTML = html;
	}

	/* ---------- Open / close ---------- */
	function reset() {
		tz = (deviceTz && validZone(deviceTz)) ? deviceTz : HOME_TZ; // visitor's own zone every time the popup opens
		h24 = true;
		h24Input.checked = true;
		today = nowDateIn(tz);
		state.date = null;
		state.ms = null;
		viewMonth = new Date(today.getFullYear(), today.getMonth(), 1);
		form.reset();
		form.querySelectorAll('.is-invalid, .has-value').forEach(function (n) { n.classList.remove('is-invalid', 'has-value'); });
		errorEl.hidden = true;
		root.querySelector('[data-bk-burst]').innerHTML = '';
		Object.keys(views).forEach(function (k) { views[k].classList.remove('is-active', 'is-left'); });
		views.date.classList.add('is-active');
		state.view = 'date';
		root.setAttribute('data-step', 'date');
		root.classList.remove('is-done');
		closeTzPanel(false);
		stepItems.forEach(function (li, i) { li.classList.toggle('is-current', i === 0); li.classList.remove('is-done'); });
		if (stepBar) { stepBar.style.transform = 'scaleX(0.12)'; }
		paintZone();
		markCurrentZone();
		renderCalendar();
	}

	function open() {
		lastFocus = document.activeElement;
		reset();
		root.classList.add('is-open');
		root.setAttribute('aria-hidden', 'false');
		document.body.classList.add('ih-bk-open');
		requestAnimationFrame(function () {
			requestAnimationFrame(function () { root.classList.add('is-visible'); });
		});
		clearInterval(clockTimer);
		clockTimer = setInterval(updateClock, 15000);
		setTimeout(function () {
			var t = daysEl.querySelector('.is-today:not(:disabled)') || daysEl.querySelector('.ih-bk__day[data-d]:not(:disabled)');
			if (t) { t.focus({ preventScroll: true }); }
		}, reduced ? 0 : 500);
	}
	function close() {
		root.classList.remove('is-visible');
		root.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('ih-bk-open');
		clearInterval(clockTimer);
		setTimeout(function () { root.classList.remove('is-open'); }, reduced ? 0 : 450);
		if (lastFocus && typeof lastFocus.focus === 'function') { lastFocus.focus({ preventScroll: true }); }
	}

	document.querySelectorAll('[data-booking-open]').forEach(function (el) {
		el.addEventListener('click', function (e) { e.preventDefault(); open(); });
	});
	root.querySelectorAll('[data-bk-close]').forEach(function (el) { el.addEventListener('click', close); });
	document.addEventListener('keydown', function (e) {
		if (!root.classList.contains('is-open')) { return; }
		if (e.key === 'Escape') {
			if (!tzPanel.hidden) { closeTzPanel(true); } else { close(); }
			return;
		}
		if (e.key === 'Tab') { // keep focus inside the dialog
			var scope = tzPanel.hidden ? dialog : tzPanel;
			var f = [].slice.call(scope.querySelectorAll('button:not(:disabled), input:not([tabindex="-1"]), select, textarea, a[href]')).filter(function (n) { return n.offsetParent !== null; });
			if (!f.length) { return; }
			var first = f[0];
			var last = f[f.length - 1];
			if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
			else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
		}
	});

	/* cursor-following light on the dialog */
	dialog.addEventListener('pointermove', function (e) {
		if (reduced) { return; }
		var b = dialog.getBoundingClientRect();
		dialog.style.setProperty('--mx', (e.clientX - b.left) + 'px');
		dialog.style.setProperty('--my', (e.clientY - b.top) + 'px');
	});
})();
