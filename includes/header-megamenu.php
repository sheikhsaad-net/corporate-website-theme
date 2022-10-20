<?php

$classes = array();
$cw = false;
$mm_width = get_post_meta($args['id'], 'megamenu_width', true);
$mm_pos = get_post_meta($args['id'], 'megamenu_custom_position', true);

if( $mm_width ) { 
	$classes[] = 'mfn-megamenu-'.$mm_width;

	if( $mm_width == 'custom-width' && get_post_meta($args['id'], 'megamenu_custom_width', true) ){
		$cw = 'style="width: '.get_post_meta($args['id'], 'megamenu_custom_width', true).'"';

		if( $mm_pos ){ 
			$classes[] = 'mfn-megamenu-pos-'.$mm_pos;
		}else{
			$classes[] = 'mfn-megamenu-pos-left';
		}

	}
}else{
	$classes[] = 'mfn-megamenu-full-width';
}

echo '<div class="mfn-menu-item-megamenu '.implode(' ', $classes).'" '.$cw.'>';

$mfn_header_builder = new Mfn_Builder_Front($args['id']);
$mfn_header_builder->show();

echo '</div>';
