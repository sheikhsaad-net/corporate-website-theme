/**
 * Cookie consent: banner + preferences.
 *
 * Stores the choice in localStorage and a first-party cookie
 * (immensive_consent, 6 months). Other scripts (GTM, Clarity, Tawk.to,
 * YouTube embeds...) should only load once the matching category is true:
 *
 *   if (window.immensiveConsent && window.immensiveConsent.get().measurement) { ... }
 *   document.addEventListener('immensive:consent', function (e) { e.detail.measurement ... });
 *
 * Any element with [data-cookie-settings] reopens the banner.
 */
(function () {
	'use strict';

	var KEY = 'immensive_consent';
	var CATS = ['functionality', 'experience', 'measurement', 'marketing'];
	var banner = document.getElementById('ck-bar');
	if (!banner) { return; }

	var prefs = document.getElementById('ck-prefs');
	var btnCustomize = banner.querySelector('[data-ck="customize"]');
	var btnAccept = banner.querySelector('[data-ck="accept"]');
	var btnSave = banner.querySelector('[data-ck="save"]');
	var btnReject = banner.querySelector('[data-ck="reject"]');
	var boxes = banner.querySelectorAll('[data-ck-cat]');

	function read() {
		var raw = null;
		try { raw = window.localStorage.getItem(KEY); } catch (e) { /* storage blocked */ }
		if (!raw) {
			var m = document.cookie.match(new RegExp('(?:^|; )' + KEY + '=([^;]*)'));
			raw = m ? decodeURIComponent(m[1]) : null;
		}
		try { return raw ? JSON.parse(raw) : null; } catch (e) { return null; }
	}

	function write(choice) {
		var json = JSON.stringify(choice);
		try { window.localStorage.setItem(KEY, json); } catch (e) { /* storage blocked */ }
		document.cookie = KEY + '=' + encodeURIComponent(json) + '; max-age=' + (60 * 60 * 24 * 182) + '; path=/; SameSite=Lax';
	}

	function state(all) {
		var s = { necessary: true, ts: Date.now() };
		CATS.forEach(function (c) { s[c] = !!all; });
		return s;
	}

	function save(choice) {
		write(choice);
		banner.hidden = true;
		document.dispatchEvent(new CustomEvent('immensive:consent', { detail: choice }));
	}

	function showPrefs(open) {
		prefs.hidden = !open;
		btnSave.hidden = !open;
		btnAccept.hidden = open;
		btnReject.hidden = open;
		btnCustomize.hidden = open;
		btnCustomize.setAttribute('aria-expanded', open ? 'true' : 'false');
	}

	function open() {
		var cur = read();
		boxes.forEach(function (b) { b.checked = !!(cur && cur[b.getAttribute('data-ck-cat')]); });
		showPrefs(false);
		banner.hidden = false;
	}

	window.immensiveConsent = {
		get: function () { return read() || state(false); },
		open: open
	};

	btnAccept.addEventListener('click', function () { save(state(true)); });
	btnReject.addEventListener('click', function () { save(state(false)); });
	btnCustomize.addEventListener('click', function () { showPrefs(true); });
	btnSave.addEventListener('click', function () {
		var s = state(false);
		boxes.forEach(function (b) { s[b.getAttribute('data-ck-cat')] = b.checked; });
		save(s);
	});

	document.addEventListener('click', function (e) {
		var t = e.target.closest ? e.target.closest('[data-cookie-settings]') : null;
		if (t) { e.preventDefault(); open(); }
	});

	if (!read()) { open(); }
})();
