<?php
/**
 *
 * Hide 24 hour Activity Stats. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di, https://github.com/3D-I/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\hideactivity24hrs\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\user */
	protected $user;

	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\user $user)
	{
		$this->auth = $auth;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'										=>	'hide_24_hour_stats_permissions',
			'core.acp_board_config_edit_add'						=>	'hide_24_hour_stats_modify_span',
			'rmcgirr83.activity24hours.modify_activity_display'		=>	'hide_24_hour_stats',
		);
	}

	/**
	 * Permission's language file is automatically loaded
	 *
	 * @event core.permissions
	 */
	public function hide_24_hour_stats_permissions($event)
	{
		$permissions = $event['permissions'];

		$permissions += array(
			'u_allow_ha24hrs_view' => array(
				'lang'	=> 'ACL_U_ALLOW_HA24HRS_VIEW',
				'cat'	=> 'misc',
			),
		);

		$event['permissions'] = $permissions;
	}

	/**
	* Event to add and/or modify acp_board configurations
	*
	* @event core.acp_board_config_edit_add
	* @var	array	display_vars	Array of config values to display and process
	* @var	string	mode			Mode of the config page we are displaying
	* @var	boolean	submit			Do we display the form or process the submission
	* @since 3.1.0-a4
	*/
	public function hide_24_hour_stats_modify_span($event)
	{
		if ($event['mode'] == 'load')
		{
			/* Avoid "Indirect modification of overloaded element" PHP issue */
			$display_vars = $event['display_vars'];

			/*
			 * Set modified existing config.
			 *
			 * Ladies & Gents, as per the customer's request.
			 * We use the same native configuration, appending an extra 9 to the cast.
			 */
			$new_span = array(
				'load_online_time'	=> array('lang' => 'ONLINE_LENGTH',	'validate' => 'int:0:9999',	'type' => 'number:0:9999', 'explain' => true, 'append' => ' ' . $this->user->lang['MINUTES']),
			);

			/*
			 * Validate config.
			 *
			 * Apparently we are supposed to show "after" it, this overrides the native one instead.
			 */
			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $new_span, array('after' => 'load_online_time'));

			$event['display_vars'] = $display_vars;
		}
	}

	/**
	* Modify activity display
	*
	* @event rmcgirr83.activity24hours.modify_activity_display
	* @var array	activity				An array of the activity posts, topics etc.
	* @var array	active_users			An array of users active for past x time
	* @var bool		total_guests_online_24	Count of guests for past x time
	* @var array	template_data			An array of the template items
	* @since 1.0.6
	*/
	public function hide_24_hour_stats($event)
	{
		/* Avoid "Indirect modification of overloaded element PHP" issue */
		$tpl_data = $event['template_data'];

		/* If not authorized hide the statistics block */
		$tpl_data['S_CAN_VIEW_24_HOURS'] = ($this->auth->acl_get('u_allow_ha24hrs_view')) ? true : false;

		$event['template_data'] = $tpl_data;
	}
}
