<?php
/**
 * @file
 * Results view for Solr citations.
 *
 * Variables available:
 *
 * - $citations: an array of recent citations containing:
 *   'citation': The rendered citation from citeproc.
 *   'pid': The object PID.
 *   'pdfs': An array of PDFs to render. Each of these contain a 'version', a
 *   'dsid' and an 'id'.
 */
?>


<div id="lib4ridora-citation-solr-results">
  <?php foreach ($citations as $citation): ?>
  <div class="lib4ri-citation-solr-results-citation">
    <?php print $citation['citation']; ?>
    <div class="bib-detail-record"><div><?php $cit_pid = $citation['pid']; print l("Detailed Record", "/islandora/object/$cit_pid"); ?></div></div>
    <div class="bib-versions">
    <?php foreach ($citation['pdfs'] as $pdf): ?>
    <span id="<?php print $pdf['id']; ?>" class="<?php print $pdf['classes']; ?>"><?php print l(ucwords($pdf['version']), "/islandora/object/{$citation['pid']}/datastream/{$pdf['dsid']}/view"); ?></span>
    <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
