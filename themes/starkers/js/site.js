
	jQuery(document).ready(function($) {

		$('#tech_report_info').hide();
	   	$('#tech_report a').click(function(){
			event.preventDefault();
			$('#info').hide();
		    $('#tech_report_info').show();
		});
		$('#product_back').click(function(){
			event.preventDefault();
			 $('#tech_report_info').hide();
			$('#info').show();
		});

	});

