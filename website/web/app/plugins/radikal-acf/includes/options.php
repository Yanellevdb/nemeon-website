<?php

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}

if( function_exists('acf_add_local_field_group') ):

    $options = TRUE;
    $optionsGroup = '';

    $test = TRUE;
    $testGroup = '';

    // if ( $options ){
    //     $optionsGroup = require plugin_dir_path( __FILE__ ) . 'acf_groups/options.php';
    //     acf_add_local_field_group($optionsGroup);
    // }

    // if ( $test ){
    //     $testGroup = require plugin_dir_path( __FILE__ ) . 'acf_groups/test.php';
    //     acf_add_local_field_group($testGroup);
    // }

    endif;