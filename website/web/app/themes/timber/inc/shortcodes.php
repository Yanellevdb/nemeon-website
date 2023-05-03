<?php
function markdownshortcode($atts, $content = null)
{
    $a = shortcode_atts(array(), $atts);
    return '<div class="code">' . $content . '</div>';
}
add_shortcode('code', 'markdownshortcode');


// function light_shortcode( $atts, $content = null) {
//   $a = shortcode_atts( array(
//   ), $atts );
// 	return '<span class="light">' . $content . '</span>';
// }
// add_shortcode( 'l', 'light_shortcode' );
// add_shortcode( 'light', 'light_shortcode' );
