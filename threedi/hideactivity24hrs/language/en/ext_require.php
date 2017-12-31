<?php
/**
 *
 * Hide 24 hour Activity Stats. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di, https://github.com/3D-I/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ERROR_MSG_3110_321_MISTMATCH'	=>	'Minimum 3.1.10 but less than 3.2.0@dev OR greater than 3.2.1 but less than 3.3.0@dev',
	'ERROR_A24H_NOT_INSTALLED'		=>	'This ADD-ON requires the “24 hour activity stats” extension installed first.',
	'ERROR_A24H_WRONG_VERSION'		=>	'Wrong version for the “24 hour activity stats” extension installed. Required >= 1.0.6',
));
