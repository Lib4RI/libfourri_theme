<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Happy little theme template file.
 *
 *
 *                           .,;;::.;;;;:.,
 *                       .::,';;;';;;'';';;;;
 *                    ,:;''';++''''''''+''';;``:
 *                  .,,;;;++++++++#+++'+''+';'++'+
 *                .;;:;'+'++++####++++++++'++'+++'+
 *               :;';+'#++#++############++++++++++++.`
 *             `:;''++++#####+#####@@######+###++#+''''`
 *             ;;''++##############@@@@@#@#########++++',
 *           .;''+++########@@#@#@@@@@@###@#########+++''`
 *           ,;''++########@@##@#@@@@@@###@##@########+++'
 *          :;''+++####@@@#@@@@@@@@@@@@##@@#@###@#+####++'+'
 *         .''++#######@@##@@@@@@#@@@@@#@@@@@#@@#####+##++++.`
 *         ;;'+#######@#@@@@@##@@@@@@@@#@#@#############+++++'
 *        :''++#######@##@@@#@@@@@@@@@#@#####@@@@@#@###+++++++
 *       .;'++###@@@@#@##@@@@@#@@@@@@@@#####@#@@@@@@@@###+++++;
 *       `;'++###@@@@##@@###@@@#@@@@@#@@########@@@@@@@####+++'
 *     `,;'++####@@@@#@#@@@@@#@@@@@@@#@@#####@#@@#@@@@@#+#++++'
 *     `:''+#####@@@####@@@@@@@@@@##@@@@@###@####@@@@###++#+++++
 *     `;'+######@@@#@@@@@@@@@###@@@@@@@@###@@####@@@#@@#+###++'.
 *     '+++###@@@@@@@@@@@@@@#@@@@@@@@@@@@#@@@#@####@@@#@#####++'.
 *    '''+######@@@@@@@#@####@@@@@@@@@@@@#@@@@##@###@@@@@@+##++++
 *    :'++#####@@@@@@@@@#####@@@@@#@@@@@@#@@###########@#+####+++,
 *    ''++####@@@@@@@@@#@@@@@@@@@@#@@#########################+++'
 *   `;+++#######@@@@@@#@@@@@@@@@#@#####@@@@@@@#################+'`
 *   .''++#####@@@@@@#@#@#@@@@@@@#@########@@@@#################''`
 *    ;+++######@@@@@@@@@##@@@@@##@########@@@@##############+#'+';
 *    ;++########@@@@@@@@@@@@@#@@@@########@@@@##############++++;'`
 *   ,'++########@@@@@@@@@#@@@#@@@@@@###@###@@@@######+#++#####+++'
 *   `'++#######@#@@@@#@@@@#@@#@@@@@#@##@#####@@########+##+##+++',
 *   .;'+#######@@@##@@##@@@@@@@@@@@##########@@#######++######+''`
 *   ,'++########@@@@@@#@@@@@@@#@@@@##################++#+####+++''
 *   ;+++########@@@@@@@@@@@@@###########+###################+#++''
 *   ;'++########@@@@@@@@@############++++#++++#######+########+++'
 *   ;'++########@@@@@@@@@######+#+++++++++''+++###############++++
 *   .+++###########@@@@@@###+++++++'+''+++''''+###############+'''`
 *    '++###########@@@@@@#+#++++#+''+''';';';'+++++##########++++'
 *    :+++##########@@@@@###@##++'''''';';;;;;;'++############++++'
 *    :'++#########@@@@@#########++;;';;'';;;;;'++###########++#+'+
 *     ''+###########@####++''''+++'';;;''++#':'+#######+#####+#+;:
 *    .;'++#########@#@##++++####++';::;+';:,'';+########+##++++''
 *    `;'++#########@@@##++++''+##+';,:'+#;+',:;#############++++'
 *     ;;'+#########@@@#++++'''+#++':,:'';:,;:,;+##########+++++':
 *     ;''+#############++++''++++'':,,:;;:,,,::+##########++++'`
 *     :''++############'+'''''++++':,:::::::,,:########+++++++'
 *     `''++############'''''''++'+':,,,,,::,,,,########+++++++'
 *      ::'+###########+''''''++++';:,,:::::,,,,#####+#++++++++:
 *      ::+++##########+'''''+#'''';::,,;;;,.,,,#######+#++++'+
 *       ,;'+##########+''''+#''++';:,,,:+;:,,,,######++++++''.
 *       :;+++######@##+'''+#++++#+';;:,,;+;,,,,#####++++++'''
 *       ,:;++#########++++###+#+++++'';;:+':,,:#####+++++++'
 *        ;';+#########++''###+++++++++';;'+;::;#####++++''+
 *         ,;++##+######+++###@++'+'+';';''+',,'###++++++'.`
 *           ;''#####@@#+#+++++#+;;;.,:'+''';,:+##+++++++'`
 *               +####@##+++++++'+'+;:;::'+;:;'###++++++'
 *                  :####+#+#+++';;;::.,:''+;''##+++'+'+
 *                  ` +#+###+++++';;;::::'''''##++++'''
 *                     ,###+++++'+''';;:;;'''+#++++++'
 *                      ###+++++'++';::;;'''++++++++;
 *                       +++++++''';;::;;'''++++++#
 *                       .##'+++''';;::;;'''++++++,
 *                        +''++'+''''';';;''+++++@
 *                         +'''++'+++'''';':
 *                         `''''#++###'';'.
 *                           ;'#++###++';
 *                             +'+##++';
 *                                :#+,,
 *
 *
 *
 */

/**
 * Implements hook_form_alter().
 */
function libfourri_theme_form_islandora_solr_simple_search_form_alter(&$form, &$form_state, $form_id) {
  $link = array(
    '#markup' => "<div class='adv-search-lnk'>" . l(t("Advanced Search"), "advanced-search", array('attributes' => array('class' => array('adv_search')))) . "</div>",
  );
  $form['simple']['advanced_link'] = $link;
  $form['simple']['islandora_simple_search_query']['#attributes']['placeholder'] = t("Search");
  if (drupal_is_front_page()) {
    $form['simple']['islandora_simple_search_query']['#attributes']['size'] = 30;
    if (theme_get_setting('lib4ri_theme_search_text')) {
      $form['simple']['lib4ri_text_search_text'] = array(
        '#weight' => -1,
        '#markup' => "<div class='front-description-wrapper'><p class='simple-search-text'>" . theme_get_setting('lib4ri_theme_search_text') . "</p></div>",
      );
    }
  }
}

/**
 * Implements hook_preprocess_page().
 */
function libfourri_theme_preprocess_page(&$variables) {
  $object = menu_get_object('islandora_object', 2);
  $current_path = current_path();
  $cp_exp = explode("/", $current_path);

  if (in_array('islandora:collectionCModel', $object->models)) {
    $variables['page']['content']['system_main']['islandora_basic_collection_display']['#weight'] = -1;
    $variables['page']['content']['system_main']['wrapper']['#weight'] = -2;
    // Toggle the appearance of 'In Collections' and 'Details' on collection pages.
    if (theme_get_setting('lib4ri_theme_omit_extended_collection_meta')) {
      $variables['page']['content']['system_main']['wrapper']['collections'] = NULL;
      $variables['page']['content']['system_main']['wrapper']['metadata'] = NULL;
    }
  }
  // Set the title on search results pages to nothing.
  if (count($cp_exp) > 1 && $cp_exp[0] == "islandora" && $cp_exp[1] == "search") {
    drupal_set_title("");
  }
}

/**
 * Implements hook_preprocess().
 */
function libfourri_theme_preprocess_islandora_solr_wrapper(&$variables) {
  libfourri_theme_process_global_header($variables);
}

/**
 * Implements hook_preprocess().
 */
function libfourri_theme_preprocess_islandora_objects_subset(&$variables) {
  libfourri_theme_process_global_header($variables);
}

/**
 * Implements hook_preprocess().
 */
function libfourri_theme_preprocess_lib4ridora_citation_solr_results(&$variables) {

  $versions = array(
    'accepted version' => theme_get_setting('lib4ri_theme_bib_accepted'),
    'updated version' => theme_get_setting('lib4ri_theme_bib_updated'),
    'published version' => theme_get_setting('lib4ri_theme_bib_published'),
    'supplemental material' => theme_get_setting('lib4ri_theme_bib_supplemental'),
    'unspecified' => theme_get_setting('lib4ri_theme_bib_unspecified')
  );
  foreach ($variables['citations'] as &$citation) {
    foreach ($citation['pdfs'] as $key => &$value) {
      $value['classes'] = isset($versions[$value['version']]) ? $versions[$value['version']] : "";
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function libfourri_theme_form_islandora_solr_range_slider_form_alter(&$form, &$form_state, $form_id) {
  $form['range_slider_submit']['#prefix'] = "<div class='range-slider-button-wrapper'>";
  $form['range_slider_submit']['#suffix'] = "</div>";
}

/**
 * Implements hook_form_alter().
 */
function libfourri_theme_form_islandora_solr_date_filter_form_alter(&$form, &$form_state, $form_id) {
  $form['date_filter']['date_filter_submit']['#prefix'] = "<div class='date-filter-button-wrapper'>";
  $form['date_filter']['date_filter_submit']['#suffix'] = "</div>";
}

function libfourri_theme_process_global_header(&$variables) {
  global $_islandora_solr_queryclass;
  $variables['islandora_solr_result_count'] = t(
    'Showing @start - @end of @total',
    array(
      '@start' => $variables['limit'],
      '@end' => $variables['limit'],
      '@total' => $variables['total'],
    )
  );
  $variables['solr_sort'] = libfourri_theme_block_render('islandora_solr', 'sort');

  $output = libfourri_theme_display_subset_results($_islandora_solr_queryclass, $variables);
}

function libfourri_theme_display_subset_results($islandora_solr_query, &$variables) {
  $secondary_profiles = NULL;
  $elements = array();

  // Raw solr results.
  $islandora_solr_result = $islandora_solr_query->islandoraSolrResult;

  // Solr results count.
  // Total Solr results.
  $elements['solr_total'] = (int) $islandora_solr_result['response']['numFound'];

  // Solr start.
  // To display: $islandora_solr_query->solrStart + ($total > 0 ? 1 : 0).
  $elements['solr_start'] = $islandora_solr_query->solrStart;

  // Solr results end.
  $end = min(($islandora_solr_query->solrLimit + $elements['solr_start']), $elements['solr_total']);
  $elements['solr_end'] = $end;
  $variables['elements'] = $elements;
  // Rendered secondary display profiles.
  $secondary_profiles = libfourri_theme_add_secondaries($islandora_solr_query);
  $variables['secondary_display_profiles'] = $secondary_profiles;
  libfourri_theme_build_result_count($variables);
}

function libfourri_theme_build_result_count(&$variables) {
  $elements = $variables['elements'];

  // Make all variables in 'elements' available as variables in the template
  // file.
  foreach ($variables['elements'] as $key => $value) {
    $variables[$key] = $value;
  }

  // Results count.
  $total = $elements['solr_total'];
  $end = $elements['solr_end'];
  $start = $elements['solr_start'] + ($total > 0 ? 1 : 0);

  // Format numbers.
  $total = number_format($total, 0, '.', ',');
  $end = number_format($end, 0, '.', ',');
  $start = number_format($start, 0, '.', ',');

  $variables['islandora_solr_result_count'] = t('Showing @start - @end of @total', array(
    '@start' => $start,
    '@end' => $end,
    '@total' => $total,
  ));
}

function libfourri_theme_add_secondaries($islandora_solr_query) {
  $query_list = array();
  // Get secondary display profiles.
  $secondary_display_profiles = module_invoke_all('islandora_solr_secondary_display');

  // $_GET['q'] didn't seem to work here.
  $path = current_path();

  // Parameters set in URL.
  $params = $islandora_solr_query->internalSolrParams;

  // Get list of secondary displays.
  $secondary_array = variable_get('islandora_solr_secondary_display', array());
  foreach ($secondary_array as $name => $status) {
    if ($status === $name) {
      // Generate URL.
      $query_secondary = array_merge($params, array('solr_profile' => $name));

      // Set attributes variable for remove link.
      $attr = array();
      $attr['title'] = $secondary_display_profiles[$name]['description'];
      $attr['rel'] = 'nofollow';
      $attr['href'] = url($path, array('query' => $query_secondary));
      $logo = $secondary_display_profiles[$name]['logo'];
      // XXX: We are not using l() because of active classes:
      // @see http://drupal.org/node/41595
      // Create link.
      $query_list[] = '<a' . drupal_attributes($attr) . '>' . $logo . '</a>';
    }
  }

  return theme('item_list', array(
    'items' => $query_list,
    'title' => NULL,
    'type' => 'ul',
    'attributes' => array('id' => 'secondary-display-profiles'),
  ));
}

/**
 * Implements theme_tablesort_indicator().
 */
function libfourri_theme_tablesort_indicator($variables) {
	$theme_path = path_to_theme();
  if ($variables['style'] == "asc") {
    return theme('image', array('path' => "$theme_path/images/caret_up.png", 'alt' => t('sort ascending'), 'title' => t('sort ascending')));
  }
  else {
    return theme('image', array('path' => "$theme_path/images/caret_down.png", 'alt' => t('sort descending'), 'title' => t('sort descending')));
  }
}

/**
 * Implements hook_preprocess_region().
 */
function libfourri_theme_preprocess_region(&$variables) {
  // Region preprocessing.
  $function = 'libfourri_theme_preprocess_region_'.$variables['region'];
  if (function_exists($function)) {
    $function($variables);
  }
}

function libfourri_theme_preprocess_region_header(&$variables) {
  if (!drupal_is_front_page()) {
    $variables['header_search'] = libfourri_theme_block_render('islandora_solr', 'simple');
  }
}

function libfourri_theme_block_render($module, $delta, $as_renderable = FALSE) {
  $block = block_load($module, $delta);
  $block_content = _block_render_blocks(array($block));
  $build = _block_get_renderable_array($block_content);
  if ($as_renderable) {
    return $build;
  }
  $block_rendered = drupal_render($build);
  return $block_rendered;
}
