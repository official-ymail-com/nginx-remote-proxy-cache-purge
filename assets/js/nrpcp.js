jQuery(document).ready(function($) {
	jQuery('#wp-admin-bar-nrpcp_purge_page a, #wp-admin-bar-nrpcp_purge_all a').click(function(event){
		event.preventDefault();
		var data = {
			'_ajax_nonce': nrpcp_object.nonce,
			'action': 'purge_cache_page',
			'url': $(this).attr('href')
		};
		jQuery.post(nrpcp_object.ajax_url, data, function(response) {
			//console.log(response);
			if(response == '1'){
				jQuery('#nrpcp_message').fadeIn( 500 );
				jQuery('#nrpcp_message').fadeOut( 500 );
			}
		});
	});
});