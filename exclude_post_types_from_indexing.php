<?php
add_filter( 'ep_indexable_post_types', function( $post_types ) {
	unset($post_types['outcomes']);
	unset($post_types['tribe_venue']);
	unset($post_types['tribe_organizer']);
	unset($post_types['menus']);
	unset($post_types['affordability']);
	return $post_types;
});