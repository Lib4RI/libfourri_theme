<?php
/**
 * @file
 * Returns the HTML for the basic html structure of a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728208
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>

  <?php
    if ( $default_mobile_metatags ) {
      $url = rtrim(strtok($_SERVER['REQUEST_URI'].'?','?'),'/');
      if ( variable_get('libfourri_theme_cellphone_tuned',FALSE) ) {
        echo '  <meta name="MobileOptimized" content="width" />' . "\r\n";
        echo '  <meta name="HandheldFriendly" content="true" />' . "\r\n"; /* the HandheldFriendly tag may be ignored by Google */
        if ( !empty($url) || user_is_logged_in() ) { /* default values if not landing page */
          echo '  <meta name="viewport" content="width=device-width" />' . "\r\n";
        }
      }
      if ( empty($url) && !user_is_logged_in() ) { /* add viewport always for landing page only (for non-bots/users if not logged in yet) */
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $isBot = ( stripos($ua,'google') || stripos($ua,'bot') || stripos($ua,'crawl') || stripos($ua,'speed') || stripos($ua,'index') ); // rough check is ok here
        if ( !$isBot && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ) {
          echo '  <meta name="viewport" content="width=device-width" />' . "\r\n";
        }
      }
    }
  ?>
  <!--[if IEMobile]><meta http-equiv="cleartype" content="on"><![endif]-->

  <?php print $styles; ?>
  <?php print $scripts; ?>
  <?php if ($add_html5_shim and !$add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5.js"></script>
    <![endif]-->
  <?php elseif ($add_html5_shim and $add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5-respond.js"></script>
    <![endif]-->
  <?php elseif ($add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/respond.js"></script>
    <![endif]-->
  <?php endif; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php if ($skip_link_text && $skip_link_anchor): ?>
    <p id="skip-link">
      <a href="#<?php print $skip_link_anchor; ?>" class="element-invisible element-focusable"><?php print $skip_link_text; ?></a>
    </p>
  <?php endif; ?>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
