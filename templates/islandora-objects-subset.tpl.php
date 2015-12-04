<?php

/**
 * @file
 * Render a bunch of objects in a list or grid view.
 */
?>
<div class="islandora-objects clearfix">
  <div class="object-sort-show-wrapper">
    <div class="displaying-items"><?php print $islandora_solr_result_count?></div>
    <div class="islandora-sort"><?php print $solr_sort?></div>
    <div class="solr-sort-dummy-right">
    </div>
  </div>

  <div class="object-mock-table-header">
    <div class="select-items">
      <div class="select-items-input-wrapper"></div>
    </div>
    <div class="object-mock-pager">
      <?php print $pager; ?>
    </div>

    <div class="object-mock-icons">
      <?php print $secondary_display_profiles;?>
    </div>
  </div>
  <?php print $content; ?>
</div>