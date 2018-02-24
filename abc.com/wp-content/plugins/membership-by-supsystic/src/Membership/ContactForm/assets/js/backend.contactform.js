(function($, Membership) {
	function ContactForm() {

	}
	ContactForm.prototype.init = (function() {
		this.$createPageButtonContainer = $('.mp-option-button.mp-opt-contact-form-btn');
		this.$createPageSelector = $('.wp-pages-list[name="pages[contact_form]"]');
		this.$presetSelector = $('#contactFormPresetSel');
		this.$createPageButton = $('.sc-button.create-page-button[data-page-slug="contact_form"]')

		this.initContactFormSelectorsRow();
	});

	ContactForm.prototype.setContactFormSelectorWidth = (function() {
		var width = $('.wp-pages-list[name="pages[activity]"]').css('width');
		if(!isNaN(parseFloat(width))) {
			$('#contactFormPresetSel').css('width', width);
		}
	});

	ContactForm.prototype.initContactFormSelectorsRow = (function() {
		var self = this;
		//
		self.setContactFormSelectorWidth();
		$( window ).resize(function() {
			self.setContactFormSelectorWidth();
		});
		//
		this.$presetSelector.on('change', function() {
			self.checkElementForCreatePageButtonShow();
		});
		this.$createPageSelector.on('change', function() {
			self.checkElementForCreatePageButtonShow();
		}).trigger('change');

		this.$createPageButton.on('click', function() {
			self.onCreateButtonClick();
		})
	});

	ContactForm.prototype.checkElementForCreatePageButtonShow = (function() {
		if(this.$createPageSelector.val() === '__none') {
			this.$createPageButtonContainer.fadeIn();
		} else {
			this.$createPageButtonContainer.fadeOut();
		}
		if(this.$presetSelector.val() != "") {
			this.$createPageButton.attr('disabled', false);
		} else {
			this.$createPageButton.attr('disabled', true);
		}
	});

	ContactForm.prototype.onCreateButtonClick = (function(event) {
		var self = this;
		self.$presetSelector.attr('disabled', true);
		self.$createPageSelector.attr('disabled', true)
		self.$createPageButton.attr('disabled', true);

		Membership.ajax({
			route: 'membership.createPage',
			slug: self.$createPageButton.data('page-slug')
		}, {'method': 'post'}).done(function (response) {
			if (response.success) {

				$('.mp-page-option').find('.wp-pages-list').append(
					$('<option value="' + response.page.id + '">' + response.page.title + '</option>')
				);
				self.$createPageSelector.val(response.page.id);
				self.$createPageSelector.attr('disabled', false);
				self.$presetSelector.attr('disabled', false);
				self.$createPageSelector.trigger('change');
			}
		});
	});

	$(document).ready(function() {
		var $cfObj = new ContactForm();
		$cfObj.init();
	});
})(jQuery, window.Membership);