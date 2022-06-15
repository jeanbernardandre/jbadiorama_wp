<?php
/* 
Plugin Name: Rest Api Tags
Plugin URI: 
Description: 
Version: 1.1
Author: JB André
Author URI: 
License: GPL2
Text Domain: 
*/


class My_Rest_Server extends WP_REST_Controller {

	function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );

	}

          //The namespace and version for the REST SERVER
	var $my_namespace = 'tags/v';
	var $my_version   = '1';

	public function register_routes() {
		$namespace = $this->my_namespace . $this->my_version;
		$base      = 'tag-post';
		register_rest_route( $namespace, '/' . $base, array(
			array(
				'methods'         => WP_REST_Server::READABLE, // pour GET. Consulter la liste pour les autres
				'callback'        => array( $this, 'get_taggs' ),
				//'permission_callback'   => array( $this, 'get_latest_post_permission' )
			)
		)  );
	}

	public function get_taggs ( $params ){

		$post_id = $params->get_param('post_id');
		$post = get_the_tags($post_id);

		return $post;
	}

}



$my_rest_server = new My_Rest_Server();
