<?php

	/**
	 * @package Region Halland Page Children
	 */
	/*
	Plugin Name: Region Halland Page Children
	Description: Front-end-plugin som returnerar Page Children
	Version: 1.0.0
	Author: Roland Hydén
	License: Free to use
	Text Domain: region_halland_page_children
	*/

	// Returnera alla page children till en post
	function get_region_halland_page_children()
	{
		global $post;
		
		$args = array( 
			'child_of' => $post->ID,
			'parent' => $post->ID,
			'hierarchical' => 0,
			'sort_column' => 'menu_order', 
			'sort_order' => 'asc'
		);
		$pages = get_pages($args);

		foreach ($pages as $page) {

			if ($page->ID === $post->ID) {
				$page->is_current = true;
			}

			// Hämta bara om Modularity är installerad
			if(function_exists('get_field')) {
				$page->acf_excerpt = get_field('excerpt', $page->ID);
			}
			$page->url = get_page_link($page->ID);
		}

		return $pages;
	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_page_children_activate() {
		// Nothing at the moment
	}

	// Metod som anropas när pluginen avaktiveras
	function region_halland_page_children_deactivate() {
		// Nothing at the moment
	}
	
	// Vilken metod som ska anropas när pluginen aktiveras
	register_activation_hook( __FILE__, 'region_halland_page_children_activate');
	
	// Vilken metod som ska anropas när pluginen avaktiveras
	register_deactivation_hook( __FILE__, 'region_halland_page_children_deactivate');