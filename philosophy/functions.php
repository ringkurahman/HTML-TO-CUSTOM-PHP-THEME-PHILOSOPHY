<?php


require_once get_theme_file_path( '/inc/tgm.php' );
require_once get_theme_file_path( '/inc/attachments.php' );
require_once get_theme_file_path( '/inc/cmb2-attached-posts.php' );
require_once get_theme_file_path( '/lib/csf/cs-framework.php' );
require_once get_theme_file_path( '/inc/cs.php' );
require_once get_theme_file_path( '/inc/customizer.php' );
require_once( get_theme_file_path( "/widgets/social-icons-widget.php" ) );

// Codestar Framework Light Theme
define( 'CS_ACTIVE_LIGHT_THEME', true );


// Fix Content Width Issue
if ( ! isset( $content_width ) ) {
    $content_width = 960;
}


// For Development Prevent Caching
if ( site_url() == "http://philosophy.local/" ) {
    define( "VERSION", time() );
} else {
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}


// Basic configuration for Theme
function philosophy_theme_setup(){
  load_theme_textdomain( "philosophy", get_theme_file_path( "/languages" ) );
  add_theme_support("post-thumbnails");

    $philosophy_custom_logo = array(
    'width' =>'100px',
    'height' =>'100px'
  );
  add_theme_support("custom-logo", $philosophy_custom_logo);
    $philosophy_custom_header = array(
    'header-text' => true,
    'default-text-color' => '#222',
    'width' => 1200,
    'height' => 600,
    'flex-height' => true,
  );
  add_theme_support("custom-header", $philosophy_custom_header);
  add_theme_support("custom-background");
  add_theme_support("title-tag");
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array( 'search-form', 'comment-list' ) );
  add_theme_support("post-formats", array("image", "gallery", "quote", "audio", "video", "link"));
  add_editor_style("/assets/css/editor-style.css");

  // Register Menu
  register_nav_menu( "topmenu", __( "Top Menu", "philosophy" ) );
  register_nav_menus(array(
       "footer-left"=>__("Footer Left Menu","philosophy"),
       "footer-middle"=>__("Footer Middle Menu","philosophy"),
       "footer-right"=>__("Footer Right Menu","philosophy"),
    ));

  // Register Image Size
  add_image_size("philosophy-home-square",400,400,true);

}
add_action("after_setup_theme", "philosophy_theme_setup");


// Load style and script files
function philosophy_assets(){
  wp_enqueue_style( "fontawesome-css", get_theme_file_uri("/assets/css/font-awesome/css/font-awesome.css"), null, "1.0" );
  wp_enqueue_style( "fonts-css", get_theme_file_uri("/assets/css/fonts.css"), null, "1.0" );
  wp_enqueue_style( "base-css", get_theme_file_uri("/assets/css/base.css"), null, "1.0" );
  wp_enqueue_style( "vendor-css", get_theme_file_uri("/assets/css/vendor.css"), null, "1.0" );
  wp_enqueue_style( "main-css", get_theme_file_uri("/assets/css/main.css"), null, "1.0" );
  wp_enqueue_style( "philosophy-css", get_stylesheet_uri(), null, VERSION );

  wp_enqueue_script( "modernizr-js", get_theme_file_uri("/assets/js/modernizr.js"), null, "1.0" );
  wp_enqueue_script( "pace-js", get_theme_file_uri("/assets/js/pace.min.js"), null, "1.0" );
  wp_enqueue_script( "plugins-js", get_theme_file_uri("/assets/js/plugins.js"), array( "jquery" ), "1.0", true );
  if ( is_singular() ) {
        wp_enqueue_script( "comment-reply" );
    }
  wp_enqueue_script( "main-js", get_theme_file_uri("/assets/js/main.js"), array( "jquery" ), VERSION, true );

}
add_action("wp_enqueue_scripts", "philosophy_assets");


// Pagination
function philosophy_pagination() {
    global $wp_query;
    $links = paginate_links( array(
        'current'  => max( 1, get_query_var( 'paged' ) ),
        'total'    => $wp_query->max_num_pages,
        'type'     => 'list',
        'mid_size' => apply_filters( "philosophy_pagination_mid_size", 3 )
    ) );
    $links = str_replace( "page-numbers", "pgn__num", $links );
    $links = str_replace( "<ul class='pgn__num'>", "<ul>", $links );
    $links = str_replace( "next pgn__num", "pgn__next", $links );
    $links = str_replace( "prev pgn__num", "pgn__prev", $links );
    echo wp_kses_post( $links );
}

// Filter Hook for Pagination
function pagination_mid_size( $size ) {
    return 2;
}

add_filter( "philosophy_pagination_mid_size", "pagination_mid_size" );



// Remove Category Description Tag
remove_action("term_description","wpautop");



