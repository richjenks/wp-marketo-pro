var url = "https://app-" + MarketoPro.marketoId + ".marketo.com";

jQuery.each(MarketoPro.forms, function (i, v) {
	MktoForms2.loadForm(url, MarketoPro.munchkinId, MarketoPro.forms[i].formId, function (form) {

		/*
		Form is displayed inline without any further code
		If we're outputting a triggered lightbox, `hide()` sets display to none
		then `show()` sets display to block after clicking on the targetted
		element and `lightbox()` turns the form into a lightbox rather than an
		inline form.
		*/
		if (MarketoPro.forms[i].lightbox == true) {
			form.getFormElem().hide();
			jQuery("#" + MarketoPro.forms[i].htmlId).click(function () {
				form.getFormElem().show();
				MktoForms2.lightbox(form).show();
				return false; // Prevent navigation
			})
		}

	});
});