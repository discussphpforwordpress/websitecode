<?php

class Membership_Mail_Model_Settings extends Membership_Base_Model_Settings
{
	protected $settingField = 'mail';
	
	public function defaultSettings() 
	{
		return array(
			'emails' => array (
				'mail-appears-from' => get_bloginfo('name'),
				'mail-appears-from-address' => get_bloginfo('admin_email'),
				'use-html-for-emails' => 'true',
				'account-welcome-email' => 'true',
				'account-welcome-email-subject' => $this->translate('Welcome to {site_name}!'),
				'account-welcome-email-body' => $this->translate('Hi {display_name}.
Thank you for signing up with {site_name}!

To login please visit the following url: 

<a href="{login_url}">{login_url}</a>

Your account e-mail: {email}

Your account username: {username}

Your account password: {password}

If you have any problems, please contact us at {admin_email}

Thanks, {site_name}'),
				'account-activation-email' => 'true',
				'account-activation-email-subject' => $this->translate('Please activate your account'),
				'account-activation-email-body' => translate('Thank you for signing up with {site_name}!
To activate your account, please click the link below to confirm your email address: <a href="{account_activation_link}">{account_activation_link}</a>
If you have any problems, please contact us at {admin_email}
Thanks, {site_name}'),
				'pending-review-email' => 'true',
				'pending-review-email-subject' => $this->translate('Your account is pending review'),
				'pending-review-email-body' => $this->translate('Hi {display_name}.
Thank you for signing up with {site_name}!
Your account is currently being reviewed by a member of our team.
Please allow us some time to process your request.
If you have any problems, please contact us at {admin_email}

Thanks, {site_name}'),
				'account-approved-email' => 'true',
				'account-approved-email-subject' => $this->translate('Your account at {site_name} is now active'),
				'account-approved-email-body' => $this->translate('Hi {display_name}.
Thank you for signing up with {site_name}!
Your account has been approved and is now active.
To login please visit the following url: <a href="{login_url}">{login_url}</a>
Your account e-mail: {email}
Your account username: {username}
Your account password: {password}
If you have any problems, please contact us at {admin_email}

Thanks, {site_name}'),
				'account-rejected-email' => 'true',
				'account-rejected-email-subject' => $this->translate('Your account has been rejected'),
				'account-rejected-email-body' => $this->translate('Hi {display_name}.		 
Thank you for applying for membership to {site_name}!
We have reviewed your information and unfortunately we are unable to accept you as a member at this moment.
Please feel free to apply again at a future date.

Thanks, {site_name}'),
				'account-deactivation-email' => 'true',
				'account-deactivation-email-subject' => $this->translate('Your account has been deactivated'),
				'account-deactivation-email-body' =>  $this->translate('Hi {display_name}
This is an automated email to let you know your {site_name} account has been deactivated.
I you would like your account to be reactivated please contact us at {admin_email}
Thanks, {site_name}'),
				'account-deleted-email' => 'true',
				'account-deleted-email-subject' => $this->translate('Your account has been deleted'),
				'account-deleted-email-body' =>  $this->translate('Hi {display_name}.
This is an automated email to let you know your {site_name} account has been deleted.
All of your personal information has been permanently deleted and you will no longer be able to login to {site_name}.

If your account has been deleted by accident please contact us at {admin_email}

Thanks, {site_name}'),
				'password-reset-email' => 'true',
				'password-reset-email-subject' => $this->translate('Reset your password'),
				'password-reset-email-body' =>  $this->translate('Hi {display_name}.
We received a request to reset the password for your account.
If you made this request, click the link below to change your password:
<a href="{password_reset_link}">{password_reset_link}</a>

If you didn\'t make this request, you can ignore this email

Thanks, {site_name}'),
				'password-changed-email' => 'true',
				'password-changed-email-subject' => $this->translate('Your {site_name} password has been changed'),
				'password-changed-email-body' =>  $this->translate('Hi {display_name}.
You recently have requested for changing the password associated with your {site_name} account.
To confirm your request please visit the following url: <a href="{password_change_url}">{password_change_url}</a>
If you did not make this change and believe your {site_name} account has been compromised, please contact us at the following email address: {admin_email}

Thanks, {site_name}'),
				'notification-friends-followers' => 'false',
				'notification-friends-followers-subject' => $this->translate('You have new {friend_follower}'),
				'notification-friends-followers-body' => $this->translate('Hi {display_name}.
You have new {friend_follower}.
Сheck it <a target="_blank" href="{followers_url}">here</a>'),
				'message-recieve-notification' => 'false',
				'message-recieve-notification-subject' => 'You have new message from {from_username}.',
				'message-recieve-notification-body' => 'Hi {display_name}.
You have new message from {from_username}. 
To check it - go <a target="_blank" href="{message_url}">here</a>',
			),
			'notifications' => array (
				'messages-refresh-period' => '7',
				'notifications-email-address' => get_bloginfo('admin_email'),
				'new-user-notification' => 'true',
				'new-user-notification-subject' => $this->translate('[{site_name}] New user account'),
				'new-user-notification-body' => $this->translate('{display_name} has just created an account on {site_name}.
To view their profile click here: <a href="{user_profile_link}">{user_profile_link}</a>
Here is the submitted registration form:
{submitted_registration}'),
				'account-needs-review-notification' => 'false',
				'account-needs-review-notification-subject' => $this->translate('[{site_name}] New user awaiting review'),
				'account-needs-review-notification-body' => $this->translate('{display_name} has just applied for membership to {site_name} and is waiting to be reviewed.
To review this member please click the following link: <a href="{user_profile_link}">{user_profile_link}</a>
Here is the submitted registration form:
{submitted_registration}'),
				'account-deletion-notification' => 'false',
				'account-deletion-notification-subject' => $this->translate('[{site_name}] Account deleted'),
				'account-deletion-notification-body' => $this->translate('{display_name} has just deleted their {site_name} account.'),
			),
		);
	}


}