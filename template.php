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

function libfourri_theme_preprocess_islandora_solr(&$variables) {
  libfourri_theme_citations_for_search_results($variables['results']);
 // dsm($variables, "vars in islandora solr");
}

function libfourri_theme_citations_for_search_results(&$results) {
  $items = array();
  $versions = libfourri_theme_get_accepted_version_types();
  $style = citeproc_default_style();
  foreach ($results as &$item) {
    $object = islandora_object_load($item['PID']);
    if ($object) {
      // Render the citation.
      $mods = islandora_bibliography_get_mods($object->id);
      $entry = citeproc_bibliography_from_mods($style, $mods);
      // Get the info for the PDFs.
      $datastreams = iterator_to_array($object);
      $pdf_datastreams = array_filter($datastreams, 'lib4ridora_multi_embargo_pdf_filter');
      $pdfs = array();
      foreach ($pdf_datastreams as $pdf_datastream) {
        if (!islandora_datastream_access(ISLANDORA_VIEW_OBJECTS, $pdf_datastream)) {
          continue;
        }
        $version = $pdf_datastream->relationships->get(ISLANDORA_RELS_INT_URI, 'lib4ridora-multi-embargo-document_version');
        $version = array_shift($version);
        if (!is_null($version)) {
          $pdfs[] = array(
            'dsid' => $pdf_datastream->id,
            'version' => $version['object']['value'],
            'id' => 'lib4ri-citation-' . str_replace(' ', '-', $version['object']['value']),
          );
        }
      }
      $item['citations'] = array(
        'citation' => $entry,
        'pid' => $object->id,
        'pdfs' => $pdfs,
      );
      foreach ($item['citations']['pdfs'] as $key => &$value) {
        $value['classes'] = isset($versions[$value['version']]) ? $versions[$value['version']] : "";
      }
    }
  }
  return $items;
}

function libfourri_theme_get_accepted_version_types() {
  return array(
    'accepted version' => theme_get_setting('lib4ri_theme_bib_accepted'),
    'updated version' => theme_get_setting('lib4ri_theme_bib_updated'),
    'published version' => theme_get_setting('lib4ri_theme_bib_published'),
    'supplemental material' => theme_get_setting('lib4ri_theme_bib_supplemental'),
    'unspecified' => theme_get_setting('lib4ri_theme_bib_unspecified')
  );
}

/**
 * Implements hook theme_preprocess_block().
 */