// Widgets Area Register
function philosophy_widgets(){
    register_sidebar( array(
        'name' => __( 'About Us Page', 'philosophy' ),
        'id' => 'about-us',
        'description' => __( 'Widgets in this area will be shown on about us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Contact Page Information Section', 'philosophy' ),
        'id' => 'contact-info',
        'description' => __( 'Widgets in this area will be shown on contact page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Before Footer Left Section', 'philosophy' ),
        'id'            => 'before-footer-right',
        'description'   => __( 'before footer section, right side', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Before Footer Right Section', 'philosophy' ),
        'id'            => 'footer-right',
        'description'   => __( 'footer section, right side', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Header Section', 'philosophy' ),
        'id'            => 'header-section',
        'description'   => __( 'Widgets in this area will be shown on header section.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action("widgets_init","philosophy_widgets");



// Action Hook for Homepage Category Visit Count
function beginning_category_page( $category_title ) {
    if ( "New" == $category_title ) {
        $visit_count = get_option( "category_new" );
        $visit_count = $visit_count ? $visit_count : 0;
        $visit_count ++;
        update_option( "category_new", $visit_count );
    }
}

add_action( "philosphy_category_page", "beginning_category_page" );



// Filter Hook for Homepage Banner Class
function philosophy_home_banner_class( $class_name ) {
    if ( is_home() ) {
        return $class_name;
    } else {
        return "";
    }
}

add_filter( "philosophy_home_banner_class", "philosophy_home_banner_class" );




// Filter Hook for Text Uppercase
function uppercase_text( $param1, $param2, $param3 ) {
    return ucwords( $param1 ) . " " . strtoupper( $param2 ) . " " . ucwords( $param3 );
}

add_filter( "philosophy_text", "uppercase_text", 10, 3 );



// Plugable Function
if(!function_exists("philosophy_search_form")){

// Filter Hook for Search Form
function philosophy_search_form( $form ) {
    $homedir      = home_url( "/" );
    $label        = __( "Search for:", "philosophy" );
    $button_label = __( "Search", "philosophy" );
    $post_type    = <<<PT
<input type="hidden" name="post_type" value="post">
PT;

    if(is_post_type_archive('book')){
        $post_type    = <<<PT
<input type="hidden" name="post_type" value="book">
PT;
    };

    $newform      = <<<FORM
    <form role="search" method="get" class="header__search-form" action="{$homedir}">
        <label>
            <span class="hide-content">{$label}</span>
            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s"
                title="{$label}" autocomplete="off">
        </label>
        {$post_type}
        <input type="submit" class="search-submit" value="{$button_label}">
    </form>
FORM;

    return $newform;

}

}
add_filter( "get_search_form", "philosophy_search_form" );



// highlight Search Result
function philosophy_highlight_search_results($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'philosophy_highlight_search_results');
add_filter('the_excerpt', 'philosophy_highlight_search_results');
add_filter('the_title', 'philosophy_highlight_search_results');



// Remove ACF Tab from Admin Panel
/**
 * add_filter("acf/settings/show_admin", "__return_false");
 */



 // CPT Relation with Parent and Child
 function philosophy_cpt_chapter_slug_fix($post_link, $id){
    $cpt_post = get_post($id);

    // Chapter URL Replace
    if( is_object( $cpt_post ) && 'chapter' == get_post_type( $id )){
        $cpt_parent_post_id = get_field('parent_book');
        $cpt_parent_post = get_post($cpt_parent_post_id);

        if( $cpt_parent_post ){
            $post_link = str_replace( "%book%", $cpt_parent_post->post_name,$post_link);
        }
    }

    // Book URL Replace
    if(is_object($cpt_post) && 'book'==get_post_type($cpt_post)){
        $genre = wp_get_post_terms($cpt_post->ID,'genre');
        if(is_array($genre) && count($genre) > 0){
            $slug = $genre[0]->slug;
            $post_link = str_replace( "%genre%", $slug, $post_link);
        }else{
            $slug = "generic";
            $post_link = str_replace( "%genre%", $slug, $post_link);
        }
    }

    return $post_link;
 }
add_filter("post_type_link", "philosophy_cpt_chapter_slug_fix",1,2);



// Conditionally Load Footer Tags and Languages
function philosophy_footer_language_heading( $title ) {
    if ( is_post_type_archive( 'book' ) || is_tax('language') ) {
        $title = __( 'Languages', 'philosophy' );
    }

    return $title;
}

add_filter( 'philosophy_footer_tag_heading', 'philosophy_footer_language_heading' );

function philosophy_footer_language_terms( $tags ) {
    if ( is_post_type_archive( 'book' ) || is_tax('language') ) {
        $tags = get_terms( array(
            'taxonomy'   => 'language',
            'hide_empty' => true
        ) );
    }
    return $tags;
}

add_filter( 'philosophy_footer_tag_items', 'philosophy_footer_language_terms' );


