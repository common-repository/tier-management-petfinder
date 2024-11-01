<?php
/*
Plugin Name: Tier-Management - Petfinder
Plugin URI: https://www.tier-management.de/
Description: Plugin für die Anzeige von Tieren aus der Online-Tierverwaltung Tier-Management.
Author: KW-Management
Author URI: https://www.kw-management.de
Text Domain: tm-petfinder
Version: 3.3.0
*/

use Yoast\WP\SEO\Presenters\Twitter\Image_Presenter as Twitter_Image_Presenter;
use Yoast\WP\SEO\Presenters\Open_Graph\Image_Presenter as OG_Image_Presenter;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define(
    'KWM_PETFINDER_SERVICE_URL',
    substr(get_option('kw_pefinder_customer_id'), 0, 4) === 'http' ?
    get_option('kw_pefinder_customer_id') :
    'https://' . get_option('kw_pefinder_customer_id') . '.vereinszugang.de'
);
define('KWM_PETFINDER_API_ENDPOINT', KWM_PETFINDER_SERVICE_URL . '/api/v1');
define('KWM_PETFINDER_IMAGE_BASE', KWM_PETFINDER_SERVICE_URL . '/modules/Tier-Management/');
define('KWM_PETFINDER_VERSION', '3.3.0');

require_once(plugin_dir_path( __FILE__ ) . 'globals.php');
require_once(plugin_dir_path( __FILE__ ) . 'options.php');
require_once(plugin_dir_path( __FILE__ ) . 'helpers.php');

$petId = filter_input(INPUT_GET, 'kwm_pf_id', FILTER_VALIDATE_INT);
$view = filter_input(INPUT_GET, 'kwm_pf_v', FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"/^(details|request)$/")));

function kwm_petfinder_update_procedure() {
    global $kwmPetfinderGlobals;

    $currentVersionOption = $kwmPetfinderGlobals['optionPrefix'] . 'version';
    $currentVersion = get_site_option($currentVersionOption);
    $versionToSet = str_replace('.', '', KWM_PETFINDER_VERSION);

    if ($currentVersion === false || $currentVersion <= 240) {
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Bilder', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Allgemein', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Beschreibung', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Paten', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Patenschaftsbedarf', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Vermittlungskontakt', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Patenschaftskontakt', 1);
        update_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . 'Teilen', 1);
    }

    if ($currentVersion && $versionToSet > $currentVersion) {
        update_site_option($currentVersionOption, $versionToSet);
    } else {
        add_site_option($currentVersionOption, $versionToSet);
    }
}

function kwm_petfinder_load_admin_assets() {
    wp_enqueue_style('kwm-petfinder-css-admin', plugins_url('assets/css/admin/admin.css', __FILE__), [], KWM_PETFINDER_VERSION);
    wp_enqueue_style('kwm-petfinder-css-jqui', 'https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css', [], KWM_PETFINDER_VERSION);
    wp_enqueue_script('kwm-petfinder-js-admin', plugins_url('assets/js/admin/admin.js', __FILE__), [], KWM_PETFINDER_VERSION, true);
    wp_enqueue_script('kwm-petfinder-js-jqui', 'https://code.jquery.com/ui/1.13.1/jquery-ui.min.js', ['jquery'], KWM_PETFINDER_VERSION, true);
}

function kwm_petfinder_load_assets() {
    global $post;

    if (has_shortcode( $post->post_content, 'kwm-petfinder')) {
        wp_enqueue_style('kwm-petfinder-css-main', plugins_url('assets/css/app/main.css', __FILE__), [], KWM_PETFINDER_VERSION);
        wp_enqueue_script('kwm-petfinder-js-main', plugins_url('assets/js/app/main.js', __FILE__), [], KWM_PETFINDER_VERSION, true);
    }
}

