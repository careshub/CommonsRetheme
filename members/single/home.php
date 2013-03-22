<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>
	<div id="item-header" role="complementary">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->
	<div id="secondary" class="widget-area" role="complementary">
		<!-- <div id="profile-sidebar"> -->
			
			<!-- <div id="item-buttons">

				<?php do_action( 'bp_member_header_actions' ); ?>

			</div> --><!-- #item-buttons -->

			<!-- 	<?php /* Show Quick Menu for own Profile page */ if ( bp_is_my_profile() ) : ?>
		    <div id="profile-nav-menu">
		        <?php $userLink = bp_get_loggedin_user_link();?>
		        <ul>
		            <li id="edit-profile">
		            	<a class="button edit-profile-button" href="<?php echo $userLink; ?>profile/edit">Edit My Profile</a>
		            </li>
		            <li id="edit-avatar">
		            	<a class="button edit-avatar-button" href="<?php echo $userLink; ?>profile/change-avatar">Change Avatar</a>
		            </li>
		            <li id="edit-password">
		            	<a class="button edit-password-button" href="<?php echo $userLink; ?>settings">Email/Password settings</a>
		            </li>
		            <li id="edit-notifications">
		            	<a class="button edit-notifications-button" href="<?php echo $userLink; ?>settings/notifications/">Notification Settings</a>
		            </li>
		        </ul>
		    </div>  
			<?php endif; ?> -->
		<!-- </div> -->
		<!-- Profile Tabs -->
		<div class="sidebar-activity-tabs no-ajax" id="object-nav" role="navigation">
			<ul class="">
				<?php bp_get_displayed_user_nav(); ?>
			</ul>
		</div>
	</div> <!-- End #secondary -->
	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ); ?>

			<!-- <div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div> --><!-- #item-nav -->

			<div id="item-body">

				<?php do_action( 'bp_before_member_body' );

				if ( bp_is_user_activity() || !bp_current_component() ) :
					locate_template( array( 'members/single/activity.php'  ), true );

				 elseif ( bp_is_user_blogs() ) :
					locate_template( array( 'members/single/blogs.php'     ), true );

				elseif ( bp_is_user_friends() ) :
					locate_template( array( 'members/single/friends.php'   ), true );

				elseif ( bp_is_user_groups() ) :
					locate_template( array( 'members/single/groups.php'    ), true );

				elseif ( bp_is_user_messages() ) :
					locate_template( array( 'members/single/messages.php'  ), true );

				elseif ( bp_is_user_profile() ) :
					locate_template( array( 'members/single/profile.php'   ), true );

				elseif ( bp_is_user_forums() ) :
					locate_template( array( 'members/single/forums.php'    ), true );

				elseif ( bp_is_user_settings() ) :
					locate_template( array( 'members/single/settings.php'  ), true );

				// If nothing sticks, load a generic template
				else :
					locate_template( array( 'members/single/plugins.php'   ), true );

				endif;

				do_action( 'bp_after_member_body' ); ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'members-single' ); ?>
<?php get_footer( 'buddypress' ); ?>
