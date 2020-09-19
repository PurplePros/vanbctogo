function scrollToCities() {
// 	console.log("scrolled")
    document.getElementsByClassName('card')[1].scrollIntoView({ behavior: 'smooth', block: 'center' })
}

var submitted = false; 

$(document).on("click", ".btn-danger", function () {
        var bootstrapValidator = $('#vegetarianCheck').data('bootstrapValidator');
        bootstrapValidator.enableFieldValidators(false);
});

(function() {
	'use strict';
	window.addEventListener('load', function() {
		var forms = document.getElementsByClassName('needs-validation');
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();
