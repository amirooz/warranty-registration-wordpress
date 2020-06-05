<div class="wrap">
	<h1 class="wp-heading-inline">Supports</h1>
	<a href="<?php echo get_admin_url()?>admin.php?page=add-support" class="page-title-action">Add New</a>
	<hr class="wp-header-end">
<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 *
 */
class Supports extends WP_List_Table
{
	private $table;

	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Support', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Supports', 'sp' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?

		] );

		include_once CVM_SUPPORT_PLUGIN_DIR. 'includes/class-proregistration-tables.php';
		$this->table = new Proregistration_Tables();

	}

	public function prepare_items()
	{
		$orderby = isset($_GET['orderby'])?trim($_GET['orderby']):"created_at";

		$order = isset($_GET['order'])?trim($_GET['order']):"DESC";

		$search = isset($_POST['s'])?trim($_POST['s']):"";

		$data = $this->get_data($orderby,$order,$search);

		$per_page = 5;

		$current_page = $this->get_pagenum();

		$total = count($data);

		$this->set_pagination_args([
			'total_items' => $total,
			'per_page' => $per_page
		]);

		$this->items = array_slice($data,(($current_page - 1) * $per_page), $per_page);

		$columns = $this->get_columns();

		$hidden = $this->get_hidden_columns();

		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array($columns,$hidden,$sortable);

		$this->process_bulk_action();
	}

	public function get_hidden_columns()
	{
		return ['id','sku','invoice','status'];
	}

	/**
	* Columns to make sortable.
	*
	* @return array
	*/
	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'name' => array( 'name', true ),
			'purchased_date' => array( 'purchased_date', true ),
			'created_at' => array( 'created_at', false )
		);

	  return $sortable_columns;
	}

	public function get_columns()
	{
		$columns = [
			'cb'				=> '<input type="checkbox" />',
			'id'				=> __( 'ID'),
			'name'    			=> __( 'Name'),
			'email' 			=> __( 'Email'),
			'phone' 			=> __( 'Phone'),
			'address' 			=> __( 'Address'),
			'serial' 			=> __( 'Serial'),
			'purchased_date' 	=> __( 'Purchased Date'),
			'invoice' 			=> __( 'Invoice'),
			'created_at' 		=> __( 'Created'),
			'status'    		=> __( 'Status')
		];

		return $columns;
	}

	public function column_default($item,$column_name)
	{
		switch($column_name)
		{
			case 'id':
			case 'name':
			case 'email':
			case 'phone':
			case 'address':
			case 'serial':
			case 'purchased_date':
			case 'invoice':
			case 'created_at':
			case 'status':
				return $item[$column_name];
			default:
				return 'No record found!';
		}
	}

	public function get_data($orderby, $order, $search)
	{
		global $wpdb;

		if(!empty($search))
		{
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM ".$this->table->createProregistrationTable()." WHERE (name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR serial LIKE '%$search%' OR purchased_date LIKE '%$search%')",""
				), ARRAY_A
			);
			return $results;
		}
		else
		{
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM ".$this->table->createProregistrationTable()." ORDER BY id DESC",""
				), ARRAY_A
			);
			return $results;
		}
	}

	/**
	* Render the bulk edit checkbox
	*
	* @param array $item
	*
	* @return string
	*/
	function column_cb( $item ) {
		return sprintf('<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']);
	}

	public function column_name($item)
	{
		// create a nonce
		$delete_nonce = wp_create_nonce( 'sp_delete_support' );

		$name = '<strong>' . $item['name'] . '</strong>';

		$action = [
			'edit' => sprintf('<a href="?page=%s&action=%s&support=%s">Edit</a>',$_GET['page'],'edit',$item['id']),
			'delete' => sprintf('<a href="javascript:void(0)" class="deleteItem" data-id="%s" >Trash</a>',$item['id']),
			// 'delete' => sprintf( '<a href="?page=%s&action=%s&support=%s&_wpnonce=%s">Trash</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce ),
		];

		return $name . $this->row_actions($action);
	}

	/**
	* Delete a support record.
	*
	* @param int $id support ID
	*/
	// public static function delete_support( $id )
	// {
	// 	global $wpdb;
	//
	// 	$wpdb->delete(
	// 	"{$wpdb->prefix}product_registrations",
	// 	[ 'id' => $id ],
	// 	[ '%d' ]
	// 	);
	// }

	/**
	* Returns an associative array containing the bulk action
	*
	* @return array
	*/
	public function get_bulk_actions() {
		$actions = [
			'bulk-delete' => 'Delete'
		];

		return $actions;
	}

	public function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'sp_delete_support' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else
			{
				self::delete_support( absint( $_GET['support'] ) );

				wp_redirect( esc_url( add_query_arg() ) );
				exit;
			}

		}

		// If the delete bulk action is triggered
		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
		   || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

		$delete_ids = esc_sql( $_POST['bulk-delete'] );

		// loop over the array of record IDs and delete them
		foreach ( $delete_ids as $id ) {
		  self::delete_support( $id );

		}

		wp_redirect( esc_url( add_query_arg() ) );
		exit;
		}
	}

	// public function process_bulk_action()
	// {
	// 	global $wpdb;
	//
	// 	if ('delete' === $this->current_action())
	// 	{
	// 		if (isset($_GET['support_id']))
	// 		{
	// 			if (is_array($_GET['support_id']))
	// 			{
	// 				foreach ($_GET['support_id'] as $id)
	// 				{
	// 					if(!empty($id)) {
	//
	// 						wp_trash_post($id);
	//
	// 						$table = $this->table->createProregistrationTable();
	//
	// 						$wpdb->query("update $table set status = 0 WHERE id IN($id)");
	// 					}
	// 				}
	// 			}
	// 			else
	// 			{
	// 				if (!empty($_GET['support_id']))
	// 				{
	// 					$id=$_GET['support_id'];
	//
	// 					wp_trash_post($id);
	//
	// 					$table = $this->table->createProregistrationTable();
	//
	// 					$wpdb->query("update $table set status = 0 WHERE id =$id");
	// 				}
	// 			}
	// 		}
	// 	}
	// }
}

function supports_layout()
{
	$supports = new Supports();

	$supports->prepare_items();

	echo "<form method='post' class='product_support_from' action='".$_SERVER['PHP_SELF']."?page=cvm-supports'>";

	$supports->search_box('Search Products','search_support_id');

	echo "</form>";

	$supports->display();
}

supports_layout();



?>
</div>
