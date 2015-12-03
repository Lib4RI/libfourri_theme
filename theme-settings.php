<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function libfourri_theme_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  $form['lib4ri_theme_custom'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom Settings'),
    '#weight' => 5,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_search_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Search area welcome text.'),
    '#default_value' => theme_get_setting('lib4ri_theme_search_text'),
    '#description' => t("The search text to appear in the simple search box on the front page."),
  );

  $form['lib4ri_theme_custom']['lib4ri_theme_bib_accepted'] = array(
    '#type' => 'textfield',
    '#title' => t('Accepted citation class.'),
    '#default_value' => theme_get_setting('lib4ri_theme_bib_accepted'),
    '#description' => t("Set the Font-Awesome class to use as an icon for an accepted version."),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_bib_updated'] = array(
    '#type' => 'textfield',
    '#title' => t('Updated citation class.'),
    '#default_value' => theme_get_setting('lib4ri_theme_bib_updated'),
    '#description' => t("Set the Font-Awesome class to use as an icon for an updated version."),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_bib_published'] = array(
    '#type' => 'textfield',
    '#title' => t('Published citation class.'),
    '#default_value' => theme_get_setting('lib4ri_theme_bib_published'),
    '#description' => t("Set the Font-Awesome class to use as an icon for a Published version."),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_bib_supplemental'] = array(
    '#type' => 'textfield',
    '#title' => t('Supplemental citation class.'),
    '#default_value' => theme_get_setting('lib4ri_theme_bib_supplemental'),
    '#description' => t("Set the Font-Awesome class to use as an icon for a Supplemental version."),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_bib_unspecified'] = array(
    '#type' => 'textfield',
    '#title' => t('Unspecified citation class.'),
    '#default_value' => theme_get_setting('lib4ri_theme_bib_unspecified'),
    '#description' => t("Set the Font-Awesome class to use as an icon for an Unspecified version."),
  );

  $form['lib4ri_theme_custom']['lib4ri_theme_omit_extended_collection_meta'] = array(
    '#type' => 'select',
    '#title' => t('Omit collections specific metadata.'),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => theme_get_setting('lib4ri_theme_omit_extended_collection_meta'),
    '#description' => t("Use this setting to toggle the omission of 'in collections' and 'details' metadata on collection pages. Defaults to Yes"),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_omit_extended_bookmark_save'] = array(
    '#type' => 'select',
    '#title' => t('Omit add bookmark fieldset from search results.'),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => theme_get_setting('lib4ri_theme_omit_extended_bookmark_save'),
    '#description' => t("Use this setting to toggle the omission of the add bookmark functionality from the bookmark display profile. Defaults to Yes"),
  );
  $form['lib4ri_theme_custom']['lib4ri_theme_omit_in_collection_obj'] = array(
    '#type' => 'select',
    '#title' => t("Ommit 'in collection' data on object pages."),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => theme_get_setting('lib4ri_theme_omit_in_collection_obj'),
    '#description' => t("Use this setting to toggle the omission of 'in collections' on object pages. Defaults to Yes"),
  );
}
