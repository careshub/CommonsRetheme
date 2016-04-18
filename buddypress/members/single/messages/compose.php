<?php
/**
 * BuddyPress - Members Single Messages Compose
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

$check_recips = current_user_can( 'edit_sapoliciess' ) ? false : true;

if ( $check_recips ) {
	// Check to make sure that the user isn't going nuts, here.
	$user_id = bp_displayed_user_id();
	$args = array(
		'user_id'      => $user_id,
		'box'          => 'sentbox',
	);
	$threads = BP_Messages_Thread::get_current_threads_for_user( $args );

	// Count total recipients.
	$recipients = array();
	foreach ( $threads['threads'] as $thread ) {
		// We only want to count messages sent in the last 24 hours.
		// If this is older, we skip it.
		if ( ( strtotime( $thread->last_message_date ) - strtotime( '-1 days' ) ) < 0 ) {
			continue;
		}
		foreach ( $thread->recipients as $recipient ) {
			$recipients[] = $recipient->user_id;
		}
	}
	// remove dupes.
	$recipients = array_unique( $recipients );
	// remove sender.
	$recipients = array_diff( $recipients, array( $user_id ) );
}

if ( $check_recips && ( $threads['total'] > 4 || count( $recipients ) > 4 ) ) :
	?>
	<div id="message" class="error">
		<p>Hi there. We&rsquo;ve set a limit on how many messages a member can send in a day, and you&rsquo;ve hit it for today. Congrats! But you&rsquo;ll have to wait until tomorrow to send any more.</p>
	</div>
	<?php
else :
?>

<form action="<?php bp_messages_form_action('compose' ); ?>" method="post" id="send_message_form" class="standard-form" enctype="multipart/form-data">

	<?php

	/**
	 * Fires before the display of message compose content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_messages_compose_content' ); ?>

	<label for="send-to-input"><?php _e("Send To (Username or Friend's Name)", 'buddypress' ); ?></label>
	<ul class="first acfb-holder">
		<li>
			<?php bp_message_get_recipient_tabs(); ?>
			<input type="text" name="send-to-input" class="send-to-input" id="send-to-input" />
		</li>
	</ul>

	<?php if ( bp_current_user_can( 'bp_moderate' ) ) : ?>
		<p><label for="send-notice"><input type="checkbox" id="send-notice" name="send-notice" value="1" /> <?php _e( "This is a notice to all users.", "buddypress" ); ?></label></p>
	<?php endif; ?>

	<label for="subject"><?php _e( 'Subject', 'buddypress' ); ?></label>
	<input type="text" name="subject" id="subject" value="<?php bp_messages_subject_value(); ?>" />

	<label for="message_content"><?php _e( 'Message', 'buddypress' ); ?></label>
	<textarea name="content" id="message_content" rows="15" cols="40"><?php bp_messages_content_value(); ?></textarea>

	<input type="hidden" name="send_to_usernames" id="send-to-usernames" value="<?php bp_message_get_recipient_usernames(); ?>" class="<?php bp_message_get_recipient_usernames(); ?>" />

	<?php

	/**
	 * Fires after the display of message compose content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_messages_compose_content' ); ?>

	<div class="submit">
		<input type="submit" value="<?php esc_attr_e( "Send Message", 'buddypress' ); ?>" name="send" id="send" />
	</div>

	<?php wp_nonce_field( 'messages_send_message' ); ?>
</form>

<script type="text/javascript">
	document.getElementById("send-to-input").focus();
</script>

<?php endif; ?>

