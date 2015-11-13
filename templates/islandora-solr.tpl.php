<?php
/**
 * @file
 * Islandora solr search primary results template file.
 *
 * Variables available:
 * - $results: Primary profile results array
 *
 * @see template_preprocess_islandora_solr()
 */

?>
<?php if (empty($results)): ?>
  <p class="no-results"><?php print t('Sorry, but your search returned no results.'); ?></p>
<?php else: ?>
  <div class="islandora islandora-solr-search-results">
    <?php $row_result = 0; ?>
    <?php foreach($results as $key => $result): ?>
      <!-- Search result -->
      <div class="islandora-solr-search-result clear-block <?php print $row_result % 2 == 0 ? 'odd' : 'even'; ?>">
        <div class="islandora-solr-search-result-inner islandora-objects-list-item">
          <!-- Thumbnail -->
          <dl class="solr-thumb islandora-object-thumb">
            <dt class="">
              <input type="checkbox" class="islandora-list-item-select">
            </dt>
          </dl>
          <!-- Metadata -->
          <dl class="solr-fields islandora-inline-metadata">
            <?php foreach($result['solr_doc'] as $key => $value): ?>
              <dt class="solr-label element-invisible <?php print $value['class']; ?>">
                <?php print $value['label']; ?>
              </dt>
              <dd class="solr-value <?php print $value['class']; ?>">
                <?php print $value['value']; ?>
              </dd>
            <?php endforeach; ?>
             <div class="object-list-lock-wrapper">
              <?php print l("Detailed Record", $result['object_url']);?>
              <div class="published-accepted-links">
                <span class="fa fa-lock"><?php print l("Published Version", "islandora/object/islandora:root");?></span>
                <span class="fa fa-unlock-alt"><?php print l("Accepted Version", "islandora/object/islandora:root");?></span>
              </div>
             </div>
          </dl>
        </div>
      </div>
    <?php $row_result++; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
