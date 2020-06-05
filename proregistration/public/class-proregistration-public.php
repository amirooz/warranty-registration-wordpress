<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Proregistration
 * @subpackage Proregistration/public
 * @author     MD. Amir Hossain <amirhossain0606@gmail.com>
 */
class Proregistration_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/proregistration-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-datepicker', plugin_dir_url( __FILE__ ) . 'css/bootstrap-datepicker.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/proregistration-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jquery-3.2.1.min.js', plugin_dir_url( __FILE__ ) . 'js/jquery-3.2.1.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'popper.min.js', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'jquery.validate.min.js', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'bootstrap-datepicker', plugin_dir_url( __FILE__ ) . 'js/bootstrap-datepicker.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'cvm-support-public', plugin_dir_url( __FILE__ ) . 'js/cvm-support-public.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( 'cvm-support-public', 'proregistration_public', admin_url( 'admin-ajax.php' ));

	}

	/**
	 * Product warranty register template for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function product_registration()
	{
		global $post;
		$post_name = $post->post_name;
		if($post_name == 'warranty-registration')
		{
			$registration_template = CVM_SUPPORT_PLUGIN_DIR.'/public/partials/proregistration-public-shortcode.php';
		}
		return $registration_template;
	}

	public function helix_support_registration()
	{
		include_once CVM_SUPPORT_PLUGIN_DIR.'/public/partials/proregistration-public-add-support.php';
	}

	// ajax request to store data
	public function cvm_public_ajax_handler()
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
			$created_at = date("Y-m-d");

			$wpdb->insert($this->tables->createProregistrationTable(), array(
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'purchased_date' => $purchased_date,
				'serial' => $serial,
				'invoice' => $invoice,
				'created_at' => $created_at,
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
		wp_die();
	}

}
