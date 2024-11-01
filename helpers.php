<?php

function getSectionsOrdered() {
    global $kwmPetfinderGlobals;

    $option = get_option($kwmPetfinderGlobals['fieldVisibility']['optionSectionOrder']);
    $sectionsToRender = $kwmPetfinderGlobals['fieldVisibility']['sections'];
    $sectionsOrdered = $option ? explode(',', $option) : [];

    if (!empty($sectionsOrdered)) {
        $sectionsToRender = array_merge(array_flip($sectionsOrdered), $sectionsToRender);
    }

    return $sectionsToRender;
}

function kwm_petfinder_get_order_config($settings, $setting) {
    if (in_array($settings['kategorie'], ['vermittelt', 'fremdvermittlung', 'verstorben', 'patengesuch', 'patengedeckt']) ){
        return get_option('kw_pefinder_list_sorting_' . $setting . '_' . $settings['kategorie']);
    } else if (in_array($settings['kategorie'], ['vermittelbar', 'fundtier']) ){
        return get_option('kw_pefinder_list_sorting_' . $setting);
    } else if (in_array($settings['kategorie'], ['notfall', 'handicap', 'senior', 'junior'])) {
        return get_option('kw_pefinder_list_sorting_' . $setting . '_andere');
    }

    return null;
}

function kwm_petfinder_get_field_visiblity_config() {
    global $kwmPetfinderGlobals;

    $config = [
        'fields' => [
            'list' => [],
            'detail' => []
        ],
        'sections' => []
    ];

    foreach ($kwmPetfinderGlobals['fieldVisibility']['fields'] as $field => $value) {
        $optionNameList = $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixList'] . $field;
        $optionNameDetail = $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixDetail'] . $field;

        if (get_option($optionNameList) === '1') {
            array_push($config['fields']['list'], $field);
        }

        if (get_option($optionNameDetail) === '1') {
            array_push($config['fields']['detail'], $field);
        }
    }
    
    foreach (getSectionsOrdered() as $section => $value) {
        $optionName = $kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . $section;

        if (get_option($optionName) === '1') {
            array_push($config['sections'], ['name' => $section, 'attributes' => $value]);
        }
    }

    return $config;
}

function kwm_petfinder_get_texts()
{
    global $kwmPetfinderGlobals;

    $textsToRender = [];

    foreach ($kwmPetfinderGlobals['texts'] as $id => $value) {
        $textOption = get_option($kwmPetfinderGlobals['optionPrefix'] . 'text_' . $id);

        if ($textOption) {
            $textsToRender[$id] = $textOption;
        } else {
            $textsToRender[$id] = is_array($value) ? $value['default'] : $value;
        }
    }

    return $textsToRender;
}

function kwm_petfinder_parse_multi_select($valueString) {
    $values = array_filter(explode(',', $valueString), function($value) {
        return !empty($value);
    });

    if (count($values) === 0) {
        return json_encode([]);
    }

    return json_encode(array_map(function($value) {
        return is_numeric($value) ? intval($value) : $value;
    }, $values));
}