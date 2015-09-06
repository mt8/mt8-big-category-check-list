<?php
/*
	Plugin Name: Mt8 Big Category Check List
	Plugin URI: https://github.com/mt8/mt8-big-category-check-list
	Description: Big Category Check List On Post Pages.
	Author: mt8.biz
	Version: 1.0.0
	Author URI: http://mt8.biz
	Domain Path: /languages
	Text Domain: mt8-big-category-check-list
*/	

	$mt8_bccl = new Mt8_Big_Category_Check_List();
	$mt8_bccl->register_hooks();

	class Mt8_Big_Category_Check_List {

		const TEXT_DOMAIN = 'mt8-big-category-check-list';

		public $allow_taxonomies = array();
		
		public function __construct() {

			$this->allow_taxonomies = array( 'category' );
			
		}

		public function register_hooks() {
			
			add_action( 'plugins_loaded', array( &$this, 'plugins_loaded' ) );
			add_action( 'admin_print_styles-post.php', array( &$this, 'admin_print_styles_on_post_page' ), 10 );
			add_action( 'admin_print_styles-post-new.php', array( &$this, 'admin_print_styles_on_post_page' ), 10 );
			
		}
		
		public function plugins_loaded() {
			
			load_plugin_textdomain( self::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
			
		}
		
		public function admin_print_styles_on_post_page() {
			
			$this->allow_taxonomies = apply_filters( 'mt8-big-category-check-list-allow-taxonomies', array( 'category' ) );			
			
			?>
<style type="text/css">
/* Output By Mt8 Big Category Check List */
			<?php foreach ( $this->allow_taxonomies as $taxonomy ) : ?>
				<?php if ( ! taxonomy_exists( $taxonomy ) ) continue; ?>
				#<?php echo esc_html( $taxonomy ) ?>-all { max-height: none;}
			<?php endforeach; ?>
</style>
			<?php
		}
		
	}

