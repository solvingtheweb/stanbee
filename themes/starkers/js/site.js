
	jQuery(document).ready(function($) {

		$('#satra_test_results').hide();
		$('#product_data_sheets').hide();
	   	$('#satra_test_results_link').click(function(){
			
			$('#info').hide();
		    $('#satra_test_results').show();
			$('#product_data_sheets').hide();
		});
		$('#product_data_sheets_link').click(function(){
			$('#info').hide();
			$('#satra_test_results').hide();
			$('#product_data_sheets').show();
		});
		$('#product_back_tech, #product_back_satra').click(function(){
			
			$('#tech_report_info').hide();
			$('#satra_report_info').hide();
			$('#info').show();
		});

	});

