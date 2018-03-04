(function($, pointers) {

	var tutorialStep = 'mps-tutorial-step';

	$(function() {
		pointers.setPointer = function() {

			var pointerData = pointers.pointersData[this.stepNumber];

			if (!pointerData) {
				return;
			}

			var $target = $(pointerData.target);
			if (!$target.length) {
				return;
			}

			pointers.current = $target.pointer({
				pointerClass: pointerData.class,
				content: pointerData.title + pointerData.content,
				position: {
					edge: pointerData.edge,
					align: pointerData.align
				},
				close: function() {
					if (pointers.hasNextStep) {
						pointers.stepNumber += 1;
						sessionStorage.setItem(tutorialStep, pointers.stepNumber);

						if (pointerData.nextURL && window.location.href !== pointerData.nextURL) {
							window.location = pointerData.nextURL;
						}

						if (pointerData.nextURL == '#' || pointerData.nextURL.split('#').shift() == window.location.href.split('#').shift()) {
							pointers.setPointer();
						} else {
							pointers.changePage();
						}

					} else {
						Membership.ajax({
							route: 'promo.endTutorial'
						}, {method: 'POST'});
						sessionStorage.removeItem(tutorialStep);
					}
				}
			});

			pointers.openPointer();

			var action = this.actions[pointerData.id];

			if (typeof action == 'function') {
				action.call(this);
			}
		};

		pointers.changePage = function() {
			pointers.current.pointer({
				content: '<h3>' + pointers.change + '</h3>' + '<p style="text-align: center;margin-top: 1.5em"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></p>',

				buttons: function () {
					return;
				}
			});

			pointers.openPointer();
			pointers.current.pointer('widget').find('.wp-pointer-buttons').remove();
		};

		pointers.openPointer = function() {
			var $pointer = pointers.current;

			if (! typeof $pointer === 'object' ) {
				return;
			}

			$('html, body').animate({
				scrollTop: $pointer.offset().top - 200
			}, 300, function() {
				var $widget = $pointer.pointer('widget');
				pointers.setNext($widget);
				$pointer.pointer('open');
				$widget.draggable({cursor: 'move'});
			});
		};

		pointers.setNext = function($widget) {

			var self = this;
			this.hasNextStep = false;

			if (typeof $widget === 'object') {

				var $buttons = $widget.find('.wp-pointer-buttons');
				var $closeButton = $buttons.find('a').first().removeClass('close');

				$closeButton.html(this.close).addClass('button button-secondary stop-tutorial');

				if (this.stepNumber < this.pointersData.length - 1) {
					this.hasNextStep = true;
					if (this.pointersData[this.stepNumber].nextURL) {
						var $nextButton = $closeButton.clone(true, true);
						$nextButton.addClass('next button button-primary');
						$nextButton.html(this.next).appendTo($buttons);
					}
				}

				$closeButton.addClass('mbsCloseTutorial');
				$closeButton.on('mousedown', function(event) {
					self.hasNextStep = false;
				});
			}
		};

		pointers.stepNumber = Number(sessionStorage.getItem(tutorialStep));

		pointers.actions = {
			'step-0': function() {
				$('#toplevel_page_supsystic-membership').on('click', 'a', function(event) {
					event.preventDefault();
					pointers.current.pointer('close');
				});
			},
			'step-1': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="security"]').trigger('click');
				})
			},
			'step-3': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="fields"]').trigger('click');
				})
			},
			'step-10': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="social-login"]').trigger('click');
				})
			},
			'step-11': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="social-network-integration"]').trigger('click');
				})
			},
			'step-12': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="subscriptions"]').trigger('click');
				})
			},
			'step-13': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="woocommerce"]').trigger('click');
				})
			},
			'step-14': function() {
				pointers.current.pointer('widget').one('click', 'a.next', function() {
					$('.sc-tabs [data-target="woocommerce"]').trigger('click');
				})
			},
		};

		pointers.setPointer();
	});


})(jQuery, MembershipPromoPointers, Membership);
