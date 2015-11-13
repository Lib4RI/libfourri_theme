/**
 * This template should be overridden by implementing themes to establish
 * the styles they would like to use with DesignKit settings. The following
 * template is provided as a simple example of how you can generate CSS
 * styles from DesignKit settings.
 *
 * .designkit-color { color: [?php print $foreground ?]; }
 * .designkit-bg { background-color: [?php print $background ?]; }
 */

#header {
  background: <?php print $header ?>;
}

#main {
  background: <?php print $main ?>;
}

#header {
  border-bottom-color: <?php print $border ?>;
}

#footer {
  border-top-color: <?php print $border ?>;
}