<?php

/**
 * @file
 * Render a bunch of objects in a list or grid view.
 */
?>

<div class="islandora-objects-list">
  <?php $row_field = 0; ?>
  <?php foreach($objects as $object): ?>
    <?php $first = ($row_field == 0) ? 'first' : ''; ?>
    <div class="islandora-objects-list-item clearfix">
      <dl class="islandora-object <?php print $object['class']; ?>">
        <dt class="islandora-object-thumb">
          <input type="checkbox" class="islandora-list-item-select">
        </dt>
        <dd class="islandora-object-caption <?php print $object['class']?> <?php print $first; ?>">
          <strong>
            <?php print $object['link']; ?>
          </strong>
        </dd>
        <dd class="islandora-object-description">
          <?php print $object['description']; ?>
        </dd>
        <div class="object-list-lock-wrapper">
          <?php print l("Detailed Record", "islandora/object/" . $object->{id});?>
          <div class="published-accepted-links">
            <i class="fa fa-lock"></i><?php print l("Published Version", "islandora/object/islandora:root");?>
            <i class="fa fa-unlock-alt"></i><?php print l("Accepted Version", "islandora/object/islandora:root");?>
          </div>
        </div>
      </dl>
    </div>
    <?php $row_field++; ?>
  <?php endforeach; ?>
</div>