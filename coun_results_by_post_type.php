<?php
if(!empty($wp_query->query_vars['ep_aggregations']['terms']['post_type']['buckets'])){
	foreach($wp_query->query_vars['ep_aggregations']['terms']['post_type']['buckets'] as $p){
		$count_arr[$p['key']]=$p['doc_count'];
	}
}