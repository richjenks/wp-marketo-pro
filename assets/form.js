<script>
	MktoForms2.loadForm("https://app-" + MarketoPro.marketoId + ".marketo.com", MarketoPro.munchkinId, MarketoPro.formId, function (form){
		if (MarketoPro.lightbox == 'true') {
			// Must manually hide and show on click or form will display instantly
			form.getFormElem().hide();
			document.getElementById(MarketoPro.htmlId).addEventListener("click", function () {
				form.getFormElem().show();
				MktoForms2.lightbox(form).show();
			});
		}
	});
</script>