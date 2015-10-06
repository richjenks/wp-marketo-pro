console.log(MarketoPro.formId);
console.log(MarketoPro.htmlId);
console.log(MarketoPro.lightbox);
console.log(MarketoPro.marketoId);
console.log(MarketoPro.munchkinId);

MktoForms2.loadForm("https://app-" + MarketoPro.marketoId + ".marketo.com", MarketoPro.munchkinId, MarketoPro.formId, function (form) {

	/*
	Form is displayed inline without any further code
	If we're outputting a triggered lightbox, `hide()` sets display to none
	then `show()` sets display to block and `lightbox()` turns the form into
	a lightbox rather than an inline form.
	*/
	if (MarketoPro.lightbox == 'true') {
		form.getFormElem().hide();
		document.getElementById(MarketoPro.htmlId).addEventListener("click", function () {
			form.getFormElem().show();
			MktoForms2.lightbox(form).show();
		});
	}

});