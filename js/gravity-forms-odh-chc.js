jQuery(document).ready(function($){
	$(".gform_wrapper .disable input").attr('disabled','disabled');
	$( ".gf_ohio_question" ).css( "min-width", "300px" );	
	$( ".gf_ohio_entrybox" ).css( "min-width", "300px" );	
		
	var arrSec1 = new Array();
	for (var i=1; i < 23; i++) {
		arrSec1.push(i);	
	}
		
	var col1_tot = 0;
	var col2_tot = 0;
	var col3_tot = 0;
	var col4_tot = 0;
	var col5_tot = 0;	
		
	$.each( arrSec1, function( i, val ) {	
		if( !$("li.sec1_" + val + " input.small").val() ) {
			$("li.sec1_" + val + " input.small").val(0);
		}
		if ( !$("li.sec1_" + val + "_T input.small").val() ) {
			var ttl = parseInt($("li.sec1_" + val + "_1 input.small").val()) + parseInt($("li.sec1_" + val + "_2 input.small").val()) + parseInt($("li.sec1_" + val + "_3 input.small").val()) + parseInt($("li.sec1_" + val + "_4 input.small").val());
			$("li.sec1_" + val + "_T input.small").val(ttl);		
		}
		
		$("li.sec1_" + val + " input.small").blur(function() {
			var ttl = parseInt($("li.sec1_" + val + "_1 input.small").val()) + parseInt($("li.sec1_" + val + "_2 input.small").val()) + parseInt($("li.sec1_" + val + "_3 input.small").val()) + parseInt($("li.sec1_" + val + "_4 input.small").val());
			$("li.sec1_" + val + "_T input.small").val(ttl);		
		
			calcImpacted(val);
		});
		
	});
	
	$("li.sec1_19_3 input.small").trigger('blur');
	
	function calcImpacted(val) {
			if (val > 17 && val < 22) {
				col1_tot = parseInt($("li.sec1_18_1 input.small").val()) + parseInt($("li.sec1_19_1 input.small").val()) + parseInt($("li.sec1_20_1 input.small").val()) + parseInt($("li.sec1_21_1 input.small").val());
				col2_tot = parseInt($("li.sec1_18_2 input.small").val()) + parseInt($("li.sec1_19_2 input.small").val()) + parseInt($("li.sec1_20_2 input.small").val()) + parseInt($("li.sec1_21_2 input.small").val());
				col3_tot = parseInt($("li.sec1_18_3 input.small").val()) + parseInt($("li.sec1_19_3 input.small").val()) + parseInt($("li.sec1_20_3 input.small").val()) + parseInt($("li.sec1_21_3 input.small").val());
				col4_tot = parseInt($("li.sec1_18_4 input.small").val()) + parseInt($("li.sec1_19_4 input.small").val()) + parseInt($("li.sec1_20_4 input.small").val()) + parseInt($("li.sec1_21_4 input.small").val());
				col5_tot = parseInt($("li.sec1_18_T input.small").val()) + parseInt($("li.sec1_19_T input.small").val()) + parseInt($("li.sec1_20_T input.small").val()) + parseInt($("li.sec1_21_T input.small").val());
			}		
			
			$("li.sec1_eventQ1_T input.small").val(col1_tot);
			$("li.sec1_eventQ2_T input.small").val(col2_tot);
			$("li.sec1_eventQ3_T input.small").val(col3_tot);
			$("li.sec1_eventQ4_T input.small").val(col4_tot);
			$("li.sec1_eventAll_T input.small").val(col5_tot);	
	}
		

});