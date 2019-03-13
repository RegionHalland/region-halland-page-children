<?php

	/**
	 * @package Region Halland Page Children
	 */
	/*
	Plugin Name: Region Halland Page Children
	Description: Front-end-plugin som returnerar Page Children
	Version: 1.1.0
	Author: Roland Hydén
	License: MIT
	Text Domain: regionhalland
	*/

	// Returnera alla page children till en post
	function get_region_halland_page_children($ID = 0) 
	{
		
		// Kolla vilket id som ska användas
		if ($ID == 0) {

			// Wordpress funktion för aktuell post
			global $post;

			// ID för aktuell post
			$myID = $post->ID;

		} else {

			// Använd det ID som funktionen anropas med
			$myID = $ID;

		}
		
		// Argument
		$args = array( 
			'parent' => $myID,
			'hierarchical' => 0,
			'sort_column' => 'menu_order', 
			'sort_order' => 'asc'
		);

		// Hämta valda sidor
		$pages = get_pages($args);

		// Loopa igenom alla sidor
		foreach ($pages as $page) {

			if ($page->ID === $myID) {
				$page->is_current = true;
			}

			// Hämta bara om Modularity är installerad
			if(function_exists('get_field')) {
				$page->acf_excerpt = get_field('excerpt', $page->ID);
			}

			// Sidans url
			$page->url = get_page_link($page->ID);
			
			// Utvald bild
			$page->image = get_the_post_thumbnail($page->ID);
			$page->image_url = get_the_post_thumbnail_url($page->ID);
		}

		// Returnera alla sidor
		return $pages;

	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_page_children_activate() {
		// Ingenting just nu...
	}

	// Metod som anropas när pluginen avaktiveras
	function region_halland_page_children_deactivate() {
		// Ingenting just nu...
	}
	
	// Vilken metod som ska anropas när pluginen aktiveras
	register_activation_hook( __FILE__, 'region_halland_page_children_activate');
	
	// Vilken metod som ska anropas när pluginen avaktiveras
	register_deactivation_hook( __FILE__, 'region_halland_page_children_deactivate');

?>