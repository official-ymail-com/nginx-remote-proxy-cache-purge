jQuery(document).ready(function($) {
	var data = {
		'action': 'purge_cache_page',
		'current_url': nrpcp_object.current_url
	};
	jQuery.post(nrpcp_object.ajax_url, data, function(response) {
		
		//jQuery(videoElement).bind('contextmenu',function() { return false; });
	});
});