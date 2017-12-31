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
	'ERROR_MSG_3110_321_MISTMATCH'	=>	'Minimo 3.1.10 ma minore di 3.2.0@dev. Oppure maggiore di 3.2.1 ma minore di 3.3.0@dev',
	'ERROR_A24H_NOT_INSTALLED'		=>	'Questo ADD-ON richiede che l’estensione “24 hour activity stats” sia giá installata prima di procedere.',
	'ERROR_A24H_WRONG_VERSION'		=>	'Versione non corretta per l’estensione “24 hour activity stats” attualmente installatam richiesta >= 1.0.6',
));
