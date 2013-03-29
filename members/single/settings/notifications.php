<?php

/**
 * BuddyPress Notification Settings
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

			<?php do_action( 'bp_before_member_settings_template' ); ?>

			<!-- <div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div> --><!-- #item-nav -->

			<div id="item-body" role="main">

				<?php do_action( 'bp_before_member_body' ); ?>

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul class="nav-tabs">

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_member_plugin_options_nav' ); ?>

					</ul>
				</div><!-- .item-list-tabs -->

				<h3><?php _e( 'Email Notification', 'buddypress' ); ?></h3>

				<?php do_action( 'bp_template_content' ); ?>

				<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/notifications'; ?>" method="post" class="standard-form" id="settings-form">
					<p><?php _e( 'Send a notification by email when:', 'buddypress' ); ?></p>

					<?php do_action( 'bp_notification_settings' ); ?>

					<?php do_action( 'bp_members_notification_settings_before_submit' ); ?>

					<div class="submit">
						<input type="submit" name="submit" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto" />
					</div>

					<?php do_action( 'bp_members_notification_settings_after_submit' ); ?>

					<?php wp_nonce_field('bp_settings_notifications'); ?>

				</form>

				<?php do_action( 'bp_after_member_body' ); ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_settings_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'members-single' ); ?>

<?php get_footer( 'buddypress' ); ?>