<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Proregistration
 * @subpackage Proregistration/includes
 * @author     MD. Amir Hossain <amirhossain0606@gmail.com>
 */
class Proregistration_Activator
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
	public function activate()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$this->tables->createTable();

		$this->warranty_registration_page_create();
	}

	public function warranty_registration_page_create()
	{
		global $wpdb;
		$is_exist = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$wpdb->prefix}posts WHERE post_name=%s","warranty-registration"
			),ARRAY_A
		);

		if(empty($is_exist))
		{
			$page = [];
			$page['post_title'] = 'Warranty registration';
			$page['post_content'] = 'Cerwin Vega Mobile products warranty registration';
			$page['post_status'] = 'publish';
			$page['post_name'] = 'warranty-registration';
			$page['post_type'] = 'page';

			$post_id = wp_insert_post($page);
			add_option('warranty_registration', $post_id);
		}
	}

}
