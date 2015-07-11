<?php
/*
Plugin Name: CPT Template Path
Description: Adds Custom Post Type slug as folder path in template hierarchy.
Version: 0.1
Author: Dinesh Kesarwani
Author URL: http://cyberwani.wordpress.com
*/

if ( !class_exists('DMK_Register_Custom_Template') ) {
	
	class DMK_Register_Custom_Template {
	
		private $my_post;
		private $post_type = '';
		
		public function __construct() {
			
			
			$this->add_filters();
		}
		
		public function add_filters() {
			
			add_filter( 'template_include', array($this, 'template_include') );
			
		}
		
		public function template_include( $template ) {
			$this->post_type = get_query_var('post_type');
			
			if ( is_single() ) {
				if ( $single = locate_template( array( $this->post_type.'/single.php') ) ){
					return $single;
				}
			} else {
				return locate_template( array(
					$this->post_type . '/index.php',
					$this->post_type . '.php', 
					'index.php' 
				));
			}
			return $template;
		}
	} // end DMK_Register_Custom_Template class
	
	$custom_temp = new DMK_Register_Custom_Template();
}