<?php

function philosophy_google_map_ui() {
    $fields = array(
        array(
            'label'=>__('Place','philosophy'),
            'attr'=>'place',
            'type'=>'text',
            'meta'=>array(
                'placeholder'=>__('Place','philosophy')
            )
        ),array(
            'label'=>__('Width','philosophy'),
            'attr'=>'width',
            'type'=>'text',
        ),array(
            'label'=>__('Height','philosophy'),
            'attr'=>'height',
            'type'=>'text',
        ),array(
            'label'=>__('Zoom','philosophy'),
            'attr'=>'zoom',
            'type'=>'text',
        )
    );

    $settings = array(
        'label'=>__('Google Map','philosophy'),
        'listItemImage'=>'dashicons-admin-site',
        'post_type'=>array('post','page'),
        'attrs'=>$fields
    );

    shortcode_ui_register_for_shortcode('gmap',$settings);
}

add_action( 'register_shortcode_ui', 'philosophy_google_map_ui' );
