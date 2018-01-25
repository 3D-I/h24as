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
	'ERROR_MSG_3110_321_MISTMATCH'	=> 'Mínimo 3.1.10 pero menor que 3.2.0@dev O mayor que 3.2.1 pero menor a 3.3.0@dev',
	'ERROR_A24H_NOT_INSTALLED'		=>	'Este ADD-ON requiere la extensión “24 hour activity stats” instalada primero.',
	'ERROR_A24H_WRONG_VERSION'		=>	'Versión incorrecta para la extensión “24 hour activity stats”, necessario  >= 1.0.6',
));
