function doTestLoad(service, method) {
	jQuery.require(service);
	jQuery(function() {
		window[method]();
	});
}