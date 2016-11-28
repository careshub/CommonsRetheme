<?php
/**
 * BuddyPress email template.
 *
 * Magic numbers:
 *  1.618 = golden mean.
 *  1.35  = default body_text_size multipler. Gives default heading of 20px.
 *
 * @since 2.5.0
 *
 * @package BuddyPress
 * @subpackage Core
 */

/*
Based on the Cerberus "Fluid" template by Ted Goas (http://tedgoas.github.io/Cerberus/).
License for the original template:


The MIT License (MIT)

Copyright (c) 2013 Ted Goas

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$settings = bp_email_get_appearance_settings();

?><!-- Email Body : BEGIN -->
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="<?php echo esc_attr( $settings['body_bg'] ); ?>" width="100%" class="body_bg">

	<!-- 1 Column Text : BEGIN -->
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			  <tr>
					<td style="padding: 20px; font-family: sans-serif; mso-height-rule: exactly; line-height: <?php echo esc_attr( floor( $settings['body_text_size'] * 1.618 ) . 'px' ) ?>; color: <?php echo esc_attr( $settings['body_text_color'] ); ?>; font-size: <?php echo esc_attr( $settings['body_text_size'] . 'px' ); ?>" class="body_text_color body_text_size">
						<span style="font-weight: bold; font-size: <?php echo esc_attr( floor( $settings['body_text_size'] * 1.35 ) . 'px' ); ?>" class="welcome"><?php bp_email_the_salutation( $settings ); ?></span>
						<hr color="<?php echo esc_attr( $settings['email_bg'] ); ?>"><br>
						{{{content}}}
					</td>
			  </tr>
			</table>
		</td>
	</tr>
	<!-- 1 Column Text : BEGIN -->

</table>
<!-- Email Body : END -->

<!-- Email Footer : BEGIN -->
<br>
<table cellspacing="0" cellpadding="0" border="0" align="left" width="100%" class="footer_bg">
	<tr>
		<td style="padding: 20px; width: 100%; font-size: <?php echo esc_attr( $settings['footer_text_size'] . 'px' ); ?>; font-family: sans-serif; mso-height-rule: exactly; line-height: <?php echo esc_attr( floor( $settings['footer_text_size'] * 1.618 ) . 'px' ) ?>; text-align: left;" class="footer_text_color footer_text_size">
			<?php
			/**
			 * Fires before the display of the email template footer.
			 *
			 * @since 2.5.0
			 */
			do_action( 'bp_before_email_footer' );
			?>

			<a href="{{{unsubscribe}}}" style="text-decoration: underline;"><?php _ex( 'unsubscribe', 'email', 'buddypress' ); ?></a>

			<?php
			/**
			 * Fires after the display of the email template footer.
			 *
			 * @since 2.5.0
			 */
			do_action( 'bp_after_email_footer' );
			?>
		</td>
	</tr>
</table>
<!-- Email Footer : END -->
