(function() {

	/**
	 * Code from: https://gist.github.com/roNn23/a86f31ecaf0c6e0a7d65
	 */
	
	var laravel = {
		initialize : function() {
			this.registerEvents();
		},

		registerEvents : function() {
			$('body').on('click', 'a[data-method]', this.handleMethod);
		},

		handleMethod : function(e) {
			var link = $(this);
			var httpMethod = link.data('method').toUpperCase();
			var form;

			// If the data-method attribute is not PUT or DELETE,
			// then we don't know what to do. Just ignore.
			if ($.inArray(httpMethod, [ 'PUT', 'DELETE' ]) === -1) {
				return;
			}

			// Allow user to optionally provide data-confirm="Are you sure?"
			if (link.data('confirm')) {
				if (!laravel.verifyConfirm(link)) {
					return false;
				}
			}

			form = laravel.createForm(link);
			form.submit();

			e.preventDefault();
		},

		verifyConfirm : function(link) {
			return confirm(link.data('confirm'));
		},

		createForm : function(link) {
			var form = $('<form>', {
				'method' : 'POST',
				'action' : link.attr('href')
			});

			var token = $('<input>', {
				'name' : '_token',
				'type' : 'hidden',
				'value' : window.csrfToken
			});

			var hiddenInput = $('<input>', {
				'name' : '_method',
				'type' : 'hidden',
				'value' : link.data('method')
			});

			return form.append(token, hiddenInput).appendTo('body');
		}
	};

	laravel.initialize();

})();