function libfourri_theme_preprocess_block(&$variables) {
  if ($variables['block']->delta === 'current_query') {
    // Not a huge fan of this, but it is hard coded in the islandora_solr module.
    $variables['content'] = str_replace("Enabled Filters", "Active Filters", $variables['content']);
    $variables['content'] = str_replace("<h3>Query</h3>", "<h3>Your Search</h3>", $variables['content']);
  }
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
  $versions = libfourri_theme_get_accepted_version_types();
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
    '@show @start - @end of @total',
    array(
      '@start' => $variables['limit'],
      '@end' => $variables['limit'],
      '@total' => $variables['total'],
      '@show' => t("Search Results"),
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

  $variables['islandora_solr_result_count'] = t('@show @start - @end of @total', array(
    '@show' => t("Search Results"),
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

function libfourri_theme_form_islandora_bookmark_results_form_alter(&$form, &$form_state) {
  global $_islandora_solr_queryclass;
  module_load_include('inc', 'islandora_solr', 'includes/utilities');
  $data_array = array();
  libfourri_theme_display_subset_results($_islandora_solr_queryclass, &$data_array);
  $data_array['solr_sort'] = libfourri_theme_block_render('islandora_solr', 'sort');
  islandora_solr_pager_init($data_array['solr_total'], $_islandora_solr_queryclass->solrLimit);
  $data_array['solr_pager'] = theme(
    'pager',
    array(
      'tags' => NULL,
      'element' => 0,
      'parameters' => NULL,
      'quantity' => 5,
    )
  );
  $form['islandora_bookmark_table']['#header']['markup'] = t("Select Page");
  $delimiter = "solr_profile=rss";
  $pieces = explode($delimiter, $data_array['secondary_display_profiles']);
  if (count($pieces) > 1) {
    $pieces[0] = $pieces[0].$delimiter."&amp;citation=true";
    $data_array['secondary_display_profiles'] = implode("",$pieces);
  }
  if (theme_get_setting('lib4ri_theme_omit_extended_collection_meta')) {

  }
  if (theme_get_setting('lib4ri_theme_omit_extended_bookmark_save')) {
    $form['islandora_bookmark_save_fieldset'] = NULL;
  } else {
    $form['islandora_bookmark_save_fieldset']['fieldset']['#attributes']['class'] = array('bookmark_result_save');
  }

  $form['islandora_bookmark_export']['fieldset']['#type'] = 'container';
  $form['islandora_bookmark_export']['fieldset']['#attributes']['class'] = array('bookmark_export');
  $form['islandora_bookmark_export']['fieldset']['export_options']['#title'] = t("Export As: ");
  $form['islandora_bookmark_export']['fieldset']['export_all_submit']['#value'] = t("Export All");
  $form['islandora_bookmark_export']['fieldset']['export_selected_submit']['#value'] = t("Export Selected");

  $form['islandora_bookmark_table']['#prefix'] = '<div class="object-sort-show-wrapper">' .
    '<div class="displaying-items">' . $data_array['islandora_solr_result_count'] . '</div>' .
    '<div class="islandora-sort">' . $data_array['solr_sort'] . '</div>' .
    '<div class="solr-sort-dummy-right"></div>' .
    '</div>';
  $form['islandora_bookmark_table']['#prefix'] .= '<div class="object-mock-table-header">' .
    '<div class="select-items"></div>' .
    '<div class="object-mock-pager">' . $data_array['solr_pager'] . '</div>' .
    '<div class="object-mock-icons">' . $data_array['secondary_display_profiles'] . '</div>' .
    '</div>';
  // set up the results to have citation publication type links.
  $pid_keys = array_keys($form['islandora_bookmark_table']['#options']);
  // Get the PIDS into a format the citation result needs
  foreach ($pid_keys as $key => $value) {
    $pid_keys[$key] = array(
      'PID' => $value,
    );
  }

  libfourri_theme_citations_for_search_results($pid_keys);
  $count = 0;
  foreach ($form['islandora_bookmark_table']['#options'] as $key => $value) {
    $form['islandora_bookmark_table']['#options'][$key]['markup'] = $value['markup'] .
      libfourri_theme_search_result_citation($pid_keys[$count], $value);
      $count++;
  }
}

function libfourri_theme_search_result_citation($pid_keys, $value) {

  $form = array();
  $form['citation_solr_result'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'class' => array(
        'lib4ri-citation-solr-results-citation',
      ),
    ),
  );

  $form['citation_solr_result']['detailed_record'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'class' => array(
        'bib-detail-record',
      ),
    ),
  );

  $form['citation_solr_result']['detailed_record']['value'] = array(
    '#markup' => l(t("Detailed Record"), "/islandora/object/{$pid_keys['PID']}"),
  );

  foreach ($pid_keys['citations']['pdfs'] as $key => $in_val) {
  //  dsm($in_val, "blarg:");
    $form['citation_solr_result'][$in_val['id']] = array(
      '#type' => 'container',
      '#attributes' => array(
        'class' => array(
          $in_val['classes'] . " {$in_val['id']}",
        ),
      ),
    );
    $form['citation_solr_result'][$in_val['id']]['value'] = array(
      '#markup' => l(ucwords($in_val['version']), "/islandora/object/{$pid_keys['PID']}/datastream/{$in_val['dsid']}/view"),
    );
  }

  return drupal_render($form);
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
