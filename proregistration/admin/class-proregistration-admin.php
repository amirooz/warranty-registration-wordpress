<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Proregistration
 * @subpackage Proregistration/admin
 * @author     MD. Amir Hossain <amirhossain0606@gmail.com>
 */
class Proregistration_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The supports table of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tables    The current table of this plugin.
	 */
	private $tables;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		include_once CVM_SUPPORT_PLUGIN_DIR. 'includes/class-proregistration-tables.php';
		$this->tables = new Proregistration_Tables();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Proregistration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Proregistration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/proregistration-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'cvm-supports-admin', plugin_dir_url( __FILE__ ) . 'css/cvm-support-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Proregistration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Proregistration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/proregistration-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'jquery-3.2.1', plugin_dir_url( __FILE__ ) . 'js/jquery-3.2.1.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'popper', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'jquery.validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'cvm-support-admin', plugin_dir_url( __FILE__ ) . 'js/cvm-support-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( 'cvm-support-admin', 'proregistration_admin', admin_url('admin-ajax.php'));

	}

	/**
	 * Admin menus
	 *
	 * Admin submenus
	 *
	 * @since    1.0.0
	 */
	public function proregistration_menus()
	{
		add_menu_page("CVM Supports","CVM Supports","manage_options","cvm-supports",array($this,"cvm_supports"),"dashicons-palmtree",30);
		add_submenu_page("cvm-supports","All Queries","All Queries","manage_options","cvm-supports",array($this,"cvm_supports"));
		add_submenu_page("cvm-supports","Add New","Add New","manage_options","add-support",array($this,"new_cvm_support"));
	}

	public function cvm_supports()
	{
		include_once CVM_SUPPORT_PLUGIN_DIR. '/admin/partials/proregistration-admin-all-supports.php';
	}

	public function new_cvm_support()
	{
		include_once CVM_SUPPORT_PLUGIN_DIR. '/admin/partials/proregistration-admin-add-support.php';
	}

	// ajax request to store data
	public function cvm_ajax_handler()
	{
		$param = isset($_REQUEST['param'])?$_REQUEST['param']:'';
		global $wpdb;
		if(!empty($param) && $param == 'save_support')
		{
			$name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
			$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
			$phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
			$address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
			$purchased_date = isset($_REQUEST['purchased_date'])?$_REQUEST['purchased_date']:'';
			$serial = isset($_REQUEST['serial'])?$_REQUEST['serial']:'';
			$invoice = isset($_REQUEST['invoice'])?$_REQUEST['invoice']:'';
			$store_note = isset($_REQUEST['store_note'])?$_REQUEST['store_note']:'';
			$created_at = date("Y-m-d");
			$status = isset($_REQUEST['status'])?$_REQUEST['status']:'';

			$wpdb->insert($this->tables->createProregistrationTable(), array(
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'purchased_date' => $purchased_date,
				'serial' => $serial,
				'invoice' => $invoice,
				'store_note' => $store_note,
				'created_at' => $created_at,
				'status' => $status
			));

			if($wpdb->insert_id > 0)
			{
				echo json_encode(array(
					'status' => 1,
				 	'message' => 'Data has been saved successfully'
				));
			}
			else
			{
				echo json_encode(array(
					'status' => 0,
				 	'message' => 'Insertion failed!'
				));
			}
		}
		elseif(!empty($param) && $param == 'delete_item')
		{
			$id = isset($_REQUEST['id'])? intval($_REQUEST['id']) : 0;

			$is_exist = $wpdb->get_row(
				$wpdb->prepare(
					"SELECT * FROM ".$this->tables->createProregistrationTable()." WHERE id=%d", $id
				),ARRAY_A
			);

			if(!empty($is_exist))
			{
				$wpdb->delete(
					$this->tables->createProregistrationTable(),
					array('id'=>$id)
				);
				echo json_encode(array('status'=> 1, 'message'=>'Record has been deleted successfully!'));
			}
			else
			{
				echo json_encode(array('status'=> 0, 'message'=>'No record found!'));
			}
		}
		wp_die();
	}

}