function kwm_petfinder_render_app($atts) {
    $settings = shortcode_atts(
        array(
            'kategorie' => 'vermittelbar',
            'vorauswahl-spezies' => null,
            'vorauswahl-spezies-operator' => null,
            'vorauswahl-geschlecht' => null,
            'vorauswahl-geschlecht-operator' => null,
            'vorauswahl-aufenthaltsort' => null,
            'vorauswahl-aufenthaltsort-operator' => null,
            'vorauswahl-krankheit' => null,
            'vorauswahl-vermittlungsjahr' => null,
            'filter-text' => 0,
            'filter-tierart' => 0,
            'filter-geschlecht' => 0,
            'filter-aufenthaltsort' => 0,
            'filter-kategorie' => 0,
            'filter-eigenschaften' => 0,
            'kontakt' => null,
            'kontakt-patenschaft' => null,
            'spalten' => 2,
            'pro-seite' => 10,
            'listen-layout' => 'vertical',
            'detail-layout' => 'fixed',
            'details' => 0,
            'zufallsauszug' => 0,
            'fremdvermittlungen' => 0
        ),
        $atts
    );

    if (empty(get_option('kw_pefinder_customer_id')) || empty(get_option('kw_pefinder_api_key'))) {
        return 'Fehlende Einstellungen. Bitte prüfen Sie die Einstellungen des Plugins KWM - Petfinder.';
    }

    return '<script>
        var petFinderConfig = {
            serviceUrl: "' . get_site_url() . '/wp-json/kwm-petfinder/api",
            imageBase: "' . KWM_PETFINDER_IMAGE_BASE . '",
            scrollOffset: "' . get_option('kw_pefinder_scroll_offset') . '",
            externalRequestUrl: "' . get_option('kw_pefinder_external_contact_url') . '",
            externalSponsorRequestUrl: "' . get_option('kw_pefinder_external_sponsor_contact_url') . '",
            hideContactButton: ' . (get_option('kw_pefinder_contact_only_loggedin') === '1' && !is_user_logged_in() ? 'true' : 'false') . ',
            shareActive: ' . (get_option('kw_pefinder_share_activate') ? 'true' : 'false') . ',
            sharePlatforms: ' . json_encode(get_option('kw_pefinder_share_platforms', ['x', 'facebook', 'whatsapp'])) . ',
            category: "' . $settings['kategorie'] . '",
            sortColumn: ' . (kwm_petfinder_get_order_config($settings, 'column') ? '"' . kwm_petfinder_get_order_config($settings, 'column') . '"' : 'null') . ',
            sortOrder: ' . (kwm_petfinder_get_order_config($settings, 'order') ? '"' . kwm_petfinder_get_order_config($settings, 'order') . '"' : 'null') . ',
            preFilteredSpecies: ' . kwm_petfinder_parse_multi_select($settings['vorauswahl-spezies']) . ',
            preFilteredSex:' . kwm_petfinder_parse_multi_select($settings['vorauswahl-geschlecht']) . ',
            preFilteredPlace:' . kwm_petfinder_parse_multi_select($settings['vorauswahl-aufenthaltsort']) . ',
            preFilteredIllness:' . kwm_petfinder_parse_multi_select($settings['vorauswahl-krankheit']) . ',
            preFilteredMediatedYear:' . kwm_petfinder_parse_multi_select($settings['vorauswahl-vermittlungsjahr']) . ',
            filterText:' . (intval($settings['filter-text']) === 1 ? 'true' : 'false') . ',
            filterSpecies:' . (intval($settings['filter-tierart']) === 1 ? 'true' : 'false') . ',
            filterSex:' . (intval($settings['filter-geschlecht']) === 1 ? 'true' : 'false') . ',
            filterPlace:' . (intval($settings['filter-aufenthaltsort']) === 1 ? 'true' : 'false') . ',
            filterAttribute:' . (intval($settings['filter-eigenschaften']) === 1 ? 'true' : 'false') . ',
            filterCategory:' . (intval($settings['filter-kategorie']) === 1 ? 'true' : 'false') . ',
            requestType:' . kwm_petfinder_parse_multi_select($settings['kontakt']) . ',
            sponsorRequestType:' . kwm_petfinder_parse_multi_select($settings['kontakt-patenschaft']) . ',
            desktopCols: ' . (intval($settings['spalten'])) . ',
            pageSize: ' . (intval($settings['pro-seite'])) . ',
            listLayout: "' . $settings['listen-layout'] . '",
            detailLayout: "' . $settings['detail-layout'] . '",
            detailLinkEnabled:' . (intval($settings['details']) === 1 ? 'true' : 'false') . ',
            hideInternalNr: ' . (get_option('kw_pefinder_hide_internal_nr') === '1' ? 'true' : 'false') . ',
            showBadges: ' . (get_option('kw_pefinder_show_badges') === '1' ? 'true' : 'false') . ',
            showSearchingSponsors: ' . (get_option('kw_pefinder_show_searching_sponsors') === '1' ? 'true' : 'false') . ',
            sponsorListOneLine: ' . (get_option('kw_pefinder_sponsors_list_one_line') === '1' ? 'true' : 'false') . ',
            sponsorListShowAdopted: ' . (get_option('kw_pefinder_sponsors_list_show_adopted') === '1' ? 'true' : 'false') . ',
            sponsorListFilterCovered: ' . (get_option('kw_pefinder_sponsors_list_filter_covered') === '1' ? 'true' : 'false') . ',
            sponsorListShowCity: ' . (get_option('kw_pefinder_sponsors_list_show_city') === '1' ? 'true' : 'false') . ',
            hideSerialNr: ' . (get_option('kw_pefinder_hide_serial_nr') === '1' ? 'true' : 'false') . ',
            fieldVisibility: ' . json_encode(kwm_petfinder_get_field_visiblity_config()) . ',
            randomCompendium: ' . (intval($settings['zufallsauszug']) === 1 ? 'true' : 'false') . ',
            showForeignPets: ' . (intval($settings['fremdvermittlungen']) === 1 ? 'true' : 'false') . ',
            texts: ' . json_encode(kwm_petfinder_get_texts()) . '
        }
    </script><div id="petfinder"></div>';
}

