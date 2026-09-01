/**
 * Frontend click-to-copy behavior for figcaptions flagged with
 * has-caption-copy (see inc/copy-caption.php). Plain vanilla JS, no build
 * step — delegated on document so it works for captions added dynamically
 * (e.g. sliders, AJAX-loaded content).
 */
document.addEventListener("click", function (e) {
	var caption = e.target.closest("figcaption.has-caption-copy");
	if (!caption || !navigator.clipboard) {
		return;
	}

	navigator.clipboard.writeText(caption.textContent.trim()).then(function () {
		caption.classList.add("is-copied");
		window.clearTimeout(caption._copyTimeout);
		caption._copyTimeout = window.setTimeout(function () {
			caption.classList.remove("is-copied");
		}, 1500);
	});
});
