!function ($, undefined) {

	"use strict";

	// variables
	var $doc = $(document);

	$(function () {

		// confirmation class
		$doc.on('click', '.btn-danger:not(.no-prompt)', function (e) {
			return confirm('Are you sure you want to continue?');
		})

	});

}(jQuery);