<?php
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );



// Gallery Image Function and Hook
function philosophy_attachments_gallery($attachments){

  $post_id = null;
  if( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ){
    $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
  }
  if( ! $post_id || get_post_format( $post_id ) != 'gallery' ){
    return;
  }

    $fields = array(
       array(
           'name'      => 'title',
           'type'      => 'text',
           'label'     => __( 'Title', 'philosophy' ),
       ),
    );

    $args = array(
        'label'         => 'Gallery Image',
        'post_type'     => array( 'post', 'page'),
        'filetype'      => array("image"),
        'note'          => 'Add Gallery Images',
        'button_text'   => __( 'Attach Files', 'philosophy' ),
        'fields'        => $fields,
    );

    $attachments->register( 'gallery', $args );
}
add_action( 'attachments_register', 'philosophy_attachments_gallery' );



// Slider Function and Hook
function philosophy_attachments($attachments){
    $fields = array(
       array(
           'name'      => 'title',
           'type'      => 'text',
           'label'     => __( 'Title', 'philosophy' ),
       ),
    );

    $args = array(
        'label'         => 'Featured Slider',
        'post_type'     => array( 'post', 'page'),
        'filetype'      => array("image"),
        'note'          => 'Add Slider Images',
        'button_text'   => __( 'Attach Files', 'philosophy' ),
        'fields'        => $fields,
    );

    $attachments->register( 'slider', $args );
}
add_action( 'attachments_register', 'philosophy_attachments' );



// Testimonial Function and Hook
function philosophy_testimonial_attachments($attachments){
    $fields = array(
       array(
           'name'      => 'name',
           'type'      => 'text',
           'label'     => __( 'Name', 'philosophy' ),
       ),
       array(
           'name'      => 'position',
           'type'      => 'text',
           'label'     => __( 'Position', 'philosophy' ),
       ),
       array(
           'name'      => 'company',
           'type'      => 'text',
           'label'     => __( 'Company', 'philosophy' ),
       ),
       array(
           'name'      => 'testimonial',
           'type'      => 'textarea',
           'label'     => __( 'Testimonial', 'philosophy' ),
       ),
    );

    $args = array(

        'label'         => 'Testimonials',
        'post_type'     => array('page'),
        'filetype'      => array("image"),
        'note'          => 'Add Testimonial Image',
        'button_text'   => __( 'Attach Files', 'philosophy' ),
        'fields'        => $fields,
    );

    $attachments->register( 'testimonials', $args );
}
add_action( 'attachments_register', 'philosophy_testimonial_attachments' );



// Team Function and Hook
function philosophy_team_attachments($attachments){
    $fields = array(
       array(
           'name'      => 'name',
           'type'      => 'text',
           'label'     => __( 'Name', 'philosophy' ),
       ),
       array(
           'name'      => 'email',
           'type'      => 'text',
           'label'     => __( 'Email:', 'philosophy' ),
       ),
       array(
           'name'      => 'position',
           'type'      => 'text',
           'label'     => __( 'Position', 'philosophy' ),
       ),
       array(
           'name'      => 'company',
           'type'      => 'text',
           'label'     => __( 'Company', 'philosophy' ),
       ),
       array(
           'name'      => 'bio',
           'type'      => 'textarea',
           'label'     => __( 'Bio', 'philosophy' ),
       ),
    );

    $args = array(

        'label'         => 'Team Members',
        'post_type'     => array('page'),
        'filetype'      => array("image"),
        'note'          => 'Add Team Member',
        'button_text'   => __( 'Attach Files', 'philosophy' ),
        'fields'        => $fields,
    );

    $attachments->register( 'team', $args );
}
add_action( 'attachments_register', 'philosophy_team_attachments' );
