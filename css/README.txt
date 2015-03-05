CSS files ==================

All CSS files are created from LESS files via a Grunt task.

default.less contains much of the site styling and is the first file imported into the final CSS file.
800.less and such apply to specific responsive web design breakpoints in pixel widths.

bp-default.less is the first file imported into the BP section of the final CSS file.
bp-*.less are BuddyPress specific styles divided by RWD breakpoints.

ie.less is an IE7/8-specific stylesheet that leaves the media queries out.

navigation-*.less handles the primary navigation area. These rules are included in the main stylesheet "style.css". They are also compiled into navigation.css and navigation-ie.css for Yan's use on maps and assessments subdomains.

sa-*.less are the Salud America styles that will soon be moved out of the main stylesheet.

tunymce-editor-styles.less is used to apply some basic styles to the WP editor "Visual" view.

zenbox.less is used to style the zenbox tab.
