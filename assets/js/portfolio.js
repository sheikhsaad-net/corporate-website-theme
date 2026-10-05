(function () {
	'use strict';

	var header = document.getElementById('ih-header');
	var burger = document.getElementById('ih-burger');
	var nav = document.getElementById('ih-nav');

	if (header) {
		var updateHeader = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 10);
		};
		window.addEventListener('scroll', updateHeader, { passive: true });
		updateHeader();
	}

	if (burger && nav) {
		burger.addEventListener('click', function () {
			var isOpen = nav.classList.toggle('is-open');
			burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}

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
			caret.addEventListener('click', function (event) {
				event.preventDefault();
				event.stopPropagation();
				toggleSubmenu(caret);
			});
			caret.addEventListener('keydown', function (event) {
				if (event.key === 'Enter' || event.key === ' ') {
					event.preventDefault();
					event.stopPropagation();
					toggleSubmenu(caret);
				}
			});
		});
	}

	var pfRoot = document.getElementById('ih-portfolio');
	if (!pfRoot) {
		return;
	}

	var pfPanels = Array.prototype.slice.call(pfRoot.querySelectorAll('.ih-pfp'));
	var pfFilters = Array.prototype.slice.call(pfRoot.querySelectorAll('.ih-pf__filter'));
	var pfReset = pfRoot.querySelector('.ih-pf__reset');
	var pfNoResults = pfRoot.querySelector('.ih-pf__noresults');

	var tintCard = function (card) {
		var img = card.querySelector('.ih-pfc__media img');
		if (!img) {
			return;
		}

		var measure = function () {
			if (!img.naturalWidth) {
				return;
			}
			try {
				var canvas = document.createElement('canvas');
				canvas.width = 24;
				canvas.height = 8;
				var context = canvas.getContext('2d');
				var sampleHeight = Math.max(1, Math.round(img.naturalHeight * 0.22));
				context.drawImage(img, 0, img.naturalHeight - sampleHeight, img.naturalWidth, sampleHeight, 0, 0, 24, 8);
				var pixels = context.getImageData(0, 0, 24, 8).data;
				var luminance = 0;
				for (var i = 0; i < pixels.length; i += 4) {
					luminance += 0.2126 * pixels[i] + 0.7152 * pixels[i + 1] + 0.0722 * pixels[i + 2];
				}
				card.classList.toggle('is-light', luminance / (pixels.length / 4) > 140);
			} catch (error) {
				// Keep the default white text if the image cannot be sampled.
			}
		};

		if (img.complete) {
			measure();
		} else {
			img.addEventListener('load', measure, { once: true });
		}
	};

	Array.prototype.forEach.call(pfRoot.querySelectorAll('.ih-pfc'), tintCard);

	var activeFilters = function (group) {
		return pfFilters.filter(function (button) {
			return button.getAttribute('aria-pressed') === 'true' &&
				button.closest('.ih-pf__filters').getAttribute('data-filter-group') === group;
		}).map(function (button) {
			return button.getAttribute('data-slug');
		});
	};

	var applyFilters = function () {
		var sectors = activeFilters('settore');
		var technologies = activeFilters('tecnologia');
		var anyVisible = false;

		pfPanels.forEach(function (panel) {
			var cards = Array.prototype.slice.call(panel.querySelectorAll('.ih-pfc'));
			var shown = 0;
			cards.forEach(function (card) {
				var cardSectors = (card.getAttribute('data-settori') || '').split(' ');
				var cardTechnologies = (card.getAttribute('data-tecnologie') || '').split(' ');
				var sectorMatches = !sectors.length || sectors.some(function (slug) { return cardSectors.indexOf(slug) !== -1; });
				var technologyMatches = !technologies.length || technologies.some(function (slug) { return cardTechnologies.indexOf(slug) !== -1; });
				var visible = sectorMatches && technologyMatches;
				card.classList.toggle('is-filtered', !visible);
				if (visible) {
					shown++;
				}
			});
			var panelVisible = shown > 0;
			panel.classList.toggle('is-filtered', !panelVisible);
			anyVisible = anyVisible || panelVisible;
		});

		if (pfNoResults) {
			pfNoResults.hidden = anyVisible;
		}
		if (pfReset) {
			pfReset.hidden = !(sectors.length || technologies.length);
		}
	};

	pfFilters.forEach(function (button) {
		button.addEventListener('click', function () {
			button.setAttribute('aria-pressed', button.getAttribute('aria-pressed') === 'true' ? 'false' : 'true');
			applyFilters();
		});
	});

	if (pfReset) {
		pfReset.addEventListener('click', function () {
			pfFilters.forEach(function (button) {
				button.setAttribute('aria-pressed', 'false');
			});
			applyFilters();
		});
	}

	var params = new URLSearchParams(window.location.search);
	var linkedFilter = false;
	['settore', 'tecnologia'].forEach(function (group) {
		var slug = params.get(group);
		if (!slug) {
			return;
		}
		var button = pfFilters.filter(function (candidate) {
			return candidate.getAttribute('data-slug') === slug &&
				candidate.closest('.ih-pf__filters').getAttribute('data-filter-group') === group;
		})[0];
		if (button) {
			button.setAttribute('aria-pressed', 'true');
			linkedFilter = true;
		}
	});
	if (linkedFilter) {
		applyFilters();
		pfRoot.scrollIntoView({ block: 'start' });
	}
})();
