var url = "https://app-" + MarketoProForm.marketoId + ".marketo.com";

jQuery.each(MarketoProForm.forms, function (i, v) {
	MktoForms2.loadForm(url, MarketoProForm.munchkinId, MarketoProForm.forms[i].formId, function (form) {

		/*
		Form is displayed inline without any further code
		To show a lightbox, the form must be hidden until a trigger is clicked
		at which point we show the form and output the lightbox
		*/
		if (MarketoProForm.forms[i].lightbox != false) {
			form.getFormElem().hide();
			jQuery("#" + MarketoProForm.forms[i].htmlId).click(function () {
				form.getFormElem().show();
				MktoForms2.lightbox(form).show();
				return false; // Prevent navigation
			})
		}

		// Set default values
		form.vals(MarketoProForm.defaults);

		// Override success page?
		if (MarketoProForm.forms[i].success != false) {
			form.onSuccess(function(values, followUpUrl) {
				location.href = MarketoProForm.forms[i].success;
				return false;
			});
		}

		// Prevent fields from overflowing sidebars
		var parent = jQuery(form.getFormElem()).parent();
		if (parent.hasClass("widget")) {
			parent.find(".mktoHasWidth").removeAttr("style");
			parent.find(".mktoFormCol, .mktoFieldWrap").css("width", "100%");
		}

	});
});