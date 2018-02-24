(function($, Membership) {
	var mbsSemPopup = new mbsSemanticPopup()
	,	mbsAttachmentBeh = null;

	var NewConversationForm = function(conversations) {

		this.$el = $('.new-conversation-container');
		this.searchLimit = 20;
		this.searchedUsers = [];
		this.cachedSearches = [];
		this.$searchDropdown = this.$el.find('.search.dropdown');
		this.$loader = this.$searchDropdown.find('.loader');
		this.searchUsersRequest = false;

		var self = this,
			$conversationCreateForm = this.$el.find('.conversation-create-form'),
			createConversationForm = new MessageForm($conversationCreateForm);

		createConversationForm.onSend(function(event, message) {
			var dropdownValue = self.$searchDropdown.mpDropdown('get value');

			if (!dropdownValue.length) {
				createConversationForm.removeSendState();
				return;
			}

			var users = dropdownValue.split(',');

			Membership.api.messages.createConversation({
				users: users,
				message: message
			}).then(function(response) {
				if (response.success) {
					self.$searchDropdown.mpDropdown('restore defaults');
					var $conversationListItem = $(response.html.conversationListItem),
						$conversationMessages = $(response.html.conversationMessages);

					self.$el.hide();
					conversations.showConversationsList();
					var conversation = conversations.addNewConversation($conversationListItem, $conversationMessages, true);
					conversation.conversation.fetchNewMessages(200);
				} else {
					Snackbar.show({text: response.message});
				}
				createConversationForm.clear();
			});
		});

		this.$searchDropdown.mpDropdown({
			onLabelCreate: function(value, text) {
				self.$searchDropdown.mpDropdown('hide');
				return $('<div>' + text + '</div>').find('.mp-user-label');
			},
			onChange: function(value, text, $selectedItem) {
				if (typeof $selectedItem === 'string') {
					self.$searchDropdown.mpDropdown('hide');
				}
			},
			onNoResults: function(searchValue) {
				return !(searchValue.length < 2 || self.searchUsersRequest);
			},
			forceSelection: false,
			minCharacters: 0,
			maxSelections: 10,
			fullTextSearch: false
		});

		this.$usersList = this.$searchDropdown.find('.menu.list');

		this.$usersList.children().each(function() {
			self.searchedUsers.push($(this).attr('data-value'));
		});

		this.$searchDropdown.find('.search').on('keyup', Membership.helpers.debounce(function() {
			self.searchUsers(this.value);
		}, 1000));

		this.$el.find('.show-all-conversations').on('click', function() {
			self.$el.hide();
			conversations.showConversationsList();
		});

	};

	NewConversationForm.prototype.searchUsers = function(searchQuery) {

		var self = this;

		if (searchQuery.length > 2 && this.cachedSearches.indexOf(searchQuery) === -1) {

			this.$searchDropdown.mpDropdown('hide');
			this.$loader.show();
			this.cachedSearches.push(searchQuery);
			this.searchUsersRequest = true;

			Membership.api.users.search({
				query: searchQuery,
				limit: self.searchLimit,
				template: 'search-dropdown'
			}).then(function(response) {
				if (response.success) {
					var $users = $(response.html);
					$users.each(function() {
						var $user = $(this),
							userId = $user.attr('data-value');

						if (self.searchedUsers.indexOf(userId) === -1) {
							self.$usersList.append($user);
						}
					});

					self.searchUsersRequest = false;
					self.$searchDropdown.mpDropdown('refresh');
					self.$searchDropdown.mpDropdown('show');
				}

				self.$loader.hide();
			});
		}
	};

	var MessageForm = function($mesageForm) {

		var $textArea = $mesageForm.find('textarea'),
			$sendButton = $mesageForm.find('button.submit'),
			$charactersCounter = $mesageForm.find('.characters-count'),
			self = this;

		$textArea.on('change input paste', function() {
			var $textArea = $(this),
				borderWidth = parseInt($textArea.css('borderTopWidth'), 10) + parseInt($textArea.css('borderBottomWidth'), 10),
				messageLength = $textArea.val().length;

			$textArea.css('height', 'auto');

			if ($.trim($textArea.val())) {
				$textArea.css('height', $textArea.get(0).scrollHeight + borderWidth + 'px');
			}

			$charactersCounter.text(messageLength);

			if (messageLength) {
				$charactersCounter.show();
			} else {
				$charactersCounter.hide();
			}
		});

		$sendButton.on('click', function(event) {
			var message = $textArea.val()
			,	attachmentArr = [];
			if(mbsAttachmentBeh) {
				attachmentArr = mbsAttachmentBeh.getAttachedIds();
			}

			if (message.length || attachmentArr.length) {
				self.setSendState();
				$textArea.trigger('sendMessage', message);
			}

		});

		this.$textArea = $textArea;
		this.$sendButton = $sendButton;
	};

	MessageForm.prototype.onSend = function(callback) {
		this.$textArea.on('sendMessage', callback);
	};

	MessageForm.prototype.clear = function() {
		this.$textArea.val('').trigger('change');
		this.removeSendState();
	};

	MessageForm.prototype.setSendState = function() {
		this.$textArea.attr('disabled', true);
		this.$sendButton.attr('disabled', true).addClass('loading');
	};

	MessageForm.prototype.removeSendState = function() {
		this.$textArea.removeAttr('disabled');
		this.$sendButton.removeAttr('disabled').removeClass('loading');
	};

	var Conversations = function() {

		var self = this;

		this.$conversationsList = $('.conversations-list');
		this.$conversationListItems = this.$conversationsList.find('.item');
		this.$conversations = $('.conversations-messages-container .conversation');
		this.conversations = [];
		this.$conversationsListContainer = $('.conversations-list-container');
		this.$conversationsMessagesContainer = $('.conversations-messages-container');
		this.$noConversationsMessage = $('.no-conversations-message');

		this.$conversationListItems.each(function () {
			var $listItem = $(this),
				id = $listItem.attr('data-id'),
				$conversation = self.$conversations.filter('[data-id="' + id +'"]');

			self.conversations.push({
				id: id,
				listItem: new ConversationListItem($listItem, id, self),
				conversation: new Conversation($conversation, id, self)
			});
		});

		$('.new-conversation').on('click', function() {
			newConversationForm.$el.show();
			self.$conversationsListContainer.hide();
			self.$conversationsMessagesContainer.hide();
		});

		var newConversationForm = new NewConversationForm(this);

		setInterval(function () {
			Membership.api.messages.checkUnreadMessages().then(function(response) {
				if (response.success) {

					var $listItems = $(response.html.conversationListItems).filter('.item'),
						$conversations = $(response.html.conversations).filter('.conversation'),
						conversation;

					if ($listItems.length) {

						for (var i = 0; i < $listItems.length; i++) {
							conversation = self.addNewConversation($($listItems[i]), $($conversations[i]));
							conversation.conversation.hasUnreadMessages = true;
						}

						self.updateActiveConversationMessages();
					}
				}
			})
		}, 10000)

	};

	Conversations.prototype.getConversation = function(conversationId) {
		return this.conversations.filter(function(conversation) {
			return conversation.id === conversationId;
		})[0];
	};

	Conversations.prototype.showConversation = function(conversationId) {
		this.$conversationsListContainer.hide();
		this.$conversationsMessagesContainer.show();
		this.$conversations.hide();
		this.$noConversationsMessage.hide();
		this.getConversation(conversationId).conversation.show();
	};

	Conversations.prototype.deleteConversation = function(conversationId) {
		var conversations = this.conversations,
			self = this;
		for (var i = conversations.length - 1; i > -1; i--) {
			if (conversations[i].id === conversationId) {
				(function(i) {
					conversations[i].listItem.$el.fadeOut(function() {
						conversations[i].listItem.$el.remove();
						conversations[i].conversation.$el.remove();
						conversations.splice(i, 1);

						if (! conversations.length) {
							self.$noConversationsMessage.show();
						}
					});
				})(i);
			}
		}

		return Membership.api.messages.deleteConversation({conversationId: conversationId});
	};

	Conversations.prototype.showConversationsList = function() {
		this.$conversationsListContainer.show();
		this.$conversationsMessagesContainer.hide();
		this.$conversations.hide();
	};

	Conversations.prototype.updateActiveConversationMessages = function() {
		var conversations = this.conversations;
		for (var i = conversations.length - 1; i > -1; i--) {
			if (conversations[i].conversation.isActive) {
				if (conversations[i].conversation.hasUnreadMessages) {
					conversations[i].conversation.fetchNewMessages(200);
					conversations[i].conversation.hasUnreadMessages = false;
				}
				break;
			}
		}
	};

	Conversations.prototype.updateConversationListLastMessage = function(conversationId, message) {
		this.getConversation(conversationId).listItem.updateLastMessage(message);
	};

	Conversations.prototype.updateUnreadMessagesCounter = function(conversationId) {
		this.getConversation(conversationId).listItem.updateUnreadMessagesCounter();
	};

	Conversations.prototype.addNewConversation = function($listItem, $conversation, show) {

		var conversationId = $listItem.attr('data-id'),
			conversation = this.getConversation(conversationId);

		if (conversation) {
			conversation.listItem.$el.replaceWith($listItem);
			conversation.listItem = new ConversationListItem($listItem, conversationId, this);
		} else {
			this.$conversationsList.append($listItem);
			this.$conversationsMessagesContainer.append($conversation);
			conversation = {
				id: conversationId,
				listItem: new ConversationListItem($listItem, conversationId, this),
				conversation: new Conversation($conversation, conversationId, this)
			};
			this.conversations.push(conversation);
			this.$conversations = $.merge(this.$conversations, $conversation);
		}

		if (show) {
			this.showConversation(conversationId);
		}

		return conversation;
	};

	var ConversationListItem = function($el, id, conversations) {
		this.$el = $el;
		this.updateLastMessageDate();
		$el.on('click', function() {
			conversations.showConversation(id);
		});
	};

	ConversationListItem.prototype.updateUnreadMessagesCounter = function() {
		this.$el.find('.unread-messages-count').hide();
	};

	ConversationListItem.prototype.updateLastMessage = function(message) {
		this.$el.find('.last-message').text(message);
	};

	ConversationListItem.prototype.updateLastMessageDate = function() {
		var $lastMessageDate = this.$el.find('.last-message-date');
		$lastMessageDate.text(Membership.helpers.moment($lastMessageDate.text()));
	};

	var Conversation = function($el, id, conversations) {
		this.$el = $el;
		this.id = id;
		this.hasUnreadMessages = false;
		this.isActive = false;
		this.conversations = conversations;
		this.isInitialized = false;
	};

	Conversation.prototype.show = function() {
		var isInited = this.isInitialized;
		if (!this.isInitialized) {
			this.init();
		} else {
			if (this.hasUnreadMessages) {
				this.fetchNewMessages(200);
			}
		}

		if (this.hasUnreadMessages) {
			this.hasUnreadMessages = false;
		}

		this.isActive = true;
		this.conversations.updateUnreadMessagesCounter(this.id);
		this.$el.show();

		if(isInited) {
			if(mbsAttachmentBeh) {
				mbsAttachmentBeh.initMessageConversationContainer();
			}
		}
	};

	Conversation.prototype.init = function() {

		this.$dropdownMenu = this.$el.find('.dropdown');
		this.$messagesContainer = this.$el.find('.conversation-messages');
		this.$messagesLoader = this.$el.find('.conversation-loader');
		this.$messageForm = this.$el.find('.send-message-reply-form');
		this.messagesContainerScrollTop = 0;
		this.oldMessagesLoading = false;
		this.newMessagesLoading = false;
		this.messagesLimit = 10;
		this.oldMessagesLastMessageId = null;
		this.newMessagesLastMessageId = null;

		var self = this;

		this.$dropdownMenu.mpDropdown({action: 'hide'});

		this.$messagesContainer.on('scroll', function(event) {
			event.preventDefault();
			if (this.scrollTop < 250 && this.scrollTop <= self.messagesContainerScrollTop) {
				var messagesContainer = this,
					oldScrollHeight = messagesContainer.scrollHeight;

				self.fetchOldMessages().then(function() {
					messagesContainer.scrollTop = messagesContainer.scrollHeight - oldScrollHeight + messagesContainer.scrollTop;
				});
			}

			self.messagesContainerScrollTop = this.scrollTop;
		});

		this.$messagesLoader.show();

		this.fetchNewMessages(200).then(function() {
			var $messages = self.$messagesContainer.find('.mp-message');
			self.$messagesLoader.hide();
			self.oldMessagesLastMessageId = $messages.first().attr('data-id');
		});

		var messageForm = new MessageForm(this.$messageForm);

		messageForm.onSend(function(event, message) {
			var attachmentArr = [];
			if(mbsAttachmentBeh) {
				attachmentArr = mbsAttachmentBeh.getAttachedIds();
			}
			Membership.api.messages.sendMessage({
				conversationId: self.id,
				message: message,
				'attachments': attachmentArr,
			}).then(function(response) {
				if (response.success) {
					var $messages = $(response.html).filter('.mp-message');
					self.$messagesContainer.append($messages);
					self.newMessagesLastMessageId = $messages.last().attr('data-id');
					self.conversations.updateConversationListLastMessage(self.id, message);
					self.scrollMessagesContainerToBottom(1);

					if(mbsAttachmentBeh) {
						mbsAttachmentBeh.clearAttachmentWrapper(true);
					}
				} else {
					Snackbar.show({text: response.message});
				}

				messageForm.clear();
			});
		});

		var messages = [],
			nodes = [];

		var $deleteMessagesModal = $('#delete-messages-modal').mpModal({
			onApprove: function($approveButton) {
				$deleteMessagesModal.find('.actions button').attr('disabled', true);
				$approveButton.addClass('loading');

				Membership.api.messages.deleteMessages({
					conversationId: self.id,
					messages: messages
				});

				nodes.forEach(function($message) {
					$message.fadeOut(function() {
						$message.remove()
					});
				});

				self.deleteMessagesCancelAction();
			},
			onHidden: function() {
				$deleteMessagesModal.find('.actions button').removeAttr('disabled').removeClass('loading');
			}
		});

		var $deleteConversationModal = $('#delete-conversation-modal').mpModal({
			onApprove: function($approveButton) {
				$deleteMessagesModal.find('.actions button').attr('disabled', true);
				$approveButton.addClass('loading');
				self.conversations.deleteConversation(self.id);
				self.conversations.showConversationsList();
			},
			onHidden: function() {
				$deleteConversationModal.find('.actions button').removeAttr('disabled').removeClass('loading');
			}
		});

		var $deleteMessages = self.$el.find('.conversation-delete-messages-buttons'),
			$deleteMessagesButton = $deleteMessages.find('.delete-action'),
			$cancelDeletionButton = $deleteMessages.find('.cancel-action');

		this.$el.find('.show-all-conversations').on('click', function() {
			self.isActive = false;
			self.conversations.showConversationsList();
		});

		this.$dropdownMenu.find('.delete-messages').on('click', function() {
			self.deleteMessagesAction();
		});

		$deleteMessagesButton.on('click', function () {

			messages = [];
			nodes = [];

			self.$messagesContainer.find('.delete-message-column input:checked').each(function() {
				messages.push(this.value);
				nodes.push($(this).closest('.mp-message'));
			});

			if (messages.length) {
				$deleteMessagesModal.mpModal('show');
			}

		});

		$cancelDeletionButton.on('click', function () {
			self.deleteMessagesCancelAction();
		});

		this.$deleteMessages = $deleteMessages;

		this.$dropdownMenu.find('.delete-conversation').on('click', function() {
			$deleteConversationModal.mpModal('show');
		});

		var $blockUserMenuItem = this.$dropdownMenu.find('.block-user'),
			$blockedUserContainer = this.$el.find('.blocked-user'),
			$unblockUserButton = $blockedUserContainer.find('button'),
			blockedUserId = $blockedUserContainer.attr('data-user-id');

		$blockUserMenuItem.on('click', function() {
			Membership.api.messages.blockUser({userId: blockedUserId}).then(function(response) {
				Snackbar.show({text: response.message});
				if (response.success) {
					$blockUserMenuItem.hide();
					$blockedUserContainer.show();
				}
			});
		});

		$unblockUserButton.on('click', function() {
			$unblockUserButton.addClass('loading disabled');
			$unblockUserButton.attr('disabled', true);
			Membership.api.messages.unblockUser({userId: blockedUserId}).then(function(response) {
				Snackbar.show({text: response.message});
				$unblockUserButton.removeClass('loading disabled');
				$unblockUserButton.removeAttr('disabled');
				$blockedUserContainer.hide();
				$blockUserMenuItem.show();
			});

		});

		this.$messagesContainer.show();
		this.isInitialized = true;
	};

	Conversation.prototype.deleteMessagesAction = function() {
		this.$deleteMessages.show();
		this.$el.addClass('delete-messages-action');
		this.$messageForm.hide();
	};

	Conversation.prototype.deleteMessagesCancelAction = function() {
		this.$deleteMessages.hide();
		this.$el.removeClass('delete-messages-action');
		this.$messageForm.show();
	};

	Conversation.prototype.fetchOldMessages = function() {

		var self = this;

		if (!this.oldMessagesLoading) {
			this.$messagesLoader.show();
			this.oldMessagesLoading = true;

			return Membership.api.messages.getMessages({
				conversationId: this.id,
				limit: this.messagesLimit,
				lastMessageId: this.oldMessagesLastMessageId,
				direction: -1
			}).then(function(response) {
				if (response.success) {
					var $messages = $(response.html).filter('.mp-message');

					if ($messages.length) {
						$messages.find('.mp-message-content .date').each(function() {
							var $date = $(this);
							$date.text(Membership.helpers.moment($date.text()));
						});
						self.$messagesContainer.prepend($messages);
						self.oldMessagesLastMessageId = $messages.first().attr('data-id');
					}

					if ($messages.length === 10) {
						self.oldMessagesLoading = false;
					}
					mbsSemPopup.init();
				}

				self.$messagesLoader.hide();
			});
		}

		return $.Deferred().reject();
	};

	Conversation.prototype.fetchNewMessages = function(scroll) {

		var self = this;
		this.firstFetchCompleted = false;

		if (!this.newMessagesLoading) {
			this.newMessagesLoading = true;
			return Membership.api.messages.getMessages({
				conversationId: this.id,
				limit: this.messagesLimit,
				lastMessageId: this.newMessagesLastMessageId,
				direction: 1
			}).then(function(response) {
				if (response.success) {
					var $messages = $(response.html).filter('.mp-message');
					if ($messages.length) {
						$messages.find('.mp-message-content .date').each(function() {
							var $date = $(this);
							$date.text(Membership.helpers.moment($date.text()));
						});
						self.$messagesContainer.append($messages);
						self.newMessagesLastMessageId = $messages.last().attr('data-id');
					}
				}

				if (scroll) {
					// calc offset size when images loaded
					setTimeout(function() {
						self.scrollMessagesContainerToBottom(scroll);
					}, 350);
				}

				if(!self.firstFetchCompleted) {
					if(mbsAttachmentBeh) {
						mbsAttachmentBeh.initMessageConversationContainer();
					}
					self.firstFetchCompleted = true;
				}
				mbsSemPopup.init();
				self.newMessagesLoading = false;
			});
		}

		return $.Deferred().reject();
	};

	Conversation.prototype.scrollMessagesContainerToBottom = function(delay) {
		this.$messagesContainer.animate({
			scrollTop: this.$messagesContainer.get(0).scrollHeight
		}, delay || 500);
	};

	function mbsSemanticPopup() {}
	mbsSemanticPopup.prototype.init = (function() {
		$('.mbsPopupImage').off('click').on('click', function(event) {
			event.preventDefault();

			$('.ui.modal img.image').attr('src', $(this).find('.mbsMsgAttachmImage').attr('src'));
			$('#mbsImagePopupModalWnd').mpModal('show');
		});
	});

	new Conversations();


	$(document).ready(function() {
		if(window.mbsAttachmentMessageBehavior) {
			mbsAttachmentBeh = new window.mbsAttachmentMessageBehavior();
			// first init
			mbsAttachmentBeh.initMessageConversationContainer();
		}
	});

})(jQuery, Membership);