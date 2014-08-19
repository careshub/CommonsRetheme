/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function GoToPage(baseurl, priplace, page) {
  var newPage=baseurl + "?loc=" + priplace + "&pg=" + page;
  window.location=newPage;
}

jQuery(document).ready(function(){

		var pg = getParameterByName("pg");			
		var loc = getParameterByName("loc");
		var burl = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;		
		if (!pg) {
			GoToPage(burl,loc,'context');
		}
		jQuery('#pageselector').live( 'change', function() { 			
		window.location=jQuery('#pageselector').val();         
		});

});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



