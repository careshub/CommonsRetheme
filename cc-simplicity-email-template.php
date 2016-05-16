<?php
/*
Email Template: CC-Simplicity
*/
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
    a:link, a, a:visited{color:#008EAA !important;}
    a:hover { text-decoration: none !important; color:#008EAA;}
    h1, h2, h3, h4, h5, h6{padding: 0; margin: 0;}
    </style>
    </head>
    <body style="margin: 0; padding: 0; background: #f5f5f5; font-family:Helvetica, Arial, Sans-serif;line-height:22px;font-size:12px;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
    <table style="font-size: 12px; font-family: Helvetica, Arial, sans-serif; background: #ffffff; margin-top: 2em; margin-bottom: 2em;" border="0" width="700" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">
        <tr>
          <td><a style="text-decoration: none;" href="<?php echo esc_attr( get_site_url() ); ?>" target="_blank"><img style="width: 100%; max-width: 1161px;" src="http://www.communitycommons.org/wp-content/themes/CommonsRetheme/img/cc_logo_horizontal_org.png" alt="" align="center" /></a></td>
        </tr>
        <tr>
            <td style="padding: 12px 30px; border-bottom: 4px solid #f5f5f5; color: #444444;">
                <h4 style="font-size:14px;font-weight:normal;line-height:24px;"><?php bloginfo( 'description' ); ?></h4>
            </td>
        </tr>
        <tr>
           <td style="line-height: 19px; color: #111111; padding: 12px 30px; border-bottom: 4px solid #f5f5f5;">DPW_CONTENT</td>
        </tr>
        <tr>
            <td style="color:#bbbbbb;padding:12px 30px; ">
                <img src="http://www.communitycommons.org/wp-content/themes/CommonsRetheme/img/cc_logomark-30x30.png" alt="Supporting collaboration through data, maps and stories." width="30" height="30" align="right"  style="padding-top: 0px;"  />
                <div style="padding-top: 8px; padding-bottom: 1px;"><?php printf( __( 'Email sent on %s', 'dpw' ), date_i18n( get_option( 'date_format' ) ) ); ?></div>

            </td>
        </tr>
    </table>
</body>
</html>