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
          <!-- Metadata -->
          <div class="solr-fields islandora-inline-metadata">
            <div class="solr-thumb islandora-object-thumb">
              <input type="checkbox" class="islandora-list-item-select">
            </div>
            <?php foreach($result['solr_doc'] as $key => $value): ?>
              <div class="solr-label <?php print $value['class']; ?>">
                <?php print $value['label']; ?>
              </div>
              <div class="solr-value <?php print $value['class']; ?>">
                <?php print $value['value']; ?>
              </div>
            <?php endforeach; ?>
             <div class="object-list-lock-wrapper">
               <div id="lib4ridora-citation-solr-results">
                 <div class="lib4ri-citation-solr-results-citation">
                 <?php print $result['citations']['citation']; ?>
                   <div class="bib-detail-record">
                     <div>
                     <?php $cit_pid = $result['citations']['pid']; print l("Detailed Record", "islandora/object/$cit_pid"); ?>
                     </div>
                   </div>
                   <div class="bib-versions">
                   <?php foreach ($result['citations']['pdfs'] as $pdf): ?>
                     <span id="<?php print $pdf['id']; ?>" class="<?php print $pdf['classes']; ?>"><?php print l(ucwords($pdf['version']), "islandora/object/{$result['citations']['pid']}/datastream/{$pdf['dsid']}/view"); ?></span>
                   <?php endforeach; ?>
                   </div>
                 </div>
               </div>
             </div>
          </div>
        </div>
      </div>
    <?php $row_result++; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
