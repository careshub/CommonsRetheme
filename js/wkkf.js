/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function GoToPage(baseurl, priplace, page) {
  var newPage=baseurl + "?loc=" + priplace + "&pg=" + page;
  window.location=newPage;
}

jQuery(document).ready(function(){
	
	      jQuery('#pageselector').live( 'change', function() {           
            window.location=jQuery('#pageselector').val();         
          });
});

