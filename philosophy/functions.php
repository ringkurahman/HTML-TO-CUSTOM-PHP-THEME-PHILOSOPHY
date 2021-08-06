<?php


require_once get_theme_file_path( '/inc/tgm.php' );
require_once get_theme_file_path( '/inc/attachments.php' );
require_once get_theme_file_path( '/inc/customizer.php' );
require_once( get_theme_file_path( "/widgets/social-icons-widget.php" ) );


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



// Action Hook for Category Before Title1
function category_before_title1() {
    echo "<p>Before Title 1</p>";
}

add_action( "philosphy_before_category_title", "category_before_title1" );



// Action Hook for Category Before Title2
function category_before_title2() {
    echo "<p>Before Title 2</p>";
}

add_action( "philosphy_before_category_title", "category_before_title2", 4 );



// Action Hook for Category Before Title3
function category_before_title3() {
    echo "<p>Before Title 3</p>";
}

add_action( "philosphy_before_category_title", "category_before_title3", 9 );



// Action Hook for Category After Title
function category_after_title() {
    echo "<p>After Title</p>";
}

add_action( "philosphy_after_category_title", "category_after_title" );



// Action Hook for Category After Description
function category_after_desc() {
    echo "<p>After Description</p>";
}

add_action( "philosphy_after_category_description", "category_after_desc" );



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



// Password Protected Post Description
function philosophy_the_excerpt($excerpt){
  if(!post_password_required()){
    return $excerpt;
  }else {
    echo get_the_password_form();
  }
}
add_filter("the_excerpt","philosophy_the_excerpt");



// Password Protected Post Title
function philosophy_protected_title_change(){
  return "%s";
}
add_filter("protected_title_format","philosophy_protected_title_change");



// Top Menu List Item Class Add
function philosophy_menu_item_class($classes, $item, $args){
  if ( 'topmenu' === $args->theme_location ) {
        $classes[] = 'list-inline-item';
    }
  return $classes;
}
add_filter("nav_menu_css_class","philosophy_menu_item_class", 10, 3);



// Load Custom Header Background Image on Head
function philosophy_page_template_background(){
  if ( is_page() ) {
            $philosophy_feat_image = get_the_post_thumbnail_url( null, "large" );
            ?>
            <style>
                .page-header {
                    background-image: url(<?php echo esc_html($philosophy_feat_image);?>);
                }
            </style>
            <?php
        }
  if ( is_front_page() ) {
            if ( current_theme_supports( "custom-header" ) ) {
                ?>
                <style>
                    .header {
                        background-image: url(<?php header_image();?>);
                        background-size: cover;
                        margin-bottom: 50px;
                    }

                    .header h1.heading a, h3.tagline {
                        color: #<?php echo get_header_textcolor();?>;

                    <?php
                    if(!display_header_text()){
                        echo "display: none;";
                    }
                    ?>
                    }

                </style>
                <?php
            }
        }
}
add_action("wp_head","philosophy_page_template_background", 11);



// Modify WordPress Default Query
function philosophy_modify_main_query($wpq){
  if( is_home() && $wpq->is_main_query() ){
    // Remove Post By ID
      $wpq->set("post__not_in", array(33));
      // Remove Post By Tag ID
      $wpq->set("tag__not_in", array(13));
      // Remove Post By Category ID
      $wpq->set("category__not_in", array(13));
  }
}
add_action("pre_get_posts","philosophy_modify_main_query");



// Remove ACF Tab from Admin Panel
/**
 * add_filter("acf/settings/show_admin", "__return_false");
 */

