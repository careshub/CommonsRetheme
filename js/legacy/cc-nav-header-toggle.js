jQuery(document).ready(function() {
	function showLogin() {
		// jQuery("#login-item").addClass('toggled');
		// jQuery("#login-item .pop-sub-wrapper").addClass('toggled');
		// jQuery("#sidebar-user-login").focus();

	}
	function hideLogin() {
	// if both username and pw are empty, let the box close onMouseOut
		// if ( (jQuery('#sidebar-user-login').val() === '') && (jQuery('#sidebar-user-pass').val() === '') ) {
				// jQuery("#login-item").removeClass('toggled');
				// jQuery("#login-item .pop-sub-wrapper").removeClass('toggled');
				// jQuery("#sidebar-user-login").blur();

		// }

	}

	jQuery('#menu-toggler').click(function(){
		jQuery(".nav-container").toggleClass('open');
			return false;
	});

	//JS to show login form on hover
	var config = {
		over: showLogin, // function = onMouseOver callback (REQUIRED)    
		timeout: 500, // number = milliseconds delay before onMouseOut    
		out: hideLogin // function = onMouseOut callback (REQUIRED)    
	};

	// jQuery("#login-item").hoverIntent( config );

	//JS to close login form via cancel button
	jQuery('#cancel-login').click(function(){
		// jQuery("#login-item").removeClass('toggled');
		// jQuery("#login-item .pop-sub-wrapper").removeClass('toggled');
			// return false;
	});


});