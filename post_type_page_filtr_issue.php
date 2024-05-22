<?php
add_action( 'pre_get_posts',function( \WP_Query $query ) {
    if(!is_admin()){
        if($query->is_main_query() && $query->is_search()){
            if(isset($_GET['post_type']) && $_GET['post_type']){
				$query->set('post_type',$_GET['post_type']);
            }
        }
    }
    return $query;
});