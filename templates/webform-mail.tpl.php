<?php

/**
 * @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The webform submission.
 * - $email: The entire e-mail configuration settings.
 * - $user: The current user submitting the form. Always the Anonymous user
 *   (uid 0) for confidential submissions.
 * - $ip_address: The IP address of the user submitting the form or '(unknown)'
 *   for confidential submissions.
 *
 * The $email['email'] variable can be used to send different e-mails to different users
 * when using the "default" e-mail template.
 */
?>
<?php

if(!function_exists("find_components")){
    function find_components ($components, $type){
        $file_idx = array();
        foreach ($components as $key => $value){
            if ($value['type']==$type) {
                array_push($file_idx, $key);
            }
        }
        return $file_idx;
    }
}

if(!function_exists("find_doc_type")){
    function find_doc_type($components, $file_idx){
        $type_idx = array();
        $parent_idx = array();
        foreach ($file_idx as $file_key => $file_cid){
            $file_pid=$components[$file_cid]['pid'];
            foreach ($components as $component_key => $component_value){
                if ($component_value['pid']==$file_pid && $component_value['type']=='select'){
                    $parent_idx[$file_cid]=$component_value['pid'];
                    $type_idx[$file_cid]=$component_value['cid'];
                }
            }
        }
        return [$type_idx,$parent_idx];
    }
}
?>


<?php print ($email['html'] ? '<p>' : '') . t('Submitted on [submission:date:long]') . ($email['html'] ? '</p>' : ''); ?>


<?php
        # get components indexes as visualized on the form
        $comp_idx = array();
        foreach ($node->webform['components'] as $key => $value){
            $comp_idx[$key] = $key;
        }

        # find files, publication types and group indexes
        $idx=find_components ($node->webform['components'],'file');
        $mail_idx=find_components ($node->webform['components'],'email');
        $mark_idx=find_components ($node->webform['components'],'markup');
        $temp=find_doc_type($node->webform['components'], $idx);
        $typ = $temp[0];
        $par = $temp[1];
                
        # remove files, pub types and groups indexes from the components idx array
        $rm_idx = [$idx,$typ,$par,$mark_idx];
        foreach ($rm_idx as $key => $rm_array){
            foreach ($rm_array as $key => $value){
                unset($comp_idx[$value]);
            }
        }

        # print the data
        $replacements = array ('&' => '&amp;',
                               '<' => '&lt;',
                               '>' => '&gt;');

        
        foreach ($comp_idx as $key => $value){
            #TODO: string subtitution < and >
            $text = $submission->data[$key][0];
            foreach ($replacements as $search => $replace){
                $text = str_replace($search, $replace, $text);
            }
            if (in_array($value, $mail_idx)){
                $text = str_replace(',', ';', $text);
            }
	    if (!empty($text))
	            print($node->webform['components'][$key]['name'].': '."\n".$text."\n\n");
        
	    if ($node->webform['components'][$key]['form_key'] == 'bibliography_h')
                $subsite = strtolower($submission->data[$key][0]);
        }
        

        print("\nSubmitted documents:\n");
        # get the file names
        foreach ($idx as $key => $value){
	    $uri=file_load($submission->data[$value][0])->uri;
            $name = basename($uri);
	    $type = str_replace('&nbsp;','',$node->webform['components'][$value]['name']);
            if(!empty($name)){
	        print("$name ($type)\n");
            } 
        }
        
        ###### internal email ########################################
        if (strpos($email['email'], '@') !== false){
            global $base_url;
            print("\n\n");
	    print("View the submission:\n");
            $url = $base_url.'/node/'.$node->nid.'/submission/'.$submission->sid;
            print(url($url));
            print("\n\n");
        }
        ###############################################################
        
 ?>

