<?php

/**
 * Table definition
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistrations
 * @subpackage Proregistrations/includes
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
class Proregistration_Tables
{
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function createProregistrationTable()
	{
		global $wpdb;
		return $wpdb->prefix."product_registrations";
	}

    public function createTable()
    {
        // global $wpdb;
		// if(count($wpdb->get_var("SHOW TABLES LIKE %s'".$this->createProregistrationTable()."'")) == 0)
		// {
			// Products Registration table generating code
			$sqlQuery = 'CREATE TABLE `'.$this->createProregistrationTable().'` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(100) NOT NULL,
				`email` varchar(100) NOT NULL,
				`phone` varchar(15) NOT NULL,
				`address` varchar(255) NOT NULL,
				`purchased_date` date NOT NULL,
				`serial` varchar(35) NOT NULL,
				`invoice` varchar(255) NOT NULL,
				`store_note` varchar(255) DEFAULT NULL,
				`created_at` date DEFAULT "0000-00-00" NOT NULL,
				`status` int(1) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8';

			dbDelta($sqlQuery);
		// }
    }

}
