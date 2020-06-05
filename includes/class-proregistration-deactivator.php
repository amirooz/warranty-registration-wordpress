<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Proregistration
 * @subpackage Proregistration/includes
 * @author     MD. Amir Hossain <amirhossain0606@gmail.com>
 */
class Proregistration_Deactivator
{
	private $tables;

	public function __construct($tableobj)
	{
		$this->tables = $tableobj;
	}

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function deactivate() {
		// Drop Products Registration table
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS ".$this->tables->createProregistrationTable());

		if(!empty(get_option('warranty_registration')))
		{
			$page_id = get_option('warranty_registration');
			wp_delete_post($page_id, true);
			delete_option('warranty_registration');
		}
	}

}
