
	jQuery(document).ready(function($) {

		$('#tech_report_info').hide();
	   	$('#tech_report a').click(function(){
			
			$('#info').hide();
		    $('#tech_report_info').show();
		});
		$('#product_back').click(function(){
			
			 $('#tech_report_info').hide();
			$('#info').show();
		});

	});

