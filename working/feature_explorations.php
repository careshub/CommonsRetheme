<?php 
//Add TinyMCE editor to comments area
// add_filter( 'comment_form_defaults', 'visual_editor_comment_form_defaults' );
function visual_editor_comment_form_defaults( $args ) {
    if ( is_user_logged_in() ) {
        $mce_plugins = 'inlinepopups, fullscreen, wordpress, wplink, wpdialogs';
    } else {
        $mce_plugins = 'fullscreen, wordpress';
    }
    ob_start();
    wp_editor( '', 'comment', array(
        'media_buttons' => true,
        'teeny' => true,
        'textarea_rows' => '7',
        'tinymce' => array( 'plugins' => $mce_plugins )
    ) );
    $args['comment_field'] = ob_get_clean();
    return $args;
}
// add_filter( 'comment_form_defaults', 'rich_text_comment_form' );
function rich_text_comment_form( $args ) {
  ob_start();
  wp_editor( '', 'comment', array(
    'media_buttons' => true, // show insert/upload button(s) to users with permission
    'textarea_rows' => '10', // re-size text area
    'dfw' => false, // replace the default full screen with DFW (WordPress 3.4+)
    'tinymce' => array(
          'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,bullist,numlist,code,blockquote,link,unlink,outdent,indent,|,undo,redo,fullscreen',
          'theme_advanced_buttons2' => '', // 2nd row, if needed
          'theme_advanced_buttons3' => '', // 3rd row, if needed
          'theme_advanced_buttons4' => '' // 4th row, if needed
        ),
    'quicktags' => array(
         'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close'
      )
  ) );
  $args['comment_field'] = ob_get_clean();
  return $args;
}
// Allow TinyMCE editor for replies
// add_filter( 'comment_reply_link', 'cc_tinymce_comments_reply_link' );
function cc_tinymce_comments_reply_link($link) {
  return str_replace( 'onclick=', 'data-onclick=', $link );
}
// add_action( 'wp_footer', 'cc_tinymce_comments_wp_footer' );
function cc_tinymce_comments_wp_footer() {
?>
<script type="text/javascript">
  jQuery(function($){
    $('.comment-reply-link').click(function(e){
      e.preventDefault();
      var args = $(this).data('onclick');
      args = args.replace(/.*(|)/gi, '').replace(/"|s+/g, '');
      args = args.split(',');
      tinymce.EditorManager.execCommand('mceRemoveControl', true, 'comment');
      addComment.moveForm.apply( addComment, args );
      tinymce.EditorManager.execCommand('mceAddControl', true, 'comment');
    });
  });
</script>
<?php
}