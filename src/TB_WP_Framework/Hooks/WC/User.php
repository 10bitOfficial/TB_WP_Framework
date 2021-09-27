<?php

namespace TB_WP_Framework\Hooks\WC;
if(!defined('ABSPATH')){exit;}
use WP_User;

/**
 * @property string $nickname
 * @property string $description
 * @property string $user_description
 * @property string $first_name
 * @property string $user_firstname
 * @property string $last_name
 * @property string $user_lastname
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nicename
 * @property string $user_email
 * @property string $user_url
 * @property string $user_registered
 * @property string $user_activation_key
 * @property string $user_status
 * @property int    $user_level
 * @property string $display_name
 * @property string $spam
 * @property string $deleted
 * @property string $locale
 * @property string $rich_editing
 * @property string $syntax_highlighting
 * @property string[] $roles
 */
class User
{

	/**
	 * @return string[]
	 * @since 1.0.0
	 */
	public static function getOptionalData(): array {
	    return array(
		     'nickname',
		     'description',
		     'user_description',
		     'first_name',
		     'user_firstname',
		     'last_name',
		     'user_lastname',
		     'user_login',
		     'user_pass',
		     'user_nicename',
		     'user_email',
		     'user_url',
		     'user_registered',
		     'user_activation_key',
		     'user_status',
		     'user_level',
		     'display_name',
		     'spam',
		     'deleted',
		     'locale',
		     'rich_editing',
		     'syntax_highlighting',
		     'roles'
	    );
    }

}