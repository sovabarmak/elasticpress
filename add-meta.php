<?php
add_filter( 'ep_prepared_post_meta', function($metas,$post){
	global $wpdb;
	if(!empty($post->post_type) && $post->post_type=='profile'){
		$fields =['profile_phone','extension','email','profile_image','profile_office_location','collection-profile_position','collection-profile_position_0_profile_position','collection-profile_position_1_profile_position','collection-profile_position_2_profile_position','collection-profile_position_3_profile_position'];
		$data = viv_get_meta($post->ID,$fields);
	
		$metas['phone']=$data['profile_phone'];
		$position='';
		if($data['collection-profile_position']){
			$position_ar=[];
			for($i=0;$i<$data['collection-profile_position'];$i++){
				$position_ar[] = $data['collection-profile_position_'.$i.'_profile_position'];
			}
			$position = implode(' ',$position_ar);
		}
		$metas['position']=$position;
		$metas['email']=$data['email'];
		$metas['location'] = $data['profile_office_location'];
		$image = $data['profile_image'];
		if(empty($image)){
			$img_url = "";
		}else{
			$img_url = viv_get_attachment_image_url($image);;
		}
		$metas['image'] = $img_url;
	}elseif(!empty($post->post_type) && in_array($post->post_type,['departments','offices','institutes','school'])){
		$fields = ['image','org_contact_phone','org_contact_email','org_contact_location'];
		$data = viv_get_meta($post->ID,$fields);
	
		$metas['phone']=$data['org_contact_phone'];
		$metas['email']=$data['org_contact_email'];
		$metas['location'] = $data['org_contact_location'];
		$image = $data['image'];
		if(empty($image)){
			$img_url = "";
		}else{
			$img_url = viv_get_attachment_image_url($image);;
		}
		$metas['image'] = $img_url;
		
	}elseif(!empty($post->post_type) && in_array($post->post_type,['program','program_graduate'])){
		$id=$post->ID;
		if($post->post_excerpt)
			$desc = $post->post_excerpt;
		else
			$desc = wp_trim_words( $post->post_content, 295, '' );
		$metas['desc'] = $desc;
		$item_link = get_the_permalink();
		$list_link = get_post_meta($id,'list_link',true);
		if($list_link)
			$item_link = $list_link;
		$metas['item_link'] = $item_link;
	}
	return $metas;
},10,2);