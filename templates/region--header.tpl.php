<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>
<?php if ($content): ?>
  <div class="<?php print $classes; ?>">
    <?php print $content; ?>
      <?php if (isset($header_search)):?>
        <?php print $header_search; ?>
      <?php endif;?>
  </div>
<?php endif; ?>