
	jQuery(document).ready(function($) {

		$('#tech_report_info').hide();
		$('#satra_report_info').hide();
	   	$('#tech_link').click(function(){
			
			$('#info').hide();
		    $('#tech_report_info').show();
			$('#satra_report_info').hide();
		});
		$('#satra_link').click(function(){
			$('#info').hide();
			$('#tech_report_info').hide();
			$('#satra_report_info').show();
		});
		$('#product_back_tech, #product_back_satra').click(function(){
			
			$('#tech_report_info').hide();
			$('#satra_report_info').hide();
			$('#info').show();
		});

	});

