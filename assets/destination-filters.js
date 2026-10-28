(function () {
	'use strict';
	document.addEventListener('click', function (event) {
		var button = event.target.closest('.emea-destination-filter');
		if (!button) {
			return;
		}
		var directory = button.closest('.emea-destination-directory');
		if (!directory) {
			return;
		}
		var selected = button.getAttribute('data-filter');
		directory.querySelectorAll('.emea-destination-filter').forEach(function (filter) {
			filter.setAttribute('aria-pressed', filter === button ? 'true' : 'false');
		});
		directory.querySelectorAll('.emea-destination-directory__item').forEach(function (item) {
			item.hidden = selected !== 'all' && item.getAttribute('data-region') !== selected;
		});
	});
}());
