jQuery(document).ready(function($) {
	jQuery('#wp-admin-bar-nrpcp_purge_page').click(function(){
		var data = {
			'_ajax_nonce': nrpcp_object.nonce,
			'action': 'purge_cache_page',
			'current_url': nrpcp_object.current_url
		};
		jQuery.post(nrpcp_object.ajax_url, data, function(response) {
			console.log(response);
			//jQuery(videoElement).bind('contextmenu',function() { return false; });
		});
		
	});
});