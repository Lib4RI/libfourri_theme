<?php
/**
 * @file
 * Islandora solr search results wrapper template
 *
 * Variables available:
 * - $variables: all array elements of $variables can be used as a variable.
 *   e.g. $base_url equals $variables['base_url']
 * - $base_url: The base url of the current website. eg: http://example.com .
 * - $user: The user object.
 *
 * - $secondary_profiles: Rendered secondary profiles
 * - $results: Rendered search results (primary profile)
 * - $islandora_solr_result_count: Solr result count string
 * - $solrpager: The pager
 * - $solr_debug: debug info
 *
 * @see template_preprocess_islandora_solr_wrapper()
 */
?>

<div id="islandora-solr-top">

  <div class="object-sort-show-wrapper">
    <div class="displaying-items">
      <?php print $islandora_solr_result_count; ?>
    </div>
    <?php if(isset($solr_sort)): ?>
      <div class="islandora-sort">
        <?php print $solr_sort; ?>
      </div>
    <?php endif;?>
  </div>

  <div class="object-mock-table-header">
    <div class="select-items">
      <div class="select-items-input-wrapper">
        <input type="checkbox" class="islandora-list-item-select">
        <?php print t("Select Page");?>
      </div>
    </div>

    <div class="object-mock-pager">
      <?php print $solr_pager; ?>
    </div>
    <div class="object-mock-icons">
      <?php print $secondary_profiles; ?>
    </div>
  </div>

</div>
<div class="islandora-solr-content">
  <?php print $results; ?>
  <?php print $solr_debug; ?>
</div>
