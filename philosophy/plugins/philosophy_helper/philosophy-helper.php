<?php

/*
Plugin Name: Philosophy-Helper
Plugin URL:
Description: Helper plugin for philosophy theme
Version: 1.0
Author: Ringku Rahman
Author URI:
License: GPLv2 or later
Text Domain: philosophy_helper
*/


// Google Map File
require_once dirname(__FILE__) . "/gmap_ui.php";


// Custom Post CPT Function
function philosophy_helper_register_my_cpts_book() {

	/**
	 * Post Type: Books.
	 */

	$labels = [
		"name" => __( "Books", "philosophy" ),
		"singular_name" => __( "Book", "philosophy" ),
		"menu_name" => __( "Books", "philosophy" ),
		"all_items" => __( "My Books", "philosophy" ),
		"add_new" => __( "New Book", "philosophy" ),
		"featured_image" => __( "Book Cover", "philosophy" ),
		"set_featured_image" => __( "Book Cover Image", "philosophy" ),
		"item_updated" => __( "Your Book Updated", "philosophy" ),
	];

	$args = [
		"label" => __( "Books", "philosophy" ),
		"labels" => $labels,
		"description" => "This is books and chapter menu",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "books",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "book", "with_front" => false ],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-book",
		"supports" => [ "title", "editor", "thumbnail", "author" ],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "book", $args );
}

add_action( 'init', 'philosophy_helper_register_my_cpts_book' );
//-----------------------------------
function philosophy_register_my_cpts() {

	/**
	 * Post Type: Books.
	 */

	$labels = [
		"name" => __( "Books", "philosophy" ),
		"singular_name" => __( "Book", "philosophy" ),
		"menu_name" => __( "Books", "philosophy" ),
		"all_items" => __( "My Books", "philosophy" ),
		"add_new" => __( "New Book", "philosophy" ),
		"featured_image" => __( "Book Cover", "philosophy" ),
		"set_featured_image" => __( "Book Cover Image", "philosophy" ),
		"item_updated" => __( "Your Book Updated", "philosophy" ),
	];

	$args = [
		"label" => __( "Books", "philosophy" ),
		"labels" => $labels,
		"description" => "This is books and chapter menu",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "books",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "book/%genre%", "with_front" => false ],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-book",
		"supports" => [ "title", "editor", "thumbnail", "author" ],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "book", $args );

	/**
	 * Post Type: Chapters.
	 */

	$labels = [
		"name" => __( "Chapters", "philosophy" ),
		"singular_name" => __( "Chapter", "philosophy" ),
	];

	$args = [
		"label" => __( "Chapters", "philosophy" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "book/%book%/chapter", "with_front" => false ],
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "dashicons-welcome-write-blog",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "chapter", $args );
}

add_action( 'init', 'philosophy_register_my_cpts' );



function philosophy_register_my_taxes() {

	/**
	 * Taxonomy: Languages.
	 */

	$labels = [
		"name" => __( "Languages", "philosophy" ),
		"singular_name" => __( "Language", "philosophy" ),
	];


	$args = [
		"label" => __( "Languages", "philosophy" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => '/books/language', 'with_front' => false, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "language",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "language", [ "book" ], $args );

	/**
	 * Taxonomy: Genre.
	 */

	$labels = [
		"name" => __( "Genre", "philosophy" ),
		"singular_name" => __( "Genre", "philosophy" ),
	];


	$args = [
		"label" => __( "Genre", "philosophy" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'genre', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "genre",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "genre", [ "book" ], $args );
}
add_action( 'init', 'philosophy_register_my_taxes' );




// Short Code Button
function philosophy_button( $attributes ) {

    $default = array(
        'type'=>'primary',
        'title'=>__("Button",'philosophy'),
        'url'=>'',
    );

    $button_attributes = shortcode_atts($default,$attributes);


    return sprintf( '<a target="_blank" class="btn btn--%s full-width" href="%s">%s</a>',
        $button_attributes['type'],
        $button_attributes['url'],
        $button_attributes['title']
    );
}

add_shortcode( 'button', 'philosophy_button' );



// Short Code Button 2
function philosophy_button2( $attributes, $content='' ) {
    $default = array(
        'type'=>'primary',
        'title'=>__("Button",'philosophy'),
        'url'=>'',
    );

    $button_attributes = shortcode_atts($default,$attributes);


    return sprintf( '<a target="_blank" class="btn btn--%s full-width" href="%s">%s</a>',
        $button_attributes['type'],
        $button_attributes['url'],
        do_shortcode($content)
    );
}

add_shortcode( 'button2', 'philosophy_button2' );



// Short Code Text Uppercase
function philosophy_uppercase($attributes, $content=''){
    return strtoupper(do_shortcode($content));
}
add_shortcode('uc','philosophy_uppercase');



// Short Code Google Map
function philosophy_google_map($attributes){
    $default = array(
        'place'=>'Dhaka Museum',
        'width'=>'800',
        'height'=>'500',
        'zoom'=>'14'
    );

    $params = shortcode_atts($default,$attributes);

    $map = <<<EOD
<div>
    <div>
        <iframe width="{$params['width']}" height="{$params['height']}"
                src="https://maps.google.com/maps?q={$params['place']}&t=&z={$params['zoom']}&ie=UTF8&iwloc=&output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
        </iframe>
    </div>
</div>
EOD;

    return $map;

}
add_shortcode('gmap','philosophy_google_map');
