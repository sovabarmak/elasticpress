<?php
function exclude_post_types_from_indexing( $post_types ) {

unset($post_types['outcomes']);
unset($post_types['tribe_venue']);
unset($post_types['tribe_organizer']);
unset($post_types['menus']);
unset($post_types['affordability']);

return $post_types;
}
add_filter( 'ep_indexable_post_types', 'exclude_post_types_from_indexing' );