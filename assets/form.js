var url = "https://app-" + MarketoPro.marketoId + ".marketo.com";

jQuery.each(MarketoPro.forms, function (i, v) {
	MktoForms2.loadForm(url, MarketoPro.munchkinId, MarketoPro.forms[i].formId, function (form) {

		/*
		Form is displayed inline without any further code
		To show a lightbox, the form must be hidden until a trigger is clicked
		at which point we show the form and output the lightbox
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