function kwm_petfinder_add_og_meta_tags() {
    global $petId;
    global $view;

    if ($petId && ($view === 'details' || $view === 'request')) {
        $response = wp_remote_get(
            KWM_PETFINDER_API_ENDPOINT . '/pet/' . $petId,
            array('headers' => array('X-Api-Key' => get_option('kw_pefinder_api_key')))
        );

        if (wp_remote_retrieve_response_code($response) === 200) {
            $pet = json_decode(wp_remote_retrieve_body($response));
            $fallbackImageUrl = KWM_PETFINDER_IMAGE_BASE . '/images/animals/no-image.jpg';
            echo '<meta property="og:title" content="' . str_replace('{name}', $pet->Name, get_option('kw_pefinder_share_title')) . '" />';
            echo '<meta property="og:description" content="' . $pet->BeschreibungNurText . '" />';
            echo '<meta property="og:image" content="' . ($pet->Bilder && count($pet->Bilder) > 0 ? KWM_PETFINDER_IMAGE_BASE . $pet->Bilder[0] : $fallbackImageUrl) . '" />';
            echo '<meta property="og:type" content="website" />';
            echo '<meta property="og:url" content="' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . '" />';
        }
    }
}

function kwm_petfinder_field_visibility_set_defaults()
{
    global $kwmPetfinderGlobals;

    if (empty(get_option($kwmPetfinderGlobals['fieldVisibility']['optionConfigureHappened']))) {
        foreach ($kwmPetfinderGlobals['fieldVisibility']['fields'] as $field => $value) {
            if ($value['defaults']['list']) {
                add_option($kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixList'] . $field, '1');
            }

            if ($value['defaults']['detail']) {
                add_option($kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixDetail'] . $field, '1');
            }
        }

        foreach ($kwmPetfinderGlobals['fieldVisibility']['sections'] as $section => $value) {
            if ($value['defaults']) {
                add_option($kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . $section, '1');
            }
        }

        add_option($kwmPetfinderGlobals['fieldVisibility']['optionConfigureHappened'], '1');
    }
}

function kwm_petfinder_activate()
{
	register_uninstall_hook(__FILE__, 'kwm_petfinder_uninstall');
}

function kwm_petfinder_uninstall()
{
    if (get_option('kw_pefinder_delete_data_on_deinstallation') === '1') {
        foreach (array_filter(wp_load_alloptions(), function($key) {
            return strpos($key, 'kw_pefinder_') !== false;
        }, ARRAY_FILTER_USE_KEY) as $key => $value) {
            delete_option($key);
        }
    }
}

function kwm_petfinder_api_rest_route(WP_REST_Request $request)
{
    $args = [
        'method' => $request->get_method(),
        'headers' => [
            'X-Api-Key' => get_option('kw_pefinder_api_key'),
            'Content-Type' => 'application/json; charset=UTF8'
        ]
    ];

    if (!empty($request->get_json_params())) {
        $args['body'] = json_encode($request->get_json_params());
        $args['data_format'] = 'body';
    }

    $response = wp_remote_request(KWM_PETFINDER_API_ENDPOINT . '/' . $request->get_params()['route'], $args);
    $response_code = wp_remote_retrieve_response_code($response);
    $response_message = wp_remote_retrieve_response_message($response);
    $response_body = wp_remote_retrieve_body($response);

    if ($response_code >= 200 && $response_code < 300) {
        return new WP_REST_Response(
            json_decode($response_body, true),
            $response_code,
            ['Cache-Control' => 'must-revalidate, no-cache, no-store, private']
        );
    } else {
        return new WP_Error($response_code, $response_message, $response_body);
    }
}

register_activation_hook(__FILE__, 'kwm_petfinder_activate');

add_action('plugins_loaded', 'kwm_petfinder_field_visibility_set_defaults');
add_action('wp_head', 'kwm_petfinder_add_og_meta_tags', 0);
add_action('wp_enqueue_scripts', 'kwm_petfinder_load_assets');
add_action('admin_enqueue_scripts', 'kwm_petfinder_load_admin_assets');
add_action('plugins_loaded', 'kwm_petfinder_update_procedure');

add_action('update_option_kw_pefinder_delete_data_on_deinstallation', function() {
    register_uninstall_hook(__FILE__, 'kwm_petfinder_uninstall');
}, 10, 0);

add_action('rest_api_init', function () {
    register_rest_route('kwm-petfinder', '/api/(?P<route>[a-zA-Z0-9-\/]+)', [
      'methods' => ['GET', 'POST'],
      'callback' => 'kwm_petfinder_api_rest_route',
    ]);
});

if ($petId && ($view === 'details' || $view === 'request')) {
    add_action('wpseo_frontend_presenters', function ($presenters) {
        return array_map(function ($presenter) {
            if (!$presenter instanceof Twitter_Image_Presenter && !$presenter instanceof OG_Image_Presenter) {
                return $presenter;
            }
        }, $presenters);
    });

    add_action('rank_math/head', function() {
        remove_all_actions('rank_math/opengraph/facebook');
        remove_all_actions('rank_math/opengraph/twitter');
    });
}

add_shortcode('kwm-petfinder', 'kwm_petfinder_render_app');
