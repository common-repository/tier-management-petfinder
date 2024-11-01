<?php
require_once('settings/page-general.php');
require_once('settings/page-lists.php');
require_once('settings/page-social-media.php');
require_once('settings/page-shortcode.php');
require_once('settings/page-field-visibility.php');
require_once('settings/page-texts.php');

function kwm_petfinder_create_menu()
{
    add_menu_page('Petfinder Einstellungen - Allgemein', 'Petfinder', 'administrator', 'kwm-petfinder-settings', 'kwm_petfinder_settings_page_general', plugins_url('/assets/images/settings_icon.png', __FILE__));
    add_submenu_page('kwm-petfinder-settings', 'Petfinder Einstellungen - Listen', 'Listen', 'administrator', 'kwm-petfinder-settings-lists', 'kwm_petfinder_settings_page_lists');
    add_submenu_page('kwm-petfinder-settings', 'Petfinder Einstellungen - Social Media', 'Social Media', 'administrator', 'kwm-petfinder-settings-social-media', 'kwm_petfinder_settings_page_social_media');
    add_submenu_page('kwm-petfinder-settings', 'Petfinder Einstellungen - Sichtbare Felder', 'Sichtbare Felder', 'administrator', 'kwm-petfinder-settings-field-visibility', 'kwm_petfinder_settings_page_field_visibility');
    add_submenu_page('kwm-petfinder-settings', 'Petfinder Einstellungen - Texte', 'Texte', 'administrator', 'kwm-petfinder-settings-texts', 'kwm_petfinder_settings_page_texts');
    add_submenu_page('kwm-petfinder-settings', 'Petfinder Einstellungen - Shortcode', 'Shortcode', 'administrator', 'kwm-petfinder-settings-shortcode', 'kwm_petfinder_settings_page_shortcode');
    add_action('admin_init', 'kwm_petfinder_register_settings');
}

function kwm_petfinder_register_settings()
{
    global $kwmPetfinderGlobals;

    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'customer_id');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'api_key');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'external_contact_url');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'external_sponsor_contact_url');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'contact_only_loggedin');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'delete_data_on_deinstallation');
    register_setting('kwm-petfinder-settings-group-general', $kwmPetfinderGlobals['optionPrefix'] . 'scroll_offset');
    register_setting('kwm-petfinder-settings-group-social-media', $kwmPetfinderGlobals['optionPrefix'] . 'share_title');
    register_setting('kwm-petfinder-settings-group-social-media', $kwmPetfinderGlobals['optionPrefix'] . 'share_activate');
    register_setting('kwm-petfinder-settings-group-social-media', $kwmPetfinderGlobals['optionPrefix'] . 'share_platforms');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_vermittelt');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_vermittelt');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_fremdvermittlung');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_fremdvermittlung');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_verstorben');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_verstorben');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_patengesuch');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_patengesuch');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_patengedeckt');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_patengedeckt');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_column_andere');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'list_sorting_order_andere');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'hide_internal_nr');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'hide_serial_nr');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'show_badges');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'show_searching_sponsors');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'sponsors_list_one_line');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'sponsors_list_show_adopted');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'sponsors_list_filter_covered');
    register_setting('kwm-petfinder-settings-group-lists', $kwmPetfinderGlobals['optionPrefix'] . 'sponsors_list_show_city');

    register_setting('kwm-petfinder-settings-group-field-visibility', $kwmPetfinderGlobals['fieldVisibility']['optionConfigureHappened']);
    register_setting('kwm-petfinder-settings-group-field-visibility', $kwmPetfinderGlobals['fieldVisibility']['optionSectionOrder']);
    foreach ($kwmPetfinderGlobals['fieldVisibility']['fields'] as $field => $value) {
        register_setting('kwm-petfinder-settings-group-field-visibility', $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixList'] . $field);
        register_setting('kwm-petfinder-settings-group-field-visibility', $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixDetail'] . $field);
    }
    
    foreach ($kwmPetfinderGlobals['fieldVisibility']['sections'] as $section => $value) {
        register_setting('kwm-petfinder-settings-group-field-visibility', $kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . $section);
    }

    foreach ($kwmPetfinderGlobals['texts'] as $id => $default) {
        register_setting('kwm-petfinder-settings-group-texts', $kwmPetfinderGlobals['optionPrefix'] . 'text_' . $id);
    }
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
    $mylinks = array(
        '<a href="' . admin_url('admin.php?page=kwm-petfinder%2Foptions.php') . '">Einstellungen</a>',
    );

    return array_merge($links, $mylinks);
});

add_action('admin_menu', 'kwm_petfinder_create_menu');
