function doTestLoad(service, method) {
	jQuery.getScript(service, function() {
		jQuery(function() {
			if (window[method]) {
				window[method]();
			}
		});
	});
}