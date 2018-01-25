<?php
/**
 *
 * Hide 24 hour Activity Stats. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di, https://github.com/3D-I/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\hideactivity24hrs;

/**
 * Hide 24 hour Activity Stats Extension base
 *
 * It is recommended to remove this file from
 * an extension if it is not going to be used.
 */
class ext extends \phpbb\extension\base
{
	/**
	 * Check whether the extension can be enabled.
	 * Provides meaningful(s) error message(s) and the back-link on failure.
	 * CLI and 3.1/3.2 compatible (we do not use the $lang object here on purpose)
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$is_enableable = true;

		$user = $this->container->get('user');
		$user->add_lang_ext('threedi/hideactivity24hrs', 'ext_require');
		$lang = $user->lang;

		if (!( (phpbb_version_compare(PHPBB_VERSION, '3.2.1', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.3.0@dev', '<')) || (phpbb_version_compare(PHPBB_VERSION, '3.1.10', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.2.0@dev', '<')) ) )
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_MSG_3110_321_MISTMATCH');
			$is_enableable = false;
		}

		/**
		 * Now if the extension is enabled, first.
		 */
		$ext_manager = $this->container->get('ext.manager');
		$is_the_other_ext_enabled = $ext_manager->is_enabled('rmcgirr83/activity24hours');

		if ( !($is_the_other_ext_enabled))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_A24H_NOT_INSTALLED');
			$is_enableable = false;
		}

		/**
		 * And now the metadata...
		 * If the VERSION field exists and is set then let's check the version
		 */
		$metadata_manager = $ext_manager->create_extension_metadata_manager('rmcgirr83/activity24hours', $this->container->get('template'));

		$metadata = $metadata_manager->get_metadata('all');

		$required = $metadata['version'];

		/**
		 * If the VERSION field exists and is set then let's check the version
		 */
		if ($required && isset($required))
		{
			$clean_required = html_entity_decode($required);

			$version = phpbb_version_compare($clean_required, '1.0.6', '>=');
		}

		/* Wrong VERSION? No party! */
		if ( !($version))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_A24H_WRONG_VERSION');
			$is_enableable = false;
		}

		$user->lang = $lang;

		return $is_enableable;
	}
}
