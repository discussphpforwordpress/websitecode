jQuery(function($){
	
	// Init form validator
	function dtInitContactForm () {
		var $form = $( 'form.contact-form.dt-form' );

		$form.validationEngine( {
			binded: false,
			promptPosition: 'inline',
			scroll: false,
			autoHidePrompt: false,
			maxErrorsPerField: 1,
			//showOneMessage: true,
			'custom_error_messages' : {
		        'required': {
		            'message': dtLocal.contactMessages.required
		        },
		     },
		     fadeDuration: 500,
		    addPromptClass : "run-animation",
		    onAjaxFormComplete:function( ) {
			},
			addSuccessCssClassToField: "field-success",
			onBeforeAjaxFormValidation: function( form, status ) {
				var $form = $(form);
				$form.find(".formError").removeClass("first");
				$form.find('input').removeClass('error-field');
				$form.find('textarea').removeClass('error-field');
			},
			onFailure: function( form, status ) {
				var $form = $(form);
				if($form.find(".formError .close-message").length <= 0) {
					$form.find(".formError").append('<span class="close-message"></span>');
				}
			},
			onValidationComplete: function( form, status ) {
				var $form = $(form);
				
				$form.find(".formError").removeClass("first");
				$form.find('input').removeClass('error-field');
				$form.find('textarea').removeClass('error-field');
				var j = -1;
				$form.find(".formError").each(function(){
					j++
					$(this).eq(j).addClass("first");
					$(this).prev().addClass('error-field');
				});
				$('.formError .close-message').remove();
				if($form.find(".formError .close-message").length <= 0) {
					$form.find(".formError").append('<span class="close-message"></span>');
				}
				// If validation success
				if ( status ) {

					var data = {
						action : 'dt_send_mail',
						widget_id: $('input[name="widget_id"]', $form).val(),
						send_message: $('input[name="send_message"]', $form).val(),
						fields : {}
					};

					$form.find('input[type="text"], textarea').each(function(){
						var $this = $(this);

						data.fields[ $this.attr('name') ] = $this.val();
					});

					$.post(
						dtLocal.ajaxurl,
						data,
						function (response) {
							var _caller = $(form),
								msgType = response.success ? 'pass' : 'error';
							
							// Show message
							$('input[type="hidden"]', _caller).last().validationEngine( 'showPrompt', response.errors, msgType, 'inline' );
							
							// set promptPosition again
							_caller.validationEngine( 'showPrompt', '', '', 'topRight' );

							// Clear fields if success
							if ( response.success ) {
								_caller.find('input[type="text"], textarea').val("");

								if($form.find(".formError .close-message").length <= 0) {
									$form.find(".formError").append('<span class="close-message"></span>');
								}
							}
						}
					);
				}

			} // onValidationComplete
		} );

		$form.find( '.dt-btn.dt-btn-submit' ).on( 'click', function( e ) {
			e.preventDefault();

			var $form = $(this).parents( 'form' );
			$form.submit();
		} );

		$form.find( '.clear-form' ).on( 'click' ,function( e ) {
			e.preventDefault();

			var $form = $(this).parents( 'form' );

			if ( $form.length > 0 ) {
				$form.find( 'input[type="text"], textarea' ).val( "" );
				$form.validationEngine( 'hide' );
			}
		} );
	}

	dtInitContactForm();